<script>
    var transactionTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {
        transactionTable = $('#transaction-table').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "searchDelay": 500,
            "responsive": true,
            "columns": [{
                    "data": "id",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "job"
                },
                {
                    "data": "job_sender"
                },
                {
                    "data": "job"
                },
                {
                    "data": "type"
                },
                {
                    "data": "transfer_in_no"
                },
                {
                    "data": "out_chep"
                },
                {
                    "data": "out_loscam"
                },
                {
                    "data": "job"
                },
            ],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>')
                            .text(
                                data).html() + '">';
                    }
                },
                {
                    'targets': 1,
                    'searchable': true,
                    'orderable': true,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return data?data.connote_no:'-';
                    }
                },
                {
                    'targets': 2,
                    'searchable': true,
                    'orderable': true,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return data?data.sender_name:'-';
                    }
                },
                {
                    'targets': 3,
                    'searchable': true,
                    'orderable': true,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return data?data.m_reference:'-';
                    }
                },
                {
                    'targets': 8,
                    'searchable': true,
                    'orderable': true,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return data?data.job_status:'-';
                    }
                },


            ],
        });

        // $.post("{{ route('pallet.index') }}", {
        //     "_token": "{{ csrf_token() }}",
        //     customer_id: customerId
        // }, function(data) {
        //     transactionTable.clear();
        //     transactionTable.rows.add(JSON.parse(data)).draw();
        //     addEvent();
        // });
        $.get("{{ route('get_pallet_transaction') }}", {
            "_token": "{{ csrf_token() }}"
        }, function(data) {
            // console.log("outstanding", JSON.parse(data));
            transactionTable.clear();
            transactionTable.rows.add(JSON.parse(data)).draw();
            // addEvent();
        });

        var updateRow;


        $('#transaction-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = transactionTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

    });
</script>
