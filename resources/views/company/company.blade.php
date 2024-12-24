@extends('adminlte::page')
@section('title', 'Εταιρία')

@section('content_header')
@stop

@section('content')

    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h2>
                        <i class="fas fa-fw fa-user "></i> Αρχεία Εταιρίας
                    </h2>
                </div>
                <div class="card-body" bis_skin_checked="1">
                    <livewire:companyfiles />
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@push('css')

@endpush

@section('js')

@stop
