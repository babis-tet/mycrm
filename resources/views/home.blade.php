@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <p class="p-10 bg-red-100">Welcome to this beautiful admin panel....</p>
    <button class="btn btn-primary">Test</button>
@stop

@section('css')

@stop


@push('css')

@endpush

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
        $(document).ready(function(){
          $("button").click(function(){
                toastr["success"]("test", "test")
          });
});
    </script>
@stop
