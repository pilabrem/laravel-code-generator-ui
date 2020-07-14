<?php

namespace Pilabrem\CodeGeneratorUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Exception;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTable;
use CrestApps\CodeGenerator\Models\Field;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTableField;
use Illuminate\Support\Facades\Config;

class GeneratorTablesController extends Controller
{

    /**
     * Display a listing of the generator tables.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $generatorTables = GeneratorTable::paginate(25);

        return view('code-generator-ui::generator_tables.index', compact('generatorTables'));
    }

    /**
     * Show the form for creating a new generator table.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('code-generator-ui::generator_tables.create');
    }



    public function saveNewFields(int $table_id, Request $request)
    {
        $nbField = count($request['field_name']);

        for ($i = 0; $i < $nbField; $i++) {
            $field = null;
            if (isset($request['id'][$i])) {
                $id = $request['id'][$i];
                $field = GeneratorTableField::findOrFail($id);
            } else {
                $field = new GeneratorTableField();
            }
            $field->name = $request['field_name'][$i];
            $field->labels = $request['labels'][$i];
            $field->validation = $request['validation'][$i];
            $field->html_type = $request['html_type'][$i];
            $field->options = $request['options'][$i];
            $field->data_type = $request['data_type'][$i];
            $field->data_type_params = $request['data_type_params'][$i];
            $field->date_format = $request['date_format'][$i];
            $field->placeholder = $request['placeholder'][$i];
            $field->generator_table_id = $table_id;
            $field->save();
        }
    }

    /**
     * Store a new generator table in the storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->getData($request);
        $table = GeneratorTable::create($data);

        // Table model has at least 1 field
        if (isset($request->field_name)) {
            $this->saveNewFields($table->id, $request);
        }

        return redirect()->route('generator_tables.generator_table.index')
            ->with('success_message', 'Table Model saved');
    }

    /**
     * Display the specified generator table.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $generatorTable = GeneratorTable::findOrFail($id);

        return view('code-generator-ui::generator_tables.show', compact('generatorTable'));
    }

    /**
     * Show the form for editing the specified generator table.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $generatorTable = GeneratorTable::findOrFail($id);
        $generatorTableFields = $generatorTable->generatorTableFields;

        return view('code-generator-ui::generator_tables.edit', compact('generatorTable', 'generatorTableFields'));
    }

    /**
     * Update the specified generator table in the storage.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $data = $this->getData($request);
        $generatorTable = GeneratorTable::findOrFail($id);
        $generatorTable->update($data);

        // Table model has at least 1 field
        if (isset($request->field_name)) {
            $this->saveNewFields($generatorTable->id, $request);
        }

        return redirect()->route('generator_tables.generator_table.index')
            ->with('success_message', 'Table model updated successfully!');
    }

    /**
     * Remove the specified generator table from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $generatorTable = GeneratorTable::findOrFail($id);
        $cmd = "resource-file:delete " . $generatorTable->name;
        // Delete Table Model
        $generatorTable->delete();

        try {
            // Delete resource file
            Config::set("laravel-code-generator.resource_file_path", "../resources/laravel-code-generator/sources");
            Artisan::call($cmd);
        } catch (Exception $exception) { } finally {
            return redirect()->route('generator_tables.generator_table.index')
                ->with('success_message', 'Table model deleted!');
        }
    }

    /**
     *      Generate resource file
     */
    public function generateConfig()
    {
        $tables = GeneratorTable::all();

        foreach ($tables as $table) {
            // For Each table model
            $fields = $table->generatorTableFields;
            $cmd = 'resource-file:create ' . $table->name . ' ';

            // Getting fields parameter
            $fieldsParams = "";
            if (!isset($table->primary_key)) {
                $fieldsParams = "id,";
            }

            foreach ($fields as $field) {
                $fieldArray = $field->toArray();
                $excludeFields = ['id', 'created_at', 'updated_at', 'generator_table_id'];

                if (strpos($field->name, '_id') !== false) {
                    $fieldsParams .= $field->name;
                } else {
                    foreach ($fieldArray as $key => $value) {
                        if (!is_array($value) && isset($value) && !in_array($key, $excludeFields)) {
                            // Si le paramètre contient un is_ au départ c'est un boolean
                            if (!(strpos($key, 'is_') !== false)) {
                                $param = str_replace('_', '-', $key) . ':' . $value;
                                $fieldsParams .= $param . ';';
                            }
                        }
                    }
                }
                $fieldsParams .= ',';
            }
            // Add --fields param
            $cmd .= ' --fields="' . $fieldsParams . '" --force';

            // Add translation option
            if (isset($table->translation_for)) {
                $cmd .= " --translation-for=" . $table->translation_for;
            }

            $output = [];
            $exitCode = Artisan::call($cmd, [], $output);
        }

        return back()->with('success_message', 'Resources files created successfully');
    }

    /**
     *      Scaffold app files
     */
    public function generateResources(Request $request)
    {
        $tables = GeneratorTable::all();

        foreach ($tables as $table) {
            // For Each table model
            $cmd = 'create:scaffold ' . $table->name . ' ';
            $tableArray = $table->toArray();
            $excludeFields = ['id', 'created_at', 'updated_at', 'name'];

            // Command
            foreach ($tableArray as $key => $value) {
                if (!is_array($value) && isset($value) && !in_array($key, $excludeFields)) {
                    if (strpos($key, 'with_') !== false) {
                        if ($value == 1) {
                            $param = '--' . str_replace('_', '-', $key);
                            $cmd .= $param . ' ';
                        }
                    } else {
                        $param = '--' . str_replace('_', '-', $key) . '=' . $value;
                        $cmd .= $param . ' ';
                    }
                }
            }

            $cmd .= ' --force';

            Config::set("laravel-code-generator.resource_file_path", "../resources/laravel-code-generator/sources");
            Artisan::call($cmd);
        }

        if (isset($request->option) && $request->option == "migrate") {
            Artisan::call("migrate");
        }

        return back()
            ->with('success_message', 'App scaffolded');
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'name' => 'string|min:1|max:255|required',
            'table_name' => 'string|min:1|nullable',
            'with_migration' => 'boolean|nullable',
            'with_form_request' => 'boolean|nullable',
            'with_soft_delete' => 'boolean|nullable',
            'models_per_page' => 'numeric|min:1|max:9999|nullable',
            'translation_for' => 'string|min:1|nullable',
            'primary_key' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);

        $data['with_migration'] = $request->has('with_migration');
        $data['with_form_request'] = $request->has('with_form_request');
        $data['with_soft_delete'] = $request->has('with_soft_delete');

        return $data;
    }
}
