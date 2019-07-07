@extends('code-generator-ui::layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">
                <a href="{{route('generator_tables.generator_table.index')}}">Tables </a>
                <i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                {{ isset($generatorTable->name) ? $generatorTable->name : 'Generator Table' }}
            </h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('generator_tables.generator_table.destroy', $generatorTable->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('generator_tables.generator_table.index') }}" class="btn btn-primary" title="Afficher tous les Generator Table">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('generator_tables.generator_table.create') }}" class="btn btn-success" title="Ajouter Generator Table">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('generator_tables.generator_table.edit', $generatorTable->id ) }}" class="btn btn-primary" title="Modifier Generator Table">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Supprimer Generator Table" onclick="return confirm(&quot;Supprimer Generator Table??&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $generatorTable->name }}</dd>
            <dt>Table Name</dt>
            <dd>{{ $generatorTable->table_name }}</dd>
            <dt>With Migration</dt>
            <dd>{{ ($generatorTable->with_migration) ? 'Yes' : 'No' }}</dd>
            <dt>With Form Request</dt>
            <dd>{{ ($generatorTable->with_form_request) ? 'Yes' : 'No' }}</dd>
            <dt>With Soft Delete</dt>
            <dd>{{ ($generatorTable->with_soft_delete) ? 'Yes' : 'No' }}</dd>
            <dt>Models Per Page</dt>
            <dd>{{ $generatorTable->models_per_page }}</dd>
            <dt>Translation For</dt>
            <dd>{{ $generatorTable->translation_for }}</dd>
            <dt>Primary Key</dt>
            <dd>{{ $generatorTable->primary_key }}</dd>

        </dl>

    </div>
</div>

@endsection
