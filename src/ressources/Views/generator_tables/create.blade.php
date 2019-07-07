@extends('code-generator-ui::layouts.app')

@section('content')

<?php
    $dataTypes = [
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
];

$htmlTypes = [
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
];

$generatorTableField = null;
$generatorTable = null;

?>
<div class="panel panel-default">

    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">
                <a href="{{route('generator_tables.generator_table.index')}}">Tables </a>
                <i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                New Table
            </h4>
        </span>

        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('generator_tables.generator_table.index') }}" class="btn btn-primary"
                title="Afficher tous les Generator Table">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
        </div>

    </div>

    <div class="panel-body">

        @if (isset($errors) && $errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('generator_tables.generator_table.store') }}" accept-charset="UTF-8"
            id="create_generator_table_form" name="create_generator_table_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('code-generator-ui::generator_tables.form', [
            'generatorTable' => null,
            'generatorTableField' => null,
            'generatorTableFields' => null,
            ])
            {{--
                <div class="form-inline">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Ajouter">
                    </div>
                </div> --}}

        </form>

    </div>
</div>

@endsection

@section('script')
<script>
    // Initialiser le formulaire
    displayDataTypeParams($('.data_type'));
    displayOptions($('.html_type'));

    // Gérer l'affichage du champ datatype params selon la valeur de data type
    $('#table').on('change', '.data_type', function name(event) {
        displayDataTypeParams($(this));
    });

    // Gérer l'affichage du champ options selon la valeur de html type
    $('#table').on('change', '.html_type', function name(event) {
        displayOptions($(this));
    });

    // Display Data Type Params depending on data type
    function displayDataTypeParams(el) {
        var data_type = el.val();
        var arrParams = ['char', 'varchar', 'string'];
        var arrFormat = ['date', 'datetime', 'datetimetz'];
        if ($.inArray(data_type, arrParams) > -1) {
            var paramsEl = el.next('input').first();
            var formatEl = el.next('input').first().next('input').first();
            paramsEl.show();
            formatEl.hide();
        } else if ($.inArray(data_type, arrFormat) > -1) {
            var paramsEl = el.next('input').first();
            var formatEl = el.next('input').first().next('input').first();
            paramsEl.hide();
            formatEl.show();
        } else {
            var paramsEl = el.next('input').first();
            var formatEl = el.next('input').first().next('input').first();
            paramsEl.hide();
            formatEl.hide();
        }
    }

    // Display options field depending on html type
    function displayOptions(el) {
        var html_type = el.val();
        var arr = ['select', 'multipleSelect', 'radio', 'checkbox'];
        if ($.inArray(html_type, arr) > -1) {
            var optionsEl = el.next('input').first();
            optionsEl.show();
        } else {
            var optionsEl = el.next('input').first();
            optionsEl.hide();
        }
    }

    $(document).ready(function () {
        // attribute tr
        var tr = "<tr class='form-inline'> <td><input type='hidden' name='id[]' value='{{old('id', optional($generatorTableField)->id)}}'><input type='text' name='field_name[]' style='width: 100%' required class='form-control'></td>";
            tr += "<td><input type='text' name='labels[]' style='width: 100%' class='form-control'></td>";
            tr += "<td><input type='text' name='placeholder[]' style='width: 100%' class='form-control'></td>";
            tr += "<td><select class='form-control data_type' id='data_type' name='data_type[]' style='width:70%;'>@foreach ($dataTypes as $key => $text)<option value='{{ $key }}'{{ old('data_type', isset($generatorTableField) ? $generatorTableField->data_type : 'string') == $key ? 'selected' : '' }}>{{ $text }}</option>@endforeach</select><input type='text' name='data_type_params[]' style='width: 30%' class='form-control' placeholder='Size'><input type='text' name='date_format[]' class='date_format form-control' style='width: 30%;' class='form-control' placeholder='Format'></td>";
            tr += "<td><select class='form-control html_type' id='html_type' name='html_type[]' style='width: 100%'>@foreach ($htmlTypes as $key => $text)<option value='{{ $key }}'{{ old('html_type', optional($generatorTableField)->html_type) == $key ? 'selected' : '' }}>{{ $text }}</option>@endforeach</select><input type='text' name='options[]' style='width: 100%' class='form-control'placeholder='Ex. Male|Female'></td>";
            tr += "<td><input type='text' name='validation[]' style='width: 100%' class='form-control'></td>";
            tr += "<td> <a class='remove-tr btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a> </td></tr>";

        // id Attribute tr
        var pkTr = "<tr class='form-inline'> <td><input type='hidden' name='id[]'><input type='text' name='field_name[]' style='width: 100%' required class='form-control' value='id' readonly></td>";
            pkTr += "<td><input type='text' name='labels[]' style='width: 100%' class='form-control' readonly></td>";
            pkTr += "<td><input type='text' name='placeholder[]' style='width: 100%' class='form-control' readonly></td>";
            pkTr += "<td><select class='form-control data_type' id='data_type' name='data_type[]' readonly style='width:100%'>@foreach ($dataTypes as $key => $text)<option value='{{ $key }}'{{ old('data_type', isset($generatorTableField) ? $generatorTableField->data_type : 'unsignedInteger') == $key ? 'selected' : '' }}>{{ $text }}</option>@endforeach</select><input type='text' name='data_type_params[]' style='width: 100%' class='form-control' placeholder='Size' readonly><input type='hidden' name='date_format[]'></td>";
            pkTr += "<td><select class='form-control html_type' id='html_type' name='html_type[]' readonly style='width: 100%'>@foreach ($htmlTypes as $key => $text)<option value='{{ $key }}'{{ old('html_type', isset($generatorTableField) ? $generatorTableField->html_type : 'number') == $key ? 'selected' : '' }}>{{ $text }}</option>@endforeach</select><input type='text' name='options[]' style='width: 100%' class='form-control'placeholder='Ex. Male|Female' readonly></td>";
            pkTr += "<td><input type='text' name='validation[]' style='width: 100%' class='form-control' readonly></td>";
            pkTr += "<td> <a class='remove-tr btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a> </td></tr>";

        var table = $("#table");

        // Add new attribute
        $("#btnAdd").on('click', function (event) {
            table.append(tr);
            var lastTr = $('#table tr').filter(':last');
            displayDataTypeParams(lastTr.children('td').children('.data_type').first());
            displayOptions(lastTr.children('td').children('.html_type').first());
            // Scroll down
            $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        });

        // Add the id primary key
        $("#btnPrimary").on('click', function (event) {
            table.append(pkTr);
            var lastTr = $('#table tr').filter(':last');
            displayDataTypeParams(lastTr.children('td').children('.data_type').first());
            displayOptions(lastTr.children('td').children('.html_type').first());
            // Scroll down
            $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
        });

        // Remove attribute when close button is clicked
        table.on('click', '.remove-tr', function (event) {
            var trToRemove = $(this).closest('tr');
            trToRemove.animate({'line-height':0, height:0},1000).hide(1).remove();
        });

    });

</script>
@endsection
