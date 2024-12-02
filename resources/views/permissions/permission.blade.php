@extends('adminlte::page')

@section('title', 'Δικαιώματα')

@section('content')

<div class="card">
    <div class="card-header">
        @if ($action=='update')
            <h2><i class="fas fa-fw fa-user "></i> {{$record->title}}</h2>
        @endif
    </div>


    <div class="card-body">
        <form action="@if($action=='create'){{route('save_permission')}}@else{{route('update_permission', $record->id)}}@endif" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                <label for="title">Τίτλος *</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($record) ? $record->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Αποθήκευση">
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
     @include('inc.mainjs')
{{--     @include('inc.flashmessage')--}}
@stop
