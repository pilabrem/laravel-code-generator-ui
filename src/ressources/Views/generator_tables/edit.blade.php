@extends('code-generator-ui::layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($generatorTable->name) ? $generatorTable->name : 'Generator Table' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('generator_tables.generator_table.index') }}" class="btn btn-primary" title="Afficher tous les Generator Table">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('generator_tables.generator_table.create') }}" class="btn btn-success" title="Ajouter Generator Table">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('generator_tables.generator_table.update', $generatorTable->id) }}" id="edit_generator_table_form" name="edit_generator_table_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('code-generator-ui::generator_tables.form', [
                                        'generatorTable' => $generatorTable,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Mettre à jour">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
