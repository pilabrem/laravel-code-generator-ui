@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Tables</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('generator_tables.generator_table.create') }}" class="btn btn-success" title="Ajouter Generator Table">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($generatorTables) == 0)
            <div class="panel-body text-center">
                <h4>Aucune Table Trouvée!</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Table Name</th>
                            <th>With Migration</th>
                            <th>With Form Request</th>
                            <th>With Soft Delete</th>
                            <th>Models Per Page</th>
                            <th>Translation For</th>
                            <th>Primary Key</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($generatorTables as $generatorTable)
                        <tr>
                            <td>{{ $generatorTable->name }}</td>
                            <td>{{ $generatorTable->table_name }}</td>
                            <td>{{ ($generatorTable->with_migration) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($generatorTable->with_form_request) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($generatorTable->with_soft_delete) ? 'Yes' : 'No' }}</td>
                            <td>{{ $generatorTable->models_per_page }}</td>
                            <td>{{ $generatorTable->translation_for }}</td>
                            <td>{{ $generatorTable->primary_key }}</td>

                            <td>

                                <form method="POST" action="{!! route('generator_tables.generator_table.destroy', $generatorTable->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('generator_table_fields.generator_table_field.index', ['table'=>$generatorTable->id]) }}" class="btn btn-info" title="Gérer la table">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('generator_tables.generator_table.edit', $generatorTable->id ) }}" class="btn btn-primary" title="Modifier la Table">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Supprimer la Table" onclick="return confirm('Supprimer la Table?')">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $generatorTables->render() !!}
        </div>

        @endif

    </div>
@endsection
