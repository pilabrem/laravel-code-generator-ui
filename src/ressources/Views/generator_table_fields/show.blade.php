@extends('code-generator-ui::layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">
                <a href="{{route('generator_tables.generator_table.index')}}">Tables </a>
                <i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                {{$table}}
                <i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                {{ isset($generatorTableField->name) ? $generatorTableField->name : 'Generator Table Field' }}
            </h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('generator_table_fields.generator_table_field.destroy', $generatorTableField->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('generator_table_fields.generator_table_field.index', ['table' => $tableId]) }}" class="btn btn-primary" title="Afficher tous les Generator Table Field">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('generator_table_fields.generator_table_field.create', ['table' => $tableId]) }}" class="btn btn-success" title="Ajouter Generator Table Field">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('generator_table_fields.generator_table_field.edit', [$generatorTableField->id, 'table' => $tableId] ) }}" class="btn btn-primary" title="Modifier Generator Table Field">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Supprimer Generator Table Field" onclick="return confirm('Supprimer ce champ??')">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $generatorTableField->name }}</dd>
            <dt>Labels</dt>
            <dd>{{ $generatorTableField->labels }}</dd>
            <dt>Validation</dt>
            <dd>{{ $generatorTableField->validation }}</dd>
            <dt>Html Type</dt>
            <dd>{{ $generatorTableField->html_type }}</dd>
            <dt>Html Value</dt>
            <dd>{{ $generatorTableField->html_value }}</dd>
            <dt>Css Class</dt>
            <dd>{{ $generatorTableField->css_class }}</dd>
            <dt>Options</dt>
            <dd>{{ $generatorTableField->options }}</dd>
            <dt>Data Type</dt>
            <dd>{{ $generatorTableField->data_type }}</dd>
            <dt>Data Type Params</dt>
            <dd>{{ $generatorTableField->data_type_params }}</dd>
            <dt>Data Value</dt>
            <dd>{{ $generatorTableField->data_value }}</dd>
            <dt>Date Format</dt>
            <dd>{{ $generatorTableField->date_format }}</dd>
            <dt>Placeholder</dt>
            <dd>{{ $generatorTableField->placeholder }}</dd>
            <dt>Generator Table</dt>
            <dd>{{ optional($generatorTableField->generatorTable)->name }}</dd>

        </dl>

    </div>
</div>

@endsection
