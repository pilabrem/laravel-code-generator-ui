<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($generatorTableField)->name) }}" minlength="1" maxlength="255"
            placeholder="">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('labels') ? 'has-error' : '' }}">
    <label for="labels" class="col-md-2 control-label">Label</label>
    <div class="col-md-10">
        <input class="form-control" name="labels" type="text" id="labels"
            value="{{ old('labels', optional($generatorTableField)->labels) }}" minlength="1" maxlength="255"
            placeholder="">
        {!! $errors->first('labels', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('placeholder') ? 'has-error' : '' }}">
    <label for="placeholder" class="col-md-2 control-label">Placeholder</label>
    <div class="col-md-10">
        <input class="form-control" name="placeholder" type="text" id="placeholder"
            value="{{ old('placeholder', optional($generatorTableField)->placeholder) }}" minlength="1"
            placeholder="">
        {!! $errors->first('placeholder', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validation') ? 'has-error' : '' }}">
    <label for="validation" class="col-md-2 control-label">Validation</label>
    <div class="col-md-10">
        <input class="form-control" name="validation" type="text" id="validation"
            value="{{ old('validation', optional($generatorTableField)->validation) }}" minlength="1"
            placeholder="">
        {!! $errors->first('validation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('html_type') ? 'has-error' : '' }}">
    <label for="html_type" class="col-md-2 control-label">Html Type</label>
    <div class="col-md-10">
        <select class="form-control" id="html_type" name="html_type">
            @foreach ([
            'text' => 'Text',
            'textarea' => 'Textarea',
            'password' => 'Password',
            'email' => 'Email',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio',
            'number' => 'Number',
            'select' => 'Select',
            'hidden' => 'Hidden',
            'file' => 'File',
            'selectRange' => 'SelectRange',
            'selectMonth' => 'SelectMonth',
            'multipleSelect' => 'MultipleSelect'
            ] as $key => $text)
            <option value="{{ $key }}"
                {{ old('html_type', optional($generatorTableField)->html_type) == $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('html_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_type') ? 'has-error' : '' }}">
    <label for="data_type" class="col-md-2 control-label">Data Type</label>
    <div class="col-md-10">
        <select class="form-control" id="data_type" name="data_type">
            <option value="" style="display: none;"
                {{ old('data_type', optional($generatorTableField)->data_type ?: '') == '' ? 'selected' : '' }} disabled
                selected>Select data type</option>
            @foreach ([
            'char' => 'Char',
            'date' => 'Date',
            'datetime' => 'Datetime',
            'datetimetz' => 'Datetimetz',
            'biginteger' => 'Biginteger',
            'bigint' => 'Bigint',
            'blob' => 'Blob',
            'binary' => 'Binary',
            'bool' => 'Bool',
            'boolean' => 'Boolean',
            'decimal' => 'Decimal',
            'double' => 'Double',
            'enum' => 'Enum',
            'list' => 'List',
            'float' => 'Float',
            'int' => 'Int',
            'integer' => 'Integer',
            'ipaddress' => 'Ipaddress',
            'json' => 'Json',
            'jsonb' => 'Jsonb',
            'longtext' => 'Longtext',
            'macaddress' => 'Macaddress',
            'mediuminteger' => 'Mediuminteger',
            'mediumint' => 'Mediumint',
            'mediumtext' => 'Mediumtext',
            'morphs' => 'Morphs',
            'string' => 'String',
            'varchar' => 'Varchar',
            'nvarchar' => 'Nvarchar',
            'text' => 'Text',
            'time' => 'Time',
            'timetz' => 'Timetz',
            'tinyinteger' => 'Tinyinteger',
            'tinyint' => 'Tinyint',
            'timestamp' => 'Timestamp',
            'timestamptz' => 'Timestamptz',
            'unsignedbiginteger' => 'Unsignedbiginteger',
            'unsignedbigint' => 'Unsignedbigint',
            'unsignedInteger' => 'UnsignedInteger',
            'unsignedint' => 'Unsignedint',
            'unsignedmediuminteger' => 'Unsignedmediuminteger',
            'unsignedmediumint' => 'Unsignedmediumint',
            'unsignedsmallinteger' => 'Unsignedsmallinteger',
            'unsignedsmallint' => 'Unsignedsmallint',
            'unsignedtinyinteger' => 'Unsignedtinyinteger',
            'uuid' => 'Uuid'
            ] as $key => $text)
            <option value="{{ $key }}"
                {{ old('data_type', optional($generatorTableField)->data_type) == $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('data_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_type_params') ? 'has-error' : '' }}">
    <label for="data_type_params" class="col-md-2 control-label">Data Type Params</label>
    <div class="col-md-10">
        <input class="form-control" name="data_type_params" type="text" id="data_type_params"
            value="{{ old('data_type_params', optional($generatorTableField)->data_type_params) }}" minlength="1"
            placeholder="">
        {!! $errors->first('data_type_params', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('options') ? 'has-error' : '' }}">
    <label for="options" class="col-md-2 control-label">Options</label>
    <div class="col-md-10">
        <input class="form-control" name="options" type="text" id="options"
            value="{{ old('options', optional($generatorTableField)->options) }}" minlength="1"
            placeholder="">
        {!! $errors->first('options', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('date_format') ? 'has-error' : '' }}">
    <label for="date_format" class="col-md-2 control-label">Date Format</label>
    <div class="col-md-10">
        <input class="form-control" name="date_format" type="text" id="date_format"
            value="{{ old('date_format', optional($generatorTableField)->date_format) }}"
            placeholder="">
        {!! $errors->first('date_format', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('html_value') ? 'has-error' : '' }}">
    <label for="html_value" class="col-md-2 control-label">Html Value</label>
    <div class="col-md-10">
        <input class="form-control" name="html_value" type="text" id="html_value"
            value="{{ old('html_value', optional($generatorTableField)->html_value) }}" minlength="1"
            placeholder="">
        {!! $errors->first('html_value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('css_class') ? 'has-error' : '' }}">
    <label for="css_class" class="col-md-2 control-label">Css Class</label>
    <div class="col-md-10">
        <input class="form-control" name="css_class" type="text" id="css_class"
            value="{{ old('css_class', optional($generatorTableField)->css_class) }}" minlength="1"
            placeholder="">
        {!! $errors->first('css_class', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_value') ? 'has-error' : '' }}">
    <label for="data_value" class="col-md-2 control-label">Data Value</label>
    <div class="col-md-10">
        <input class="form-control" name="data_value" type="text" id="data_value"
            value="{{ old('data_value', optional($generatorTableField)->data_value) }}" minlength="1"
            placeholder="">
        {!! $errors->first('data_value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if($tableId == 0)

<div class="form-group {{ $errors->has('generator_table_id') ? 'has-error' : '' }}">
    <label for="generator_table_id" class="col-md-2 control-label">Table Model</label>
    <div class="col-md-10">
        <select class="form-control" id="generator_table_id" name="generator_table_id">
            <option value="" style="display: none;"
                {{ old('generator_table_id', optional($generatorTableField)->generator_table_id ?: '') == '' ? 'selected' : '' }}
                disabled selected>Select table model</option>
            @foreach ($generatorTables as $key => $generatorTable)
            <option value="{{ $key }}"
                {{ old('generator_table_id', optional($generatorTableField)->generator_table_id) == $key ? 'selected' : '' }}>
                {{ $generatorTable }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('generator_table_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@else
<input type="hidden" name="generator_table_id" value="{{$tableId}}">
@endif
