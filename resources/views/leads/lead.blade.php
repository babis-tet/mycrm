@extends('adminlte::page')

@section('title', 'Δημιουργία Lead')

@section('content')

    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-fw fa-user "></i> {{isset($lead) ? "Επεξεργασία" : "Δημιουργία Lead"}}
                    </h2>
                </div>


                <div class="card-body" bis_skin_checked="1">
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true"> <i class="fas fa-fw fa-user "></i> Στοιχεία</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content" id="custom-content-below-tabContent" bis_skin_checked="1">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab" bis_skin_checked="1">

                            <form
                                action="{{ isset($lead) ? route('leads.update', $lead) : route('leads.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($lead))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">Επωνυμία *</label>
                                            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                   value="{{ old('name', isset($lead) ? $lead->name : '') }}">
                                            @if($errors->has('name'))
                                                <p class="error invalid-feedback">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label for="email">Email *</label>
                                            <input type="text" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                   value="{{ old('email', isset($lead) ? $lead->email : '') }}"
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
                                                   value="{{ old('vat', isset($lead) ? $lead->vat : '') }}">
                                            @if($errors->has('vat'))
                                                <p class="error invalid-feedback">{{ $errors->first('vat') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">Δραστηριότητα *</label>
                                            <input type="text" id="activity" name="activity" class="form-control {{ $errors->has('activity') ? 'is-invalid' : '' }}"
                                                   value="{{ old('activity', isset($lead) ? $lead->activity : '') }}"
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
                                                   value="{{ old('address', isset($lead) ? $lead->address : '') }}"
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
                                                   value="{{ old('zipcode', isset($lead) ? $lead->zipcode : '') }}">
                                            @if($errors->has('zipcode'))
                                                <p class="error invalid-feedback">{{ $errors->first('zipcode') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="city">Πόλη</label>
                                            <input type="text" id="city" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                   value="{{ old('city', isset($lead) ? $lead->city : '') }}"
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
                                                   value="{{ old('phone', isset($lead) ? $lead->phone : '') }}">
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
                                                        value="{{$t->id}}" @if(isset($lead) && ($lead->source_id==$t->id))
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
                                                        value="{{$t->id}}" @if(isset($lead) && ($lead->category_id==$t->id))
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
                                              class="form-control">{{ old('notes', isset($lead) ? $lead->notes : '') }}</textarea>
                                    <p class="helper-block"></p>
                                </div>

                                <div>
                                    <input class="btn btn-danger" type="submit" value="Αποθήκευση">
                                </div>
                            </form>

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
