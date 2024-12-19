@extends('adminlte::page')

@section('title', 'Δημιουργία Πελάτη')

@section('content')

    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-fw fa-user "></i> {{isset($customer) ? "Επεξεργασία" : "Δημιουργία Πελάτη"}}
                    </h2>
                </div>


                <div class="card-body" bis_skin_checked="1">
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true"> <i class="fas fa-fw fa-user "></i> Στοιχεία</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contacts-tab" data-toggle="pill" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false"><i class="fas fa-fw fa-users "></i> Επαφές</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="offers-tab" data-toggle="pill" href="#offers" role="tab" aria-controls="offers" aria-selected="false"><i class="fas fa-fw fa-paste"></i> Προσφορές</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="agreements-tab" data-toggle="pill" href="#agreements" role="tab" aria-controls="agreements" aria-selected="false"><i class="fas fa-fw fa-handshake"></i> Συμβόλαια</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" id="custom-content-below-tabContent" bis_skin_checked="1">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab" bis_skin_checked="1">

                            <form
                                action="{{ isset($customer) ? route('customers.update', $customer) : route('customers.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($customer))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">Επωνυμία *</label>
                                            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                   value="{{ old('name', isset($customer) ? $customer->name : '') }}">
                                            @if($errors->has('name'))
                                                <p class="error invalid-feedback">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label for="email">Email *</label>
                                            <input type="text" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                   value="{{ old('email', isset($customer) ? $customer->email : '') }}"
                                            >
                                            @if($errors->has('email'))
                                                <p class="error invalid-feedback">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="vat">ΑΦΜ *</label>
                                            <input type="text" id="vat" name="vat" class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}"
                                                   value="{{ old('vat', isset($customer) ? $customer->vat : '') }}">
                                            @if($errors->has('vat'))
                                                <p class="error invalid-feedback">{{ $errors->first('vat') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">Δραστηριότητα *</label>
                                            <input type="text" id="activity" name="activity" class="form-control {{ $errors->has('activity') ? 'is-invalid' : '' }}"
                                                   value="{{ old('activity', isset($customer) ? $customer->activity : '') }}"
                                            >
                                            @if($errors->has('activity'))
                                                <p class="error invalid-feedback">{{ $errors->first('activity') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="address">Διεύθυνση</label>
                                            <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                   value="{{ old('address', isset($customer) ? $customer->address : '') }}"
                                            >
                                            @if($errors->has('address'))
                                                <p class="error invalid-feedback">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="zipcode">ΤΚ</label>
                                            <input type="text" id="zipcode" name="zipcode" class="form-control {{ $errors->has('zipcode') ? 'is-invalid' : '' }}"
                                                   value="{{ old('zipcode', isset($customer) ? $customer->zipcode : '') }}">
                                            @if($errors->has('zipcode'))
                                                <p class="error invalid-feedback">{{ $errors->first('zipcode') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="city">Πόλη</label>
                                            <input type="text" id="city" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                   value="{{ old('city', isset($customer) ? $customer->city : '') }}"
                                            >
                                            @if($errors->has('city'))
                                                <p class="error invalid-feedback">{{ $errors->first('city') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="phone">Τηλέφωνο </label>
                                            <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                   value="{{ old('phone', isset($customer) ? $customer->phone : '') }}">
                                            @if($errors->has('phone'))
                                                <p class="error invalid-feedback">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="source_id">Προέλευση</label>
                                            <select class="form-control select2 source_id" name="source_id"
                                                    id="source_id"
                                            >
                                                <option value="">Επιλογή...</option>
                                                @foreach (\App\Models\Source::all() as $t)
                                                    <option
                                                        value="{{$t->id}}" @if(isset($customer) && ($customer->source_id==$t->id))
                                                        {{'selected'}}
                                                        @else
                                                        {{''}}
                                                        @endif> {{$t->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('source_id'))
                                                <p class="error invalid-feedback">
                                                    {{ $errors->first('source_id') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="category_id">Κατηγορία Πελάτη</label>
                                            <select class="form-control select2 contact_id" name="category_id"
                                                    id="category_id"
                                            >
                                                <option value="">Επιλογή...</option>
                                                @foreach (\App\Models\CustomerCategory::all() as $t)
                                                    <option
                                                        value="{{$t->id}}" @if(isset($customer) && ($customer->category_id==$t->id))
                                                        {{'selected'}}
                                                        @else
                                                        {{''}}
                                                        @endif> {{$t->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('contact_id'))
                                                <p class="error invalid-feedback">
                                                    {{ $errors->first('category_id') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="notes">Σημειώσεις</label>
                                    <textarea id="notes" name="notes"
                                              class="form-control">{{ old('notes', isset($customer) ? $customer->notes : '') }}</textarea>
                                    <p class="helper-block"></p>
                                </div>

                                <div>
                                    <input class="btn btn-danger" type="submit" value="Αποθήκευση">
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab" bis_skin_checked="1">
                            <livewire:test-component id="{{$customer->id}}" />
                            {{--                           @include('inc.modals.customer.contact')--}}
                        </div>
                        <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab" bis_skin_checked="1">
                            offers
                        </div>
                        <div class="tab-pane fade" id="agreements" role="tabpanel" aria-labelledby="agreements-tab" bis_skin_checked="1">
                            agreements
                        </div>
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
