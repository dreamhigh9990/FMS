<script>
    var siteTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {

        $.post("{{ route('get_customer_sites') }}", {
            "_token": "{{ csrf_token() }}",
            customer_id: customerId
        }, function(data) {
            siteTable.clear();
            siteTable.rows.add(JSON.parse(data)).draw();
            addEvent();
        });

        siteTable = $('#site-table').DataTable({
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
                    "data": "site_name"
                },
                {
                    "data": "address_line_1"
                },
                {
                    "data": "address_line_2"
                },
                {
                    "data": "address_line_3"
                },
                {
                    "data": "address_line_4"
                },
                {
                    "data": "suburb"
                },
                {
                    "data": "postal_code"
                },
                {
                    "data": "state"
                },
                {
                    "data": "operating_hours"
                },
                {
                    "data": "site_contact"
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
                    'targets': 11,
                    'searchable': false,
                    'orderable': false,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return ` <a title="Edit Site" class="btn btn-sm btn-clean btn-icon edit-site">
                           <i class="icon-1x text-dark-50 flaticon-edit"></i>
                        </a>
                        <a class="btn btn-sm btn-clean btn-icon del-site" title="Delete Site" >
                            <i class="icon-1x text-dark-50 flaticon-delete"></i>
                        </a>
                        `;
                    }
                }
            ],
        });

        var addSiteForms = ['site_name', 'address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'suburb',
            'postal_code', 'state', 'operating_hours', 'site_contact', 'id'
        ];

        function getFormData() {
            var res = [];
            res = addSiteForms.map(e => {
                return $('#updateSiteForm #' + e).val();
            })
            return res;
        }

        function clearFormData() {
            addSiteForms.map(e => {
                return $('#updateSiteForm #' + e).val('');
            });
        }

        function setFormData(siteData) {
            $('#site_name').val(siteData['site_name']);
            $('#address_line_1').val(siteData['address_line_1']);
            $('#address_line_2').val(siteData['address_line_2']);
            $('#address_line_3').val(siteData['address_line_3']);
            $('#address_line_4').val(siteData['address_line_4']);
            $('#operating_hours').val(siteData['operating_hours']);
            $('#postal_code').val(siteData['postal_code']);
            $('#site_contact').val(siteData['site_contact']);
            $('#state').val(siteData['state']);
            $('#suburb').val(siteData['suburb']);
            $('#updateSiteForm #id').val(siteData['id']);
        }
        var index = 0;
        var updateRow;

        function addEvent() {
            $('.del-site').click(function() {
                if (customerId) {
                    var rowObj = siteTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_site') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                }else{
                        siteTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });
            $('.edit-site').click(function() {
                updateRow = siteTable.row($(this).parents('tr'));
                formData = updateRow.data();

                setFormData(formData);
                console.log(siteTable
                    .row($(this).parents('tr')).data());
                $('#siteModalLabel').html('Update Site');
                $('.update_site_btn').html('Update');
                $("#siteModal").modal('show');
            });
        }
        $('.update_site_btn').click(function() {
            $("#siteModal").modal('hide');
            var vals = getFormData();
            if ($('.update_site_btn').html() == 'Add') {
                if (customerId) {
                    var formData = $("#updateSiteForm").serialize();
                    formData +="&customer_id="+customerId;
                    console.log(formData);
                    $.post("{{ route('customer_sites.store') }}", formData, function(data) {
                        console.log("res",data);
                        siteTable.row.add(JSON.parse(data)).draw(false);
                        addEvent();
                    });
                }else{
                    siteTable.row.add({
                        id: index,
                        site_name: vals[0],
                        address_line_1: vals[1],
                        address_line_2: vals[2],
                        address_line_3: vals[3],
                        address_line_4: vals[4],
                        suburb: vals[5],
                        postal_code: vals[6],
                        state: vals[7],
                        operating_hours: vals[8],
                        site_contact: vals[9],
                    }).draw(false);
                    index++;
                    addEvent();
                }

            } else {
                if (customerId) {
                    var formData = $("#updateSiteForm").serialize();
                    $.post("{{ route('update_site') }}", formData, function(data) {
                        console.log("res",data);
                        formData = updateRow.data();
                        updateRow.data(JSON.parse(data));
                        addEvent();
                    });
                }else{
                    formData = updateRow.data();
                    updateRow.data({
                        id: formData['id'],
                        site_name: vals[0],
                        address_line_1: vals[1],
                        address_line_2: vals[2],
                        address_line_3: vals[3],
                        address_line_4: vals[4],
                        suburb: vals[5],
                        postal_code: vals[6],
                        state: vals[7],
                        operating_hours: vals[8],
                        site_contact: vals[9],
                    });
                    addEvent();
                }
            }

        });

        $('#add_site_btn').click(function() {
            clearFormData();
            $('#siteModalLabel').html('Add Site');
            $('.update_site_btn').html('Add');
            $("#siteModal").modal('show');
        });

        $('#del_site_btn').click(function() {
            $('input[name^="id"]:checked').each(function() {
                if (customerId) {
                    var rowObj = siteTable.row($(this).parents('tr'));
                    rowData = rowObj.data();
                    rowData['_token'] = "{{ csrf_token() }}";
                    $.post("{{ route('delete_site') }}", rowData, function(data) {
                        rowObj.remove().draw();
                    });
                }else{
                        siteTable
                        .row($(this).parents('tr'))
                        .remove()
                        .draw();
                }
            });

        });

        $('#site-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = siteTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });
    });
</script>
