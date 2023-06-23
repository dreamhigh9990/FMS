<script>
    var contactTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {
        contactTable = $('#contact-table').DataTable({
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
                    "data": "contact_name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "mobile_phone"
                },
                {
                    "data": "office_phone"
                },
                {
                    "data": "email"
                },
                {
                    "data": "alerts"
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
                    'targets': 6,
                    'searchable': true,
                    'orderable': true,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return data?'Yes':'No';
                    }
                },
                {
                    'targets': 7,
                    'searchable': false,
                    'orderable': false,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return ` <a title="Edit Contact" class="btn btn-sm btn-clean btn-icon edit-contact">
                           <i class="icon-1x text-dark-50 flaticon-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-clean btn-icon del-contact" title="Delete Contact" >
                            <i class="icon-1x text-dark-50 flaticon-delete"></i>
                        </a>
                        `;
                    }
                }
            ],
        });

        $.post("{{ route('get_customer_contacts') }}", {
            "_token": "{{ csrf_token() }}",
            customer_id: customerId
        }, function(data) {
            contactTable.clear();
            contactTable.rows.add(JSON.parse(data)).draw();
            addEvent();
        });

        var addContactForms = ['contact_name', 'position', 'mobile_phone', 'office_phone',
            'email', 'alerts', 'id'
        ];

        function getFormData() {
            var res = [];
            res = addContactForms.map(e => {
                return $('#updateContactForm #' + e).val();
            })
            return res;
        }

        function clearFormData() {
            addContactForms.map(e => {
                return $('#updateContactForm #' + e).val('');
            });
        }

        function setFormData(contactData) {
            $('#contact_name').val(contactData['contact_name']);
            $('#position').val(contactData['position']);
            $('#mobile_phone').val(contactData['mobile_phone']);
            $('#office_phone').val(contactData['office_phone']);
            $('#email').val(contactData['email']);
            $('#alerts').val(contactData['alerts']);
            $('#updateContactForm #id').val(contactData['id']);
        }

        var index = 0;
        var updateRow;

        function addEvent() {
            $('.del-contact').click(function() {
                if (customerId) {
                    var rowObj = contactTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_contact') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                }else{
                        contactTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });
            $('.edit-contact').click(function() {
                updateRow = contactTable.row($(this).parents('tr'));
                formData = updateRow.data();

                setFormData(formData);
                console.log(contactTable
                    .row($(this).parents('tr')).data());
                $('#contactModalLabel').html('Update Contact');
                $('.update_contact_btn').html('Update');
                $("#contactModal").modal('show');
            });
        }


        $('.update_contact_btn').click(function() {
            $("#contactModal").modal('hide');
            var vals = getFormData();
            if ($('.update_contact_btn').html() == 'Add') {
                if (customerId) {
                    var formData = $("#updateContactForm").serialize();
                    formData +="&customer_id="+customerId;
                    console.log(formData);
                    $.post("{{ route('customer_contacts.store') }}", formData, function(data) {
                        console.log("res",data);
                        contactTable.row.add(JSON.parse(data)).draw(false);
                        addEvent();
                    });
                }else{
                    contactTable.row.add({
                        id: index,
                        contact_name: vals[0],
                        position: vals[1],
                        mobile_phone: vals[2],
                        office_phone: vals[3],
                        email: vals[4],
                        alerts: vals[5],
                    }).draw(false);
                    index++;
                    addEvent();
                }

            } else {
                if (customerId) {
                    var formData = $("#updateContactForm").serialize();
                    $.post("{{ route('update_contact') }}", formData, function(data) {
                        console.log("res",data);
                        formData = updateRow.data();
                        updateRow.data(JSON.parse(data));
                        addEvent();
                    });
                }else{
                    formData = updateRow.data();
                    updateRow.data({
                        id: formData['id'],
                        contact_name: vals[0],
                        position: vals[1],
                        mobile_phone: vals[2],
                        office_phone: vals[3],
                        email: vals[4],
                        alerts: vals[5],
                    });
                    addEvent();
                }
            }

        });

        $('#add_contact_btn').click(function() {
            clearFormData();
            $('#contactModalLabel').html('Add Contact');
            $('.update_contact_btn').html('Add');
            $("#contactModal").modal('show');
        });

        $('#del_contact_btn').click(function() {
            $('input[name^="id"]:checked').each(function() {
                if (customerId) {
                    var rowObj = contactTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_contact') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                }else{
                        contactTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });
        });

        $('#contact-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = contactTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // $('#alerts').select2({
        //     placeholder: "Select a option"
        // });
    });
</script>
