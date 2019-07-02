<?php

namespace Pilabrem\CodeGeneratorUI\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Exception;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTable;

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

    /**
     * Store a new generator table in the storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            GeneratorTable::create($data);

            return redirect()->route('generator_tables.generator_table.index')
                ->with('success_message', 'La Table a été ajoutée avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
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


        return view('code-generator-ui::generator_tables.edit', compact('generatorTable'));
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
        try {

            $data = $this->getData($request);

            $generatorTable = GeneratorTable::findOrFail($id);
            $generatorTable->update($data);

            return redirect()->route('generator_tables.generator_table.index')
                ->with('success_message', 'La Table a été modifiée avec succès!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
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
        try {
            $generatorTable = GeneratorTable::findOrFail($id);
            $generatorTable->delete();

            return redirect()->route('generator_tables.generator_table.index')
                ->with('success_message', 'La Table a été supprimé avec succès!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
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
            'models_per_page' => 'numeric|min:-99999999999.99|max:99999999999.99|nullable',
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
