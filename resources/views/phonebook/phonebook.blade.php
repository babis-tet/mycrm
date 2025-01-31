@extends('adminlte::page')
@section('title', 'Κατάλογος')

@section('content_header')

@stop

@section('content')
    <livewire:phonebook /> <!-- Include the Livewire component -->
@stop

@section('css')

@stop


@push('css')
<style>

    .widget-user .widget-user-header {
        height: auto;
    }

    .alphabet-switcher {
        padding-top:20px;
        text-align: center;
    }

    .alphabet-switcher button.selected {
        background-color: #333a40;
        color: white;
        padding:10px;
    }

    .letters {
        display: flex;
        justify-content: center;
        gap: 10px;
        /*width: 500px;*/
        flex-wrap: wrap;
        padding-right: 10px;
        width: 100%;
        margin-top: 10px;
    }

    .letters button {
        padding: 10px;
        font-size: 16px;
        border: 1px solid;
    }
    .letters button.selected {
        background-color: #333a40;
        color: white;
    }

    .phonebook-contacts {
       display: flex;
       flex-wrap: wrap;
       gap: 10px;
       margin-top: 20px;
    }

    .phonebook-contacts .phonebook-contact {
        border: 1px solid;
        padding: 20px;
        display: flex;
    }

    .contactinfo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /*.phonebook-contact div {*/
    /*    display: flex;*/
    /*    flex-direction: column;*/
    /*    gap: 20px;*/
    /*}*/
</style>
@endpush

@section('js')

@stop
