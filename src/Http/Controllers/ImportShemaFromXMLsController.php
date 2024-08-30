<?php

namespace App\Http\Controllers;

use URL;
use Exception;
use SimpleXMLElement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTable;
use Pilabrem\CodeGeneratorUI\Models\GeneratorTableField;

// Pilabrem
class ImportShemaFromXMLsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if (env('APP_ENV') !== 'local') {
                return abort(403, "Non autorisée en mode production");
            }

            abort_if(!Gate::allows('manage administrators'), 403, "Non autorisé");

            view()->share('boutiqueGeree', null);

            $slug = request()->slug;
            URL::defaults(['slug' => $slug ? $slug : "jsajdlsjldjsaldjlkjsljslkdj"]);

            view()->share('boutiqueGeree', null);

            return $next($request);
        });
    }

    /**
     * Display a listing of the import shema from x m ls.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('import_shema_from_x_m_ls.index');
    }

    /**
     * Show the form for creating a new import shema from x m l.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('import_shema_from_x_m_ls.create');
    }

    /**
     * Store a new import shema from x m l in the storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $data = $this->getData($request);
            // Get XML file content
            $fileUrl = public_path("storage\\" . $data["fichier"]);
            $xml = new SimpleXMLElement($fileUrl, null, true);
            $tables = array();

            // Loop through pages in the diagram
            $nbPages = count($xml->diagram);
            for ($i = 0; $i < $nbPages; $i++) {
                // Get the current page
                $diagram = $xml->diagram[$i];
                // The elements of the diagram (Page)
                $elements = (array) $diagram->mxGraphModel->root;
                // Storing the references of the parent model
                $xmlParentId = null;
                $tableParentId = 0;
                // Loop through the elements
                $nbElements = count($elements["mxCell"]);
                for ($j = 0; $j < $nbElements; $j++) {
                    $el = $elements["mxCell"][$j];

                    // Is a table Model, save it
                    if ($this->diagramElIsTable($el)) {
                        $xmlParentId = $el["id"] . ""; // Transform to string
                        $modelName = $this->strip_attr_tags($el["value"]);
                        // Create The table Model
                        $table = GeneratorTable::firstOrCreate(["name" => $modelName]);
                        $tableParentId = $table->id;
                        $tables[] = $table;
                    } else if ($this->diagramElIsTableField($el)) {
                        $fieldName = $this->strip_attr_tags($el["value"]) . "";
                        $elParentId = $el["parent"] . ""; // Transform to string

                        // Has parent table
                        if ($elParentId == $xmlParentId) {
                            // Get Field infos
                            $fieldInfos = (array) $this->getFieldInfos($fieldName);
                            $fieldInfos["generator_table_id"] = $tableParentId;
                            // Save Table Field
                            if ($fieldInfos["name"] != "id") {  // Don't Save IDs
                                GeneratorTableField::create($fieldInfos);
                            }
                        }
                    }
                }
            }

            // Add the default fields to the tables if they don't exist yet and if the config('laravel-code-generator.default_fields') exists and is not empty
            if (config('laravel-code-generator.default_fields') && count(config('laravel-code-generator.default_fields')) > 0) {
                foreach ($tables as $table) {
                    $tableFields = GeneratorTableField::where('generator_table_id', $table->id)->get();
                    $tableFieldsNames = $tableFields->pluck('name')->toArray();
                    foreach (config('laravel-code-generator.default_fields') as $defaultField) {
                        if (!in_array($defaultField['name'], $tableFieldsNames)) {
                            $fieldInfos = array(
                                "name" => $defaultField['name'],
                                "labels" => $defaultField['labels'] ?? $this->nameToLabel($defaultField['name']),
                                "validation" => $defaultField['validation'] ?? "",
                                "html_type" => $defaultField['html_type'] ?? "text",
                                "options" => $defaultField['options'] ?? null,
                                "data_type" => $defaultField['data_type'] ?? "string",
                                "data_type_params" => $defaultField['data_type_params'] ?? null,
                                "date_format" => $defaultField['date_format'] ?? null,
                                "generator_table_id" => $table->id,
                                "placeholder" => " "
                            );
                            GeneratorTableField::create($fieldInfos);
                        }
                    }
                }
            }

            return redirect()->route('import_shema_from_xmls.import_shema_from_xml.create')
                ->with('success_message', 'Shema importé avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Une erreur inconnue a été trouvée!']);
        }
    }

    /**
     * Strip attribute tags from the given original attribute.
     * If the value of the attribute is an HTML entity, it will be decoded before stripping tags.
     * Eg. <mxCell id="6CCQWgtzOiT5ZE1ZMl2y-9" value="&lt;code style=&quot;font-size: 12px;&quot;&gt;&lt;font face=&quot;Helvetica&quot; style=&quot;font-size: 12px;&quot;&gt;+ type_compte: String(dav, dat, entreprise)&lt;/font&gt;&lt;/code&gt;" style="text;strokeColor=none;fillColor=none;align=left;verticalAlign=top;spacingLeft=4;spacingRight=4;overflow=hidden;rotatable=0;points=[[0,0.5],[1,0.5]];portConstraint=eastwest;whiteSpace=wrap;html=1;fontFamily=Helvetica;fontSize=12;fontColor=default;labelBackgroundColor=none;" vertex="1" parent="6CCQWgtzOiT5ZE1ZMl2y-6">
     *
     * @param string $attr_original The original attribute to strip tags from.
     * @return string The attribute with tags stripped.
     */
    protected function strip_attr_tags($attr_original)
    {
        $decodedText = html_entity_decode($attr_original);
        return strip_tags($decodedText);
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
            'fichier' => ['file'],
        ];
        if ($request->route()->getAction()['as'] == 'import_shema_from_x_m_ls.importshemafromxml.store' || $request->has('custom_delete_fichier')) {
            array_push($rules['fichier'], 'required');
        }
        $data = $request->validate($rules);
        if ($request->has('custom_delete_fichier')) {
            $data['fichier'] = '';
        }
        if ($request->hasFile('fichier')) {
            $data['fichier'] = $this->moveFile($request->file('fichier'));
        }


        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $saved = $file->store("public");

        return substr($saved, 7);
    }


    /**
     * Get all informations of a field
     *
     * @param [type] $field
     * @return void
     */
    public function getFieldInfos($field)
    {
        $matches = array();
        $s = preg_match('#^[+-] ?(\w+) ?\: ?([a-zA-Z_]+) ?\(?#', $field, $matches);

        // Get Field Name
        $name = isset($matches[1]) ? $matches[1] : null;
        //
        $type = isset($matches[2]) ? $matches[2] : null;

        $s = preg_match('# ?\( ?([\w,;\- ]+) ?\)#', $field, $matches);
        $typeParams = isset($matches[1]) ? $matches[1] : null;


        $html_type = $this->getHtmlType($type, $typeParams);
        $data_type = $this->getDataType($type);

        $fieldInfos = array(
            "name" => $name,
            "labels" => $this->nameToLabel($name),
            "validation" => "",
            "html_type" => $html_type,
            "options" => $this->getOptions($html_type, $typeParams),
            "data_type" => $data_type,
            "data_type_params" => $this->getDataTypeParams($data_type, $typeParams),
            "date_format" => $this->getDateFormat($data_type, $typeParams),
            "is_inline_options" => $this->getIsInlineOptions($html_type, $typeParams),
            "placeholder" => " "
        );

        return $fieldInfos;
    }

    public function nameToLabel($name)
    {
        while (Str::contains($name, '_')) {
            $name = Str::replaceFirst('_', ' ', $name);
        }

        return Str::title($name);
    }

    // Get Options
    public function getOptions($htmlType, $typeParams)
    {
        if ($typeParams == null) {
            return null;
        }

        if (in_array($htmlType, array("radio", "checkbox", "select", "multipleSelect"))) {
            return str_replace(' ', '', str_replace(',', '|', $typeParams));
        }

        return null;
    }

    // Get is Inline Options
    public function getIsInlineOptions($htmlType, $typeParams)
    {
        if ($typeParams == null) {
            return "false";
        }

        if (in_array($htmlType, array("radio", "checkbox"))) {
            // Check if the typeParams contains less than 3 commas, return true, else false
            if (substr_count($typeParams, ',') < 3 || substr_count($typeParams, '|') < 3) {
                return "true";
            }
        }

        return "false";
    }

    // Get Data Type Params
    public function getDataTypeParams($dataType, $typeParams)
    {
        if ($typeParams == null) {
            return null;
        }

        if (in_array($dataType, array('char', 'varchar'))) {
            return $typeParams;
        }

        if ($dataType == 'string') {
            return $this->getStringSize($typeParams);
        }

        return null;
    }

    // Get Date format
    public function getDateFormat($dataType, $typeParams)
    {
        if ($typeParams == null) {
            if ($dataType == 'date') {
                return 'Y-m-d';
            }

            if (in_array($dataType, array('date', 'datetime', 'datetimetz'))) {
                return 'Y-m-d H:i:s';
            }

            return null;
        }

        if (in_array($dataType, array('date', 'datetime', 'datetimetz'))) {
            return $typeParams;
        }

        return null;
    }

    // Get HTML Type
    public function getHtmlType($elType, $typeParams)
    {
        $typeLower = mb_strtolower($elType);
        $htmlTypes = array(
            'string' => "text",
            'int' => "number",
            'integer' => "number",
            'bigint' => "number",
            'biginteger' => "number",
            'number' => "number",
            'boolean' => "checkbox",
            'bool' => "checkbox",
            'double' => "text",
            'text' => "textarea",
            'texte' => "textarea",
            'file' => "file",
            'enum' => "select",
            'date' => "text",
            'datetime' => "text",
            'timestamp' => "text"
        );

        if ($typeLower == "string" && $typeParams != null) {
            return $this->getStringHtmlType($typeParams);
        }

        return isset($htmlTypes[$typeLower]) ? $htmlTypes[$typeLower] : $elType;
    }

    /**
     * Get the HTML input type based on the given type and type parameters.
     *
     * @param string $type The type of the input.
     * @param string|null $typeParams The parameters associated with the input type.
     * @return string The HTML input type.
     */
    protected function getStringHtmlType($typeParams)
    {
        if ($typeParams == null) {
            return "text";
        }

        // Check if the typeParams does not contain a ";" or ",", then it is a text
        if (Str::contains($typeParams, ',') || Str::contains($typeParams, '|')) {
            // Check if the typeParams contains less than 3 commas, then it is a radio, else it is a select
            if (substr_count($typeParams, ',') < 3 || substr_count($typeParams, '|') < 3) {
                return "radio";
            }
            return "select";
        }

        return "text";
    }

    /**
     * Get the size of a string based on the given type and type parameters.
     *
     * @param mixed $type The type of the string.
     * @param mixed $typeParams The parameters associated with the type.
     * @return int|null The size of the string if it is numeric, otherwise null.
     */
    protected function getStringSize($typeParams)
    {
        // Check if the typeParams does not contain a ";" or ",", then it is a text
        if (is_numeric($typeParams)) {
            return $typeParams;
        }

        return null;
    }

    // Get Data Type
    public function getDataType($elType)
    {
        $typeLower = mb_strtolower($elType);
        $htmlTypes = array(
            'string' => "string",
            'int' => "int",
            'integer' => "integer",
            'bigint' => "bigint",
            'biginteger' => "biginteger",
            'decimal' => "decimal",
            'number' => "int",
            'bool' => "bool",
            'boolean' => "boolean",
            'double' => "double",
            'text' => "text",
            'texte' => "text",
            'file' => "string",
            'enum' => "enum",
            'date' => "date",
            'datetime' => "datetime",
            'timestamp' => "timestamp"
        );

        return isset($htmlTypes[$typeLower]) ? $htmlTypes[$typeLower] : $elType;
    }

    public function hasFivesProps($el)
    {
        if ($el["id"] != null && $el["value"] != null && $el["style"] != null && $el["parent"] != null && $el["vertex"] != null) {
            return true;
        }
        return false;
    }

    // L'element du diagramme est une table
    public function diagramElIsTable($el)
    {
        if ($this->hasFivesProps($el)) {
            $style = $el["style"];
            $type = substr($style, 0, strpos($style, ";"));
            if ($type === "swimlane") {
                return true;
            }
        }

        return false;
    }

    // L'element du diagramme est un champ
    public function diagramElIsTableField($el)
    {
        if ($this->hasFivesProps($el)) {
            $name = $this->strip_attr_tags($el["value"]) . "";
            // Ne pas prendre en compte les IDs
            if ($name == "id") {
                return false;
            }

            $style = $el["style"];
            $type = substr($style, 0, strpos($style, ";"));
            if ($type === "text") {
                // If the name contains "):" or ") :" then it is a method. return false
                if (Str::contains($name, "):") || Str::contains($name, ") :")) {
                    return false;
                }

                return true;
            }
        }

        return false;
    }
}
