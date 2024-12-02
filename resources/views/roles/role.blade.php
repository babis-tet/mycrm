@extends('adminlte::page')
@section('title', 'Ρόλοι')

@section('content')

<div class="card">
    <div class="card-header">
        @if ($action=='update')
            <h2><i class="fas fa-fw fa-user "></i> {{$record->name}}</h2>
        @endif
    </div>



    <div class="card-body">
        <form action="@if($action=='create'){{route('save_role')}}@else{{route('update_role', $record->id)}}@endif" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="title">Tίτλος *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('title', isset($record) ? $record->name : '') }}">
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            @foreach($permissions as $permission)
                <div>
                    <label for="{{$permission->id}}" class="block text-gray-700 text-sm">{{$permission->name}}
                        <input type="checkbox" name="permissions[]" value="{{$permission->name}}"  class="mr-2" data-name="{{$permission->name}}"  @if (in_array($permission->name,$current_permissions)) checked @endif>
                    </label>
                </div>
            @endforeach

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
