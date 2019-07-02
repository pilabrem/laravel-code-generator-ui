<?php

namespace Pilabrem\CodeGeneratorUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Exception;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTable;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTableField;

class GeneratorTableFieldsController extends Controller
{

    /**
     * Display a listing of the generator table fields.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table = null;
        $tableId = 0;
        if (isset($request->table)) {
            $model = GeneratorTable::findOrFail($request->table);
            $table = $model->name;
            $tableId = $request->table;

            $generatorTableFields = GeneratorTableField::where('generator_table_id', $request->table)
                ->with('generatortable')
                ->paginate(25);
        } else {
            $generatorTableFields = GeneratorTableField::with('generatortable')->paginate(25);
        }

        return view('code-generator-ui::generator_table_fields.index', compact('generatorTableFields', 'table', 'tableId'));
    }

    /**
     * Show the form for creating a new generator table field.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $table = null;
        $tableId = 0;
        if (isset($request->table)) {
            $model = GeneratorTable::findOrFail($request->table);
            $table = $model->name;
            $tableId = $request->table;
        }
        $generatorTables = GeneratorTable::pluck('name', 'id')->all();

        return view('code-generator-ui::generator_table_fields.create', compact('generatorTables', 'table', 'tableId'));
    }

    /**
     * Store a new generator table field in the storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $field = GeneratorTableField::create($data);

            return redirect()->route('generator_table_fields.generator_table_field.index', ['table' => $field->generator_table_id])
                ->with('success_message', 'Le champ a été ajouté avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
    }

    /**
     * Display the specified generator table field.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $generatorTableField = GeneratorTableField::with('generatortable')->findOrFail($id);

        $table = $generatorTableField->generatortable->name;
        $tableId = $generatorTableField->generator_table_id;

        return view('code-generator-ui::generator_table_fields.show', compact('generatorTableField', 'table', 'tableId'));
    }

    /**
     * Show the form for editing the specified generator table field.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $generatorTableField = GeneratorTableField::with('generatortable')->findOrFail($id);
        $generatorTables = GeneratorTable::pluck('name', 'id')->all();

        $table = $generatorTableField->generatortable->name;
        $tableId = $generatorTableField->generator_table_id;


        return view('code-generator-ui::generator_table_fields.edit', compact('generatorTableField', 'generatorTables', 'table', 'tableId'));
    }

    /**
     * Update the specified generator table field in the storage.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $generatorTableField = GeneratorTableField::findOrFail($id);
            $generatorTableField->update($data);

            return redirect()->route('generator_table_fields.generator_table_field.index', ['table' => $generatorTableField->generator_table_id])
                ->with('success_message', 'Le champ a été modifié avec succès!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
    }

    /**
     * Remove the specified generator table field from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $generatorTableField = GeneratorTableField::findOrFail($id);
            $tableId = $generatorTableField->generator_table_id;
            $generatorTableField->delete();

            return redirect()->route('generator_table_fields.generator_table_field.index', ['table' => $tableId])
                ->with('success_message', 'Le champ a été supprimé avec succès!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
    }



    public function generateConfig(int $table_id)
    {
        $table = GeneratorTable::findOrFail($table_id);
        $fields = $table->generatorTableFields;
        $cmd = 'resource-file:create ' . $table->name . ' ';

        // Getting fields parameter
        $fieldsParams = "";
        foreach ($fields as $field) {
            $fieldArray = $field->toArray();
            $excludeFields = ['id', 'created_at', 'updated_at', 'generator_table_id'];

            foreach ($fieldArray as $key => $value) {
                if (!is_array($value) && isset($value) && !in_array($key, $excludeFields)) {
                    // Si le paramètre contient un is_ au départ c'est un boolean
                    if (!(strpos($key, 'is_') !== false)) {
                        $param = str_replace('_', '-', $key) . ':' . $value;
                        $fieldsParams .= $param . ';';
                    }
                }
            }
            $fieldsParams .= ',';
        }

        // Add --fields param
        $cmd .= ' --fields="'. $fieldsParams .'" --force';
        $output = [];
        $exitCode = Artisan::call($cmd, [], $output);

        return back()->with('success_message', 'Fichier de configuration généré avec succès');
    }

    public function generateResources(int $table_id)
    {
        $table = GeneratorTable::findOrFail($table_id);

        $cmd = 'create:scaffold ' . $table->name . ' ';

        $tableArray = $table->toArray();
        $excludeFields = ['id', 'created_at', 'updated_at', 'name'];

        // Commande without --fields parameter
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
        $output = "";
        //$exitCode = Artisan::call($cmd, [], $output);
        return back()
                ->with('success_message', 'Veuillez exécuter la commande suivante dans le dossier du projet')
                ->with('cmd', 'php artisan '.$cmd);
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
            'labels' => 'string|min:1|max:255|nullable',
            'validation' => 'string|min:1|nullable',
            'html_type' => 'nullable',
            'html_value' => 'string|min:1|nullable',
            'css_class' => 'string|min:1|nullable',
            'options' => 'string|min:1|nullable',
            'data_type' => 'nullable',
            'data_type_params' => 'string|min:1|nullable',
            'data_value' => 'string|min:1|nullable',
            'date_format' => 'date_format:j/n/Y|nullable',
            'placeholder' => 'string|min:1|nullable',
            'is_inline_options' => 'boolean|nullable',
            'is_on_index' => 'boolean|nullable',
            'is_on_form' => 'boolean|nullable',
            'is_on_show' => 'boolean|nullable',
            'is_on_views' => 'boolean|nullable',
            'is_header' => 'boolean|nullable',
            'is_auto_increment' => 'boolean|nullable',
            'is_primary' => 'boolean|nullable',
            'is_index' => 'boolean|nullable',
            'is_unique' => 'boolean|nullable',
            'is_nullable' => 'boolean|nullable',
            'is_unsigned' => 'boolean|nullable',
            'generator_table_id' => 'nullable',
        ];

        $data = $request->validate($rules);

        $data['is_inline_options'] = $request->has('is_inline_options');
        $data['is_on_index'] = $request->has('is_on_index');
        $data['is_on_form'] = $request->has('is_on_form');
        $data['is_on_show'] = $request->has('is_on_show');
        $data['is_on_views'] = $request->has('is_on_views');
        $data['is_header'] = $request->has('is_header');
        $data['is_auto_increment'] = $request->has('is_auto_increment');
        $data['is_primary'] = $request->has('is_primary');
        $data['is_index'] = $request->has('is_index');
        $data['is_unique'] = $request->has('is_unique');
        $data['is_nullable'] = $request->has('is_nullable');
        $data['is_unsigned'] = $request->has('is_unsigned');

        return $data;
    }
}
