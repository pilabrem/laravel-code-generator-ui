@extends('code-generator-ui::layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">Ajouter Generator Table</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('generator_tables.generator_table.index') }}" class="btn btn-primary" title="Afficher tous les Generator Table">
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

            <form method="POST" action="{{ route('generator_tables.generator_table.store') }}" accept-charset="UTF-8" id="create_generator_table_form" name="create_generator_table_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('code-generator-ui::generator_tables.form', [
                                        'generatorTable' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Ajouter">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


