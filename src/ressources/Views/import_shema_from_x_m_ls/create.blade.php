@extends('code-generator-ui::layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">
                    <a href="{{route('generator_tables.generator_table.index')}}">Tables </a>
                    <i style="color:#ddd;" class="glyphicon glyphicon-arrow-right"></i>
                    Import from XML [draw.io]
                </h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('import_shema_from_xmls.import_shema_from_xml.create') }}" class="btn btn-primary" title="Import schema from xml [draw.io]">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
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

            <form
                method="POST"
                action="{{ route('import_shema_from_xmls.import_shema_from_xml.store') }}"
                accept-charset="UTF-8"
                id="create_generator_table_field_form"
                name="create_generator_table_field_form"
                class="form-horizontal"
                enctype="multipart/form-data">
            {{ csrf_field() }}


                <div class="form-group {{ $errors->has('xml_file') ? 'has-error' : '' }}">
                    <label for="xml_file" class="col-md-2 control-label">XML File</label>
                    <div class="col-md-10">
                        <div class="input-group uploaded-file-group">
                            <label class="input-group-btn">
                                <span class="btn btn-default">
                                    Browse <input type="file" name="xml_file" id="xml_file" class="hidden">
                                </span>
                            </label>
                            <input type="text" class="form-control uploaded-file-name" readonly>
                        </div>

                        @if (isset($importShemaFromXML->xml_file) && !empty($importShemaFromXML->xml_file))
                            <div class="input-group input-width-input">
                                <span class="input-group-addon">
                                    <input type="checkbox" name="custom_delete_xml_file" class="custom-delete-file" value="1" {{ old('custom_delete_xml_file', '0') == '1' ? 'checked' : '' }}> Delete
                                </span>

                                <span class="input-group-addon custom-delete-file-name">
                                    {{ $importShemaFromXML->xml_file }}
                                </span>
                            </div>
                        @endif
                        {!! $errors->first('xml_file', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Import">
                    </div>
                </div>

                <div class="form-group">
                    <h3 style="text-align: center;">Your diagrams.net's UML diagram must follow these conditions</h3>
                    <ul>
                        <li>Classes must not have a methods part</li>
                        <li>You must export your diagram without compression</li>
                        <li>Example: </li>
                    </ul>
                </div>
                <div class="form-group img img-responsive" style="max-width: 100%;">
                    <img src="{{ asset('vendor/code-generator-ui/class-diagram-model.png') }}" alt="class-diagram-model" width="100%;">
                </div>

            </form>

        </div>
    </div>

@endsection


