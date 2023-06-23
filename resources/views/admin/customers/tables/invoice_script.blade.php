<script>
    var invoiceTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {

        invoiceTable = $('#invoice-table').DataTable({
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
                    "data": "invoice_no"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "consignment"
                },
                {
                    "data": "sender"
                },
                {
                    "data": "receiver"
                },
                {
                    "data": "delivery_date"
                },
                {
                    "data": "amount"
                },
                {
                    "data": null,
                    "searchable": false,
                    "orderable": false
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
                    'targets': 2,
                    'searchable': true,
                    'orderable': true,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        let date =new Date(data)
                        return date.toISOString().slice(0, 10);
                    }
                },
                {
                    'targets': 8,
                    'searchable': false,
                    'orderable': false,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return ` <a title="Edit Invoice" class="btn btn-sm btn-clean btn-icon edit-invoice">
                           <i class="icon-1x text-dark-50 flaticon-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-clean btn-icon del-invoice" title="Delete Invoice" >
                            <i class="icon-1x text-dark-50 flaticon-delete"></i>
                        </a>
                        `;
                    }
                }
            ],
        });

        $.post("{{ route('get_customer_invoices') }}", {
            "_token": "{{ csrf_token() }}",
            customer_id: customerId
        }, function(data) {
            invoiceTable.clear();
            invoiceTable.rows.add(JSON.parse(data)).draw();
            addEvent();
        });

        var addInvoiceForms = ['invoice_no', 'consignment', 'sender',
            'receiver', 'delivery_date', 'amount', 'id'
        ];

        function getFormData() {
            var res = [];
            res = addInvoiceForms.map(e => {
                return $('#updateInvoiceForm #' + e).val();
            })
            return res;
        }

        function clearFormData() {
            addInvoiceForms.map(e => {
                return $('#updateInvoiceForm #' + e).val('');
            });
        }

        function setFormData(invoiceData) {
            $('#invoice_no').val(invoiceData['invoice_no']);
            $('#updateInvoiceForm #consignment').val(invoiceData['consignment']);
            $('#updateInvoiceForm #sender').val(invoiceData['sender']);
            $('#updateInvoiceForm #receiver').val(invoiceData['receiver']);
            $('#updateInvoiceForm #delivery_date').val(invoiceData['delivery_date']);
            $('#updateInvoiceForm #amount').val(invoiceData['amount']);
            $('#updateInvoiceForm #id').val(invoiceData['id']);
        }

        var index = 0;
        var updateRow;

        function addEvent() {
            $('.del-invoice').click(function() {
                if (customerId) {
                    var rowObj = invoiceTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_invoice') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                } else {
                    invoiceTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });
            $('.edit-invoice').click(function() {
                updateRow = invoiceTable.row($(this).parents('tr'));
                formData = updateRow.data();

                setFormData(formData);
                console.log(invoiceTable
                    .row($(this).parents('tr')).data());
                $('#invoiceModalLabel').html('Update Invoice');
                $('.update_invoice_btn').html('Update');
                $("#invoiceModal").modal('show');
            });
        }


        $('.update_invoice_btn').click(function() {
            $("#invoiceModal").modal('hide');
            var vals = getFormData();
            if ($('.update_invoice_btn').html() == 'Add') {
                if (customerId) {
                    var formData = $("#updateInvoiceForm").serialize();
                    formData += "&customer_id=" + customerId;
                    console.log(formData);
                    $.post("{{ route('customer_invoices.store') }}", formData, function(data) {
                        console.log("res", data);
                        invoiceTable.row.add(JSON.parse(data)).draw(false);
                        addEvent();
                    });
                } else {
                    invoiceTable.row.add({
                        id: index,
                        invoice_no: vals[0],
                        consignment: vals[1],
                        sender: vals[2],
                        receiver: vals[3],
                        delivery_date: vals[4],
                        amount: vals[5],
                    }).draw(false);
                    index++;
                    addEvent();
                }
            } else {
                if (customerId) {
                    var formData = $("#updateInvoiceForm").serialize();
                    $.post("{{ route('update_invoice') }}", formData, function(data) {
                        console.log("res", data);
                        formData = updateRow.data();
                        updateRow.data(JSON.parse(data));
                        addEvent();
                    });
                } else {
                    formData = updateRow.data();
                    updateRow.data({
                        id: formData['id'],
                        invoice_no: vals[0],
                        consignment: vals[1],
                        sender: vals[2],
                        receiver: vals[3],
                        delivery_date: vals[4],
                        amount: vals[5],
                    });
                    addEvent();
                }
            }

        });

        $('#add_invoice_btn').click(function() {
            clearFormData();
            $('#invoiceModalLabel').html('Add Invoice');
            $('.update_invoice_btn').html('Add');
            $("#invoiceModal").modal('show');
        });

        $('#del_invoice_btn').click(function() {
            $('input[name^="id"]:checked').each(function() {
                if (customerId) {
                    var rowObj = invoiceTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_invoice') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                } else {
                    invoiceTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });
        });

        $('#invoice-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = invoiceTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    });
</script>
