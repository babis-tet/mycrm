@extends('adminlte::page')
@section('title', 'Χρήστες')

@section('content_header')
    <div class="flex gap-2">
        <h1>Χρήστες</h1>
        <a class="btn btn-secondary" href="{{ route("user") }}">Προσθήκη</a>
    </div>
@stop

@section('content')
         <div class="dt-responsive table-responsive">
            <table id="mydatatable" class="mydatatable table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Χρήστης</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@push('css')
{{--<link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">--}}
@endpush

@section('js')
    @include('inc.mainjs')
    <script>
            initializeDataTable('{{route('user_records')}}', [
                { data: 'name', "type": "string" },
                { data: 'email', "type": "string" },
                { data: 'action', "type": "html" }
            ]);
    </script>
@stop
