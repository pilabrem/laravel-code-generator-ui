
<div class="form-group {{ isset($errors) && $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($generatorTable)->name) }}" minlength="1" maxlength="255" placeholder="Entrer name ici...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('table_name') ? 'has-error' : '' }}">
    <label for="table_name" class="col-md-2 control-label">Table Name</label>
    <div class="col-md-10">
        <input class="form-control" name="table_name" type="text" id="table_name" value="{{ old('table_name', optional($generatorTable)->table_name) }}" minlength="1" placeholder="Entrer table name ici...">
        {!! $errors->first('table_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('with_migration') ? 'has-error' : '' }}">
    <label for="with_migration" class="col-md-2 control-label">With Migration</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="with_migration_1">
            	<input id="with_migration_1" class="" name="with_migration" type="checkbox" value="1" {{ old('with_migration', optional($generatorTable)->with_migration) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('with_migration', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('with_form_request') ? 'has-error' : '' }}">
    <label for="with_form_request" class="col-md-2 control-label">With Form Request</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="with_form_request_1">
            	<input id="with_form_request_1" class="" name="with_form_request" type="checkbox" value="1" {{ old('with_form_request', optional($generatorTable)->with_form_request) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('with_form_request', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('with_soft_delete') ? 'has-error' : '' }}">
    <label for="with_soft_delete" class="col-md-2 control-label">With Soft Delete</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="with_soft_delete_1">
            	<input id="with_soft_delete_1" class="" name="with_soft_delete" type="checkbox" value="1" {{ old('with_soft_delete', optional($generatorTable)->with_soft_delete) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('with_soft_delete', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('models_per_page') ? 'has-error' : '' }}">
    <label for="models_per_page" class="col-md-2 control-label">Models Per Page</label>
    <div class="col-md-10">
        <input class="form-control" name="models_per_page" type="text" id="models_per_page" value="{{ old('models_per_page', optional($generatorTable)->models_per_page) }}" min="-99999999999" max="99999999999" placeholder="Entrer models per page ici..." step="any">
        {!! $errors->first('models_per_page', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('translation_for') ? 'has-error' : '' }}">
    <label for="translation_for" class="col-md-2 control-label">Translation For</label>
    <div class="col-md-10">
        <input class="form-control" name="translation_for" type="text" id="translation_for" value="{{ old('translation_for', optional($generatorTable)->translation_for) }}" minlength="1" placeholder="Entrer translation for ici...">
        {!! $errors->first('translation_for', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('primary_key') ? 'has-error' : '' }}">
    <label for="primary_key" class="col-md-2 control-label">Primary Key</label>
    <div class="col-md-10">
        <input class="form-control" name="primary_key" type="text" id="primary_key" value="{{ old('primary_key', optional($generatorTable)->primary_key) }}" minlength="1" placeholder="Entrer primary key ici...">
        {!! $errors->first('primary_key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

