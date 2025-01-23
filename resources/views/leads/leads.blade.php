@extends('adminlte::page')
@section('title', 'Leads')

@section('content_header')
    <div class="flex gap-2">
        <h1>Leads</h1>
        <a class="btn btn-secondary" href="{{ route("leads.create") }}">Προσθήκη</a>
        <a class="btn btn-secondary" data-toggle="modal" data-target="#leadsImportModal"><i class="fas fa-file-excel"></i>&nbsp; Import</a>
    </div>
@stop

@section('content')
         <div class="dt-responsive table-responsive">
            <table id="mydatatable" class="mydatatable table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Επωνυμία</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>

        @include('inc.modals.lead.leadimport')
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
            initializeDataTable('{{route('leads_records')}}', [
                { data: 'name', "type": "string" },
                { data: 'email', "type": "string" },
                { data: 'action', "type": "html" }
            ]);

            $(document).ready(function () {
                $('#uploadfile').on('click', function (e) {
                    e.preventDefault();
                    let formData = new FormData();
                    let fileInput = $('#customerInputFile')[0].files[0];

                    if (!fileInput) {
                        toastr.error('Please select a file.', 'Error');
                        return;
                    }

                    formData.append('file', fileInput);

                    $.ajax({
                        url: '/leads/import', // Adjust this URL to your backend route
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Add CSRF token if necessary
                        },
                        success: function (response) {
                            // Success toast
                            toastr.success(response.message, 'Success');

                            // Skipped records toast
                            if (response.skipped ) {
                                toastr.warning(response.skipped, 'Skipped Records');
                            }

                            // Errors toast
                            if (response.errors && response.errors.length > 0) {
                                response.errors.forEach(error => {
                                    toastr.error(`Row: ${JSON.stringify(error.row)} - ${error.error}`, 'Error');
                                });
                            }

                            $('#leadsImportModal').modal('hide');
                        },
                        error: function (xhr) {
                            // Error toast
                            toastr.error(xhr.responseJSON.message || 'An unexpected error occurred.', 'Error');
                        }
                    });
                });
            });
    </script>
@stop
