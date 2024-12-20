@extends('adminlte::page')
@section('title', 'Ρόλοι')

@section('content_header')
    <div class="flex gap-2">
        <h1>Ρόλοι</h1>
        <a class="btn btn-secondary" href="{{ route("role") }}">Προσθήκη</a>
    </div>
@stop

@section('content')
        <div class="dt-responsive table-responsive">
            <table id="mydatatable" class="mydatatable table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Όνομα</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
@stop

@section('css')
<link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
@stop

@section('js')
    @include('inc.mainjs')
    <script>
            initializeDataTable('{{route('role_records')}}', [
                {data: 'name', "type": "string"},
                {data: 'action', "type": "html"},
            ]);
    </script>
@stop
