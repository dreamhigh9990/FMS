<script>
    var outstandingTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {
        outstandingTable = $('#outstanding-table').DataTable({
            // "order": [
            //     [1, 'desc']
            // ],
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
                    "data": null
                },
                {
                    "data": "in_chep"
                },
                {
                    "data": "in_loscam"
                }
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
                        // console.log("adsfsdf:",data.connote_no);
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
                        return '-';
                    }
                },
                // {
                //     'targets': 6,
                //     'searchable': true,
                //     'orderable': true,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         return data?'Yes':'No';
                //     }
                // },
                // {
                //     'targets': 7,
                //     'searchable': false,
                //     'orderable': false,
                //     'width': 200,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         return ` <a title="Edit Outstanding" class="btn btn-sm btn-clean btn-icon edit-outstanding">
                //            <i class="icon-1x text-dark-50 flaticon-edit"></i>
                //         </a>
                //         <a class="btn btn-sm btn-clean btn-icon del-outstanding" title="Delete Outstanding" >
                //             <i class="icon-1x text-dark-50 flaticon-delete"></i>
                //         </a>
                //         `;
                //     }
                // }
            ],
        });

        $.get("{{ route('get_pallet_outstanding') }}", {
            "_token": "{{ csrf_token() }}"
        }, function(data) {
            console.log("outstanding", JSON.parse(data));
            outstandingTable.clear();
            outstandingTable.rows.add(JSON.parse(data)).draw();
            // addEvent();
        });

        var updateRow;

        $('#outstanding-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = outstandingTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

    });
</script>
