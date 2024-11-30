<script>

    function initializeDataTable(url, columns) {
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            jQuery('#mydatatable').DataTable({
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
                    "processing": '<strong>Φόρτωση..</strong>',
                    "search": "αναζήτηση",
                    "paginate": {
                        "first": "Πρώτη",
                        "last": "Τελευταία",
                        "next": "Επόμενη",
                        "previous": "Προηγούμενη"
                    }
                },
                "ajax": {
                    'url': url,
                    'type': "POST"
                },
                "columns": columns
            });
        });
}
</script>
