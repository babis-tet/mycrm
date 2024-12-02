@extends('adminlte::page')
@section('title', 'Δικαιώματα')

@section('content_header')
    <div class="flex gap-2">
        <h1>Δικαιώματα</h1>
        <a class="btn btn-secondary" href="{{ route("permission") }}">Προσθήκη</a>
    </div>
@stop

@section('content')
        <div class="dt-responsive table-responsive">
            <table id="simpletable1" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Δικαιώματα</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
@stop

@section('css')
     <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')

    @include('inc.mainjs')

    <script>
        $( document ).ready(function() {


            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
              }
            })

            jQuery('#simpletable1').DataTable({
                "lengthMenu": [20, 50, 100],
                "pageLength": 50,
                "processing": true,
                "serverSide": true,
                "language": {
                    "lengthMenu": "Προβολή _MENU_ εγγραφών ανά σελίδα",
                    "zeroRecords": "Δεν βρέθηκε αποτέλεσμα",
                    "info": "Σελίδα _PAGE_ από _PAGES_",
                    "infoEmpty": "Κανένα αποτέλεσμα",
                    "infoFiltered": "(από τις _MAX_ συνολικές εγγραφές)",
                    "processing": '<strong>Φόρτωση δεδομένων...<br>Παρακαλώ περιμένετε</strong>',
                    "search": "αναζήτηση",
                    "paginate": {
                        "first":      "Πρώτη",
                        "last":       "Τελευταία",
                        "next":       "Επόμενη",
                        "previous":   "Προηγούμενη"
                    },
                },
                "ajax": {
                    'url': '{{route('permission_records')}}',
                    'type': "POST"
                },
                "columns": [
                    {data: 'name', "type": "string"},
                    {data: 'action', "type": "html"},
                ]
            })
         });
    </script>
@stop
