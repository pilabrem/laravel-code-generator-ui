<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($generatorTableField)->name) }}" minlength="1" maxlength="255"
            placeholder="Entrer name ici...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('labels') ? 'has-error' : '' }}">
    <label for="labels" class="col-md-2 control-label">Label</label>
    <div class="col-md-10">
        <input class="form-control" name="labels" type="text" id="labels"
            value="{{ old('labels', optional($generatorTableField)->labels) }}" minlength="1" maxlength="255"
            placeholder="Entrer labels ici...">
        {!! $errors->first('labels', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('placeholder') ? 'has-error' : '' }}">
    <label for="placeholder" class="col-md-2 control-label">Placeholder</label>
    <div class="col-md-10">
        <input class="form-control" name="placeholder" type="text" id="placeholder"
            value="{{ old('placeholder', optional($generatorTableField)->placeholder) }}" minlength="1"
            placeholder="Entrer placeholder ici...">
        {!! $errors->first('placeholder', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('validation') ? 'has-error' : '' }}">
    <label for="validation" class="col-md-2 control-label">Validation</label>
    <div class="col-md-10">
        <input class="form-control" name="validation" type="text" id="validation"
            value="{{ old('validation', optional($generatorTableField)->validation) }}" minlength="1"
            placeholder="Entrer validation ici...">
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
                selected>Selectionner le type de donnée</option>
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
            placeholder="Entrer data type params ici...">
        {!! $errors->first('data_type_params', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('options') ? 'has-error' : '' }}">
    <label for="options" class="col-md-2 control-label">Options</label>
    <div class="col-md-10">
        <input class="form-control" name="options" type="text" id="options"
            value="{{ old('options', optional($generatorTableField)->options) }}" minlength="1"
            placeholder="Entrer options ici...">
        {!! $errors->first('options', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('date_format') ? 'has-error' : '' }}">
    <label for="date_format" class="col-md-2 control-label">Date Format</label>
    <div class="col-md-10">
        <input class="form-control" name="date_format" type="text" id="date_format"
            value="{{ old('date_format', optional($generatorTableField)->date_format) }}"
            placeholder="Entrer date format ici...">
        {!! $errors->first('date_format', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('html_value') ? 'has-error' : '' }}">
    <label for="html_value" class="col-md-2 control-label">Html Value</label>
    <div class="col-md-10">
        <input class="form-control" name="html_value" type="text" id="html_value"
            value="{{ old('html_value', optional($generatorTableField)->html_value) }}" minlength="1"
            placeholder="Entrer html value ici...">
        {!! $errors->first('html_value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('css_class') ? 'has-error' : '' }}">
    <label for="css_class" class="col-md-2 control-label">Css Class</label>
    <div class="col-md-10">
        <input class="form-control" name="css_class" type="text" id="css_class"
            value="{{ old('css_class', optional($generatorTableField)->css_class) }}" minlength="1"
            placeholder="Entrer css class ici...">
        {!! $errors->first('css_class', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_value') ? 'has-error' : '' }}">
    <label for="data_value" class="col-md-2 control-label">Data Value</label>
    <div class="col-md-10">
        <input class="form-control" name="data_value" type="text" id="data_value"
            value="{{ old('data_value', optional($generatorTableField)->data_value) }}" minlength="1"
            placeholder="Entrer data value ici...">
        {!! $errors->first('data_value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--
<div class="form-group {{ $errors->has('is_inline_options') ? 'has-error' : '' }}">
    <label for="is_inline_options" class="col-md-2 control-label">Is Inline Options</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_inline_options_1">
                <input id="is_inline_options_1" class="" name="is_inline_options" type="checkbox" value="1"
                    {{ old('is_inline_options', optional($generatorTableField)->is_inline_options) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_inline_options', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_on_index') ? 'has-error' : '' }}">
    <label for="is_on_index" class="col-md-2 control-label">Is On Index</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_on_index_1">
                <input id="is_on_index_1" class="" name="is_on_index" type="checkbox" value="1"
                    {{ old('is_on_index', optional($generatorTableField)->is_on_index) == '1' ? 'checked' : '' }}
                    @if(!isset($generatorTableField)) checked @endif>
                Yes
            </label>
        </div>

        {!! $errors->first('is_on_index', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_on_form') ? 'has-error' : '' }}">
    <label for="is_on_form" class="col-md-2 control-label">Is On Form</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_on_form_1">
                <input id="is_on_form_1" class="" name="is_on_form" type="checkbox" value="1"
                    {{ old('is_on_form', optional($generatorTableField)->is_on_form) == '1' ? 'checked' : '' }}
                    @if(!isset($generatorTableField)) checked @endif>
                Yes
            </label>
        </div>

        {!! $errors->first('is_on_form', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_on_show') ? 'has-error' : '' }}">
    <label for="is_on_show" class="col-md-2 control-label">Is On Show</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_on_show_1">
                <input id="is_on_show_1" class="" name="is_on_show" type="checkbox" value="1"
                    {{ old('is_on_show', optional($generatorTableField)->is_on_show) == '1' ? 'checked' : '' }}
                    @if(!isset($generatorTableField)) checked @endif>
                Yes
            </label>
        </div>

        {!! $errors->first('is_on_show', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_on_views') ? 'has-error' : '' }}">
    <label for="is_on_views" class="col-md-2 control-label">Is On Views</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_on_views_1">
                <input id="is_on_views_1" class="" name="is_on_views" type="checkbox" value="1"
                    {{ old('is_on_views', optional($generatorTableField)->is_on_views) == '1' ? 'checked' : '' }}
                    @if(!isset($generatorTableField)) checked @endif>
                Yes
            </label>
        </div>

        {!! $errors->first('is_on_views', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_header') ? 'has-error' : '' }}">
    <label for="is_header" class="col-md-2 control-label">Is Header</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_header_1">
                <input id="is_header_1" class="" name="is_header" type="checkbox" value="1"
                    {{ old('is_header', optional($generatorTableField)->is_header) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_header', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_auto_increment') ? 'has-error' : '' }}">
    <label for="is_auto_increment" class="col-md-2 control-label">Is Auto Increment</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_auto_increment_1">
                <input id="is_auto_increment_1" class="" name="is_auto_increment" type="checkbox" value="1"
                    {{ old('is_auto_increment', optional($generatorTableField)->is_auto_increment) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_auto_increment', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_primary') ? 'has-error' : '' }}">
    <label for="is_primary" class="col-md-2 control-label">Is Primary</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_primary_1">
                <input id="is_primary_1" class="" name="is_primary" type="checkbox" value="1"
                    {{ old('is_primary', optional($generatorTableField)->is_primary) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_primary', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_index') ? 'has-error' : '' }}">
    <label for="is_index" class="col-md-2 control-label">Is Index</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_index_1">
                <input id="is_index_1" class="" name="is_index" type="checkbox" value="1"
                    {{ old('is_index', optional($generatorTableField)->is_index) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_index', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_unique') ? 'has-error' : '' }}">
    <label for="is_unique" class="col-md-2 control-label">Is Unique</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_unique_1">
                <input id="is_unique_1" class="" name="is_unique" type="checkbox" value="1"
                    {{ old('is_unique', optional($generatorTableField)->is_unique) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_unique', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_nullable') ? 'has-error' : '' }}">
    <label for="is_nullable" class="col-md-2 control-label">Is Nullable</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_nullable_1">
                <input id="is_nullable_1" class="" name="is_nullable" type="checkbox" value="1"
                    {{ old('is_nullable', optional($generatorTableField)->is_nullable) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_nullable', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_unsigned') ? 'has-error' : '' }}">
    <label for="is_unsigned" class="col-md-2 control-label">Is Unsigned</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_unsigned_1">
                <input id="is_unsigned_1" class="" name="is_unsigned" type="checkbox" value="1"
                    {{ old('is_unsigned', optional($generatorTableField)->is_unsigned) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_unsigned', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

@if($tableId == 0)

<div class="form-group {{ $errors->has('generator_table_id') ? 'has-error' : '' }}">
    <label for="generator_table_id" class="col-md-2 control-label">Generator Table</label>
    <div class="col-md-10">
        <select class="form-control" id="generator_table_id" name="generator_table_id">
            <option value="" style="display: none;"
                {{ old('generator_table_id', optional($generatorTableField)->generator_table_id ?: '') == '' ? 'selected' : '' }}
                disabled selected>Selectionner generator table</option>
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
