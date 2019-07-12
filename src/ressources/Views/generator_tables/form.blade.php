<div class="row">
    <div class="form-group {{ isset($errors) && $errors->has('name') ? 'has-error' : '' }} col-sm-3 one-line"
        style="margin-left: 1%;">
        <label for="name" class="control-label required">Name </label>
        <div class="">
            <input class="form-control" name="name" type="text" id="name" required
                value="{{ old('name', optional($generatorTable)->name) }}">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('table_name') ? 'has-error' : '' }} col-sm-3 one-line"
        style="margin-left: 1%;">
        <label for="table_name" class="control-label">Custom Table Name</label>
        <div class="">
            <input class="form-control" name="table_name" type="text" id="table_name"
                value="{{ old('table_name', optional($generatorTable)->table_name) }}">
            {!! $errors->first('table_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('models_per_page') ? 'has-error' : '' }} col-sm-2 one-line"
        style="margin-left: 1%;">
        <label for="models_per_page" class="control-label">Paginate</label>
        <div class="">
            <input class="form-control" name="models_per_page" type="text" id="models_per_page"
                value="{{ old('models_per_page', isset($generatorTable) ? $generatorTable->models_per_page : 10) }}"
                step="any">
            {!! $errors->first('models_per_page', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('translation_for') ? 'has-error' : '' }} col-sm-2 one-line"
        style="margin-left: 1%;">
        <label for="translation_for" class="control-label">Translations</label>
        <div class="">
            <input class="form-control" name="translation_for" type="text" id="translation_for"
                value="{{ old('translation_for', optional($generatorTable)->translation_for) }}"
                placeholder="Ex. en,fr">
            {!! $errors->first('translation_for', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('primary_key') ? 'has-error' : '' }} col-sm-2 one-line"
        style="margin-left: 1%;">
        <label for="primary_key" class="control-label">Primary Key</label>
        <div class="">
            <input class="form-control" name="primary_key" type="text" id="primary_key"
                value="{{ old('primary_key', optional($generatorTable)->primary_key) }}">
            {!! $errors->first('primary_key', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-inline form-group" style="margin-left: 1%;">
    <label for="txtModelName" style="margin-right: 1%;">Options</label>

    <div class="checkbox {{ $errors->has('with_migration') ? 'has-error' : '' }}"
        style="margin-left: 1%; margin-bottom:5px;">
        <label for="with_migration_1">
            <input id="with_migration_1" class="" name="with_migration" type="checkbox" value="1"
                {{ old('with_migration', isset($generatorTable) ? $generatorTable->with_migration : '1') == '1' ? 'checked' : '' }}>
            With migration
        </label>
        {!! $errors->first('with_migration', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="checkbox {{ $errors->has('with_soft_delete') ? 'has-error' : '' }}"
        style="margin-left: 1%; margin-bottom:5px;">
        <label for="with_soft_delete_1">
            <input id="with_soft_delete_1" class="" name="with_soft_delete" type="checkbox" value="1"
                {{ old('with_soft_delete', optional($generatorTable)->with_soft_delete) == '1' ? 'checked' : '' }}>
            With soft delete
        </label>
        {!! $errors->first('with_soft_delete', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="checkbox {{ $errors->has('with_form_request') ? 'has-error' : '' }}"
        style="margin-left: 1%; margin-bottom:5px;">
        <label for="with_form_request_1">
            <input id="with_form_request_1" class="" name="with_form_request" type="checkbox" value="1"
                {{ old('with_form_request', optional($generatorTable)->with_form_request) == '1' ? 'checked' : '' }}>
            With form request
        </label>
        {!! $errors->first('with_form_request', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group" style="margin-top: 7px">
    <div class="form-control" style="border-color: transparent;padding-left: 2%">
        <label style="font-size: 18px;">Fields</label>
    </div>
</div>

<div class="table-responsive">
    <table class="table" id="table">
        <thead class="no-border">
            <tr>
                <th class="required">Field Name</th>
                <th>Label</th>
                <th>Placeholder</th>
                <th>DB Type</th>
                <th>Html Type</th>
                <th>Validations</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="container" class="no-border-x no-border-y ui-sortable">
            @isset($generatorTableFields)
            @foreach ($generatorTableFields as $generatorTableField)
            <tr class="form-inline">
                <td>
                    <input type="hidden" name="id[]" value="{{old('id', optional($generatorTableField)->id)}}">
                    <input type="text" name="field_name[]" style="width: 100%"
                        value="{{old('field_name', optional($generatorTableField)->name)}}" class="form-control"
                        required>
                </td>
                <td>
                    <input type="text" name="labels[]" style="width: 100%" class="form-control"
                        value="{{old('labels', optional($generatorTableField)->labels)}}">
                </td>
                <td>
                    <input type="text" name="placeholder[]"
                        value="{{old('placeholder', optional($generatorTableField)->placeholder)}}" style="width: 100%"
                        class="form-control">
                </td>
                <td>
                    <select class="form-control data_type" id="data_type" name="data_type[]" style="width:70%">
                        @foreach ($dataTypes as $key => $text)
                        <option value="{{ $key }}"
                            {{ old('data_type', optional($generatorTableField)->data_type) == $key ? 'selected' : '' }}>
                            {{ $text }}
                        </option>
                        @endforeach
                    </select>
                    <input type="text" name="data_type_params[]"
                        value="{{old('data_type_params', optional($generatorTableField)->data_type_params)}}"
                        style="width: 28%" class="form-control" placeholder="Size: Ex. 20">
                    <input type='text' name='date_format[]'
                        value="{{old('date_format', optional($generatorTableField)->date_format)}}" class='form-control'
                        style='width: 28%' class='form-control' placeholder='Ex. Y-m-d'>
                </td>
                <td>
                    <select class="form-control html_type" id="html_type" name="html_type[]" style="width: 100%">
                        @foreach ($htmlTypes as $key => $text)
                        <option value="{{ $key }}"
                            {{ old('html_type', optional($generatorTableField)->html_type) == $key ? 'selected' : '' }}>
                            {{ $text }}
                        </option>
                        @endforeach
                    </select>
                    <input type="text" name="options[]"
                        value="{{old('options', optional($generatorTableField)->options)}}" style="width: 100%"
                        class="form-control" placeholder="Ex. Male|Female">
                </td>
                <td>
                    <input type="text" name="validation[]" style="width: 100%" class="form-control"
                        value="{{old('validation', optional($generatorTableField)->validation)}}">
                </td>
                <td>

                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
</div>

<div class="form-inline col-md-6" style="padding-top: 10px">
    <button type="button" class="btn btn-success btn-flat btn-green" id="btnAdd"> Add Field </button>
</div>

<div class="form-inline form-group col-md-6" style="padding:15px 15px;text-align: right">
    <button type="submit" class="btn btn-flat btn-primary btn-blue" id="btnGenerate">Save Table Model</button>
</div>
