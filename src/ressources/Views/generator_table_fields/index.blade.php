@extends('code-generator-ui::layouts.app')

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

@if(Session::has('cmd'))
<div class="alert alert-warning">
    {!! session('cmd') !!}

    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif

<div class="panel panel-default">

    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5"><a href="{{route('generator_tables.generator_table.index')}}">
                    Tables </a><i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                @isset($table) {{$table}} @else Champs @endisset</h4>
        </div>

        <div class="btn-group btn-group-sm pull-right" role="group">
            <a href="{{ route('generator_table_fields.generator_table_field.create', ['table' => $tableId]) }}"
                class="btn btn-success" title="Add field">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
            <a href="{{ route('generator_table_fields.generator_table_field.config', $tableId) }}"
                class="btn btn-info" title="Create resource file">
                <span class="glyphicon glyphicon-flash" aria-hidden="true"> </span>
            </a>
            <a href="{{ route('generator_table_fields.generator_table_field.resources', $tableId) }}"
                class="btn btn-warning" title="Scaffold">
                <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
            </a>
            <a href="{{ route('generator_table_fields.generator_table_field.resources', [$tableId, 'option' => 'migrate']) }}"
                class="btn btn-danger" title="Scaffold And migrate">
                <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
            </a>
        </div>

    </div>

    @if(count($generatorTableFields) == 0)
    <div class="panel-body text-center">
        <h4>No field found in this table model!</h4>
    </div>
    @else
    <div class="panel-body panel-body-with-table">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Labels</th>
                        <th>Html Type</th>
                        <th>Data Type</th>
                        <th>Data Type Params</th>
                        <th>Date Format</th>
                        <th>Placeholder</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($generatorTableFields as $generatorTableField)
                    <tr>
                        <td>{{ $generatorTableField->name }}</td>
                        <td>{{ $generatorTableField->labels }}</td>
                        <td>{{ $generatorTableField->html_type }}</td>
                        <td>{{ $generatorTableField->data_type }}</td>
                        <td>{{ $generatorTableField->data_type_params }}</td>
                        <td>{{ $generatorTableField->date_format }}</td>
                        <td>{{ $generatorTableField->placeholder }}</td>

                        <td>

                            <form method="POST"
                                action="{!! route('generator_table_fields.generator_table_field.destroy', $generatorTableField->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('generator_table_fields.generator_table_field.show', [$generatorTableField->id, 'table' => $tableId]) }}"
                                        class="btn btn-info" title="Show field details">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('generator_table_fields.generator_table_field.edit', [$generatorTableField->id, 'table' => $tableId] ) }}"
                                        class="btn btn-primary" title="Edit field">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Remove Field from Table Model"
                                        onclick="return confirm('Delete this field?')">
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
        {!! $generatorTableFields->render() !!}
    </div>

    @endif

</div>
@endsection
