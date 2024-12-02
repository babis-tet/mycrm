@extends('adminlte::page')

@section('title', 'Δημιουργία Χρήστη')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
{{--            <h1>{{$action === "update" ? "Επεξεργασία Χρήστη" : "Δημιουργία Χρήστη"}}</h1>--}}
          </div>
          <div class="col-sm-6">
{{--            <ol class="breadcrumb float-sm-right">--}}
{{--              <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--              <li class="breadcrumb-item active">General Form</li>--}}
{{--            </ol>--}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                    <h2><i class="fas fa-fw fa-user "></i> {{$action === "update" ? "Επεξεργασία Χρήστη" : "Δημιουργία Χρήστη"}}</h2>
            </div>

            <div class="card-body">
                <form action="@if($action=='create'){{route('save_user')}}@else{{route('update_user', $record->id)}}@endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Όνομα *</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($record) ? $record->name : '') }}">
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>

                   <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email*</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email', isset($record) ? $record->email : '') }}" required>
                        @if($errors->has('email'))
                            <p class="help-block">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" required>
                        @if($errors->has('password'))
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
                        <label for="role_id">Ρόλος * </label>
                        <select class="form-control select2" name="role_id">
                            <option value="">Επιλογή...</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" @if (in_array($role->name,$current)) selected @endif >{{$role->name}} </option>
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                            <p class="help-block">
                                {{ $errors->first('role_id') }}
                            </p>
                        @endif
                    </div>



                    <div>
                        <input class="btn btn-danger" type="submit" value="Αποθήκευση">
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Log</h3>
              </div>

        <div class="card-body">
                <div class="dt-responsive table-responsive">
                        <table id="mydatatable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Desciption</th>
                                    <th>Changes</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        </table>
                </div>
        </div>
    </div>

@endsection

@section('css')

@stop

@section('js')
    @include('inc.mainjs')
    <script>
            initializeDataTable('{{route('user.activity')}}', [
                { data: 'user', "type": "string" },
                { data: 'description', "type": "string" },
                { data: 'changes', "type": "html" },
                { data: 'date', "type": "string" }
            ]);
    </script>
@stop
