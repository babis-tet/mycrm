@extends('adminlte::page')

@section('title', 'Δημιουργία Πετηλά')

@section('content')

    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-fw fa-user "></i> {{$action === "update" ? "Επεξεργασία" : "Δημιουργία Πελάτη"}}
                    </h2>
                </div>


                <div class="card-body" bis_skin_checked="1">

                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="general-tab" data-toggle="pill"
                                                href="#general" role="tab" aria-controls="general" aria-selected="true">Στοιχεία</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="contacts-tab" data-toggle="pill" href="#contacts"
                                                role="tab" aria-controls="contacts" aria-selected="false">Επαφές</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="offers-tab" data-toggle="pill" href="#offers"
                                                role="tab" aria-controls="offers" aria-selected="false">Προσφορές</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="agreements-tab" data-toggle="pill"
                                                href="#agreements" role="tab" aria-controls="agreements"
                                                aria-selected="false">Συμβόλαια</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" id="custom-content-below-tabContent" bis_skin_checked="1">

                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab" bis_skin_checked="1">

                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                                            <label for="company">Επωνυμία*</label>
                                            <input type="text" id="company" name="company" class="form-control"
                                                   value="{{ old('company', isset($record) ? $record->company : '') }}">
                                            @if($errors->has('company'))
                                                <p class="help-block">{{ $errors->first('company') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label for="email">Email*</label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                   value="{{ old('email', isset($record) ? $record->email : '') }}"
                                                   required>
                                            @if($errors->has('email'))
                                                <p class="help-block">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                                            <label for="vat">ΑΦΜ*</label>
                                            <input type="text" id="vat" name="vat" class="form-control"
                                                   value="{{ old('vat', isset($record) ? $record->vat : '') }}">
                                            @if($errors->has('vat'))
                                                <p class="help-block">{{ $errors->first('vat') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('street') ? 'has-error' : '' }}">
                                            <label for="street">Διεύθυνση</label>
                                            <input type="text" id="street" name="street" class="form-control"
                                                   value="{{ old('street', isset($record) ? $record->street : '') }}"
                                                   required>
                                            @if($errors->has('street'))
                                                <p class="help-block">{{ $errors->first('street') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                            <label for="zipcode">ΤΚ</label>
                                            <input type="text" id="zipcode" name="zipcode" class="form-control"
                                                   value="{{ old('zipcode', isset($record) ? $record->zipcode : '') }}">
                                            @if($errors->has('zipcode'))
                                                <p class="help-block">{{ $errors->first('zipcode') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            <label for="city">Πόλη</label>
                                            <input type="text" id="city" name="city" class="form-control"
                                                   value="{{ old('city', isset($record) ? $record->city : '') }}"
                                                   required>
                                            @if($errors->has('city'))
                                                <p class="help-block">{{ $errors->first('city') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                            <label for="phone">Τηλέφωνο*</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   value="{{ old('phone', isset($record) ? $record->phone : '') }}" required>
                                            @if($errors->has('phone'))
                                                <p class="help-block">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group {{ $errors->has('contact_id') ? 'has-error' : '' }}">
                                            <label for="contact_id">Προέλευση</label>
                                            <select class="form-control select2 contact_id" name="contact_id" id="contact_id"
                                                    required>
                                                <option value="">Επιλογή...</option>
                                                @foreach (\App\Models\Customer::all() as $t)
                                                    <option
                                                        value="{{$t->id}}" @if($action=='update' && ($record->contact_id==$t->id))
                                                        {{'selected'}}
                                                        @else
                                                        {{''}}
                                                        @endif> {{$t->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('contact_id') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group {{ $errors->has('contact_id') ? 'has-error' : '' }}">
                                            <label for="contact_id">Κατηγορία </label>
                                            <select class="form-control select2 contact_id" name="contact_id" id="contact_id"
                                                    required>
                                                <option value="">Επιλογή...</option>
                                                @foreach (\App\Models\Customer::all() as $t)
                                                    <option
                                                        value="{{$t->id}}" @if($action=='update' && ($record->contact_id==$t->id))
                                                        {{'selected'}}
                                                        @else
                                                        {{''}}
                                                        @endif> {{$t->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <p class="help-block">
                                                    {{ $errors->first('contact_id') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="comments">Σημειώσεις</label>
                                    <textarea id="comments" name="comments"
                                              class="form-control">{{ old('comments', isset($record) ? $record->comments : '') }}</textarea>
                                    <p class="helper-block"></p>
                                </div>

                                <div>
                                    <input class="btn btn-danger" type="submit" value="Αποθήκευση">
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab"
                             bis_skin_checked="1">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#largeModal">
                                Open Large Modal
                            </button>
                           @include('inc.modals.customer.contact')
                        </div>
                        <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab"
                             bis_skin_checked="1">
                            offers
                        </div>
                        <div class="tab-pane fade" id="agreements" role="tabpanel" aria-labelledby="agreements-tab"
                             bis_skin_checked="1">
                            agreements
                        </div>


                    </div>


                </div>

            </div>
        </div>

@endsection

@section('css')

@stop

@section('js')
    @include('inc.mainjs')
@stop
