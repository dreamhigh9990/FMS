@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon-users text-primary"></i>
                </span>
                <h3 class="card-label">Customer List</h3>
                <div class="d-flex align-items-center ">
                    <a class="btn btn-danger font-weight-bolder" onclick="del_selected()" href="javascript:void(0)"> <i
                            class="la la-trash-o"></i>Delete All</a>
                    <a class="btn btn-success font-weight-bolder ml-3" onclick="open_syncDlg()" href="javascript:void(0)">
                        <i class="la la-link"></i>Sync Xero</a>


                    <div class="modal fade" id="syncXero" tabindex="-1" role="dialog" aria-labelledby="syncXeroLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="syncXeroLabel">Update Xero Customer Contacts</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="syncXeroForm">
                                        <div class="row">
                                            <div class="col-12">
                                                <ul id="update_contacts_list">
                                                </ul>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="syncXero()">Sync</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-toolbar">

                <!--begin::Button-->
                <a href="{{ route('customers.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>New Customer</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            @include('admin.partials._messages')
            <div>
                <form action="{{ route('admin.delete-selected-customers') }}" method="post" id="client_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable" id="customers"
                        style="margin-top: 13px !important">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox checkbox-outline checkbox-success"><input
                                            type="checkbox"><span></span></label>

                                </th>

                                <th>Title</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Payment terms</th>
                                <th>Suburb</th>
                                <th>Generate Invoices</th>
                                <th>Xero Link</th>
                                <th>Invoice Export</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </form>
                <!--end: Datatable-->
            </div>
        </div>
        <!-- Modal-->
        <div class="modal fade" id="clientModel" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Customer Detail</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <script>
        $(document).on('click', 'th input:checkbox', function() {

            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function() {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });

        $('#customers thead tr').addClass('filters');
        $('#customers thead tr')
            .clone(true)
            // .removeClass('filters')
            .appendTo('#customers thead');

        var clients = $('#customers').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "responsive": true,
            "ajax": {
                "url": "{{ route('admin.getCustomers') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?php echo csrf_token(); ?>"
                }
            },
            "columns": [{
                    "data": "id",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "name"
                },
                {
                    "data": "plan"
                },
                {
                    "data": "active"
                },
                {
                    "data": "payment_term",
                },
                {
                    "data": "suburb",
                },
                {
                    "data": "gen_invoice_chk",
                    "orderable": true,
                    "searchable": true,
                },
                {
                    "data": "xero_link_chk",
                    "orderable": true,
                    "searchable": true,
                },
                {
                    "data": "invoice_export",
                    "orderable": true,
                    "searchable": true,
                },
                {
                    "data": "created_at",
                    "orderable": false
                },
                {
                    "data": "action",
                    "searchable": false,
                    "orderable": false
                }
            ],
            "complete": function(xhr, responseText) {
                console.log(xhr);
                console.log(responseText); //*** responseJSON: Array[0]
            },
            "initComplete": function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        if (colIdx == 0 || colIdx == 9) {
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            cell.html('');
                        }
                        if (colIdx > 0 && colIdx < 9) {

                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html(
                                '<input type="text" class="form-control" style="width:120px;" placeholder="' +
                                title + '" />');

                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
                                    e.stopPropagation();

                                    // console.log(e);
                                    // if(e.keyCode==13){
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '{search}'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '' + this.value +
                                                '') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                    // }
                                });
                        }
                    });
            },
        });

        function viewInfo(id) {

            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getCustomer') }}", {
                _token: CSRF_TOKEN,
                id: id
            }).done(function(response) {
                $('.modal-body').html(response);
                $('#clientModel').modal('show');

            });
        }

        function del(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your customer has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/admin/customer/delete/" + id;
                }
            });
        }

        function syncXero() {
            var selected = [];
            $('.xero_contact:checked').each(function() {
                selected.push($(this).val());
            });


            var syncData = xeroContacts.filter(e => selected.indexOf(e.ContactID) >= 0)
            console.log("checked:", selected, syncData);

            $.ajax({
                url: `{{ route('sync_xero_contacts') }}`,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "contacts": JSON.stringify(syncData)
                },
                success: function(data) {
                    if (data) {
                        // console.log("DDDDDDDDDDDDDD", data);
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/customers";
                    }
                }
            });

        }

        var xeroContacts = [];

        function open_syncDlg() {
            $('#syncXero').modal('show');
            $('#update_contacts_list').html('Waiting...');
            $.ajax({
                url: `{{ route('get_xero_contacts') }}`,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    if (data) {
                        if (!data.status) {
                            var APP_URL = {!! json_encode(url('/')) !!}
                            window.location.href = APP_URL + "/admin/xero/connect";
                        }
                        console.log("DDDDDDDDDDDDDD", data);
                        xeroContacts = data.contacts;

                        customers = data.customers.map(customer => {
                            if (customer.xero_data) {
                                contact = JSON.parse(customer.xero_data);
                                customer['contactID'] = contact.ContactID;
                                var index = xeroContacts.findIndex(e => e.ContactID == customer[
                                    'contactID']);
                                if (index >= 0) {
                                    xeroContacts[index]['dbID'] = customer['id'];
                                }
                            } else {
                                customer['contactID'] = ''
                            }
                        });

                        console.log(xeroContacts);
                        xeroContacts.sort((a, b) => (a['Name'].toUpperCase() < b['Name'].toUpperCase()) ? -1 : 1);

                        $('#update_contacts_list').html('');
                        xeroContacts.map(contact => {
                            $('#update_contacts_list').append(`<li style="display: flex;     padding: 5px;">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" class="xero_contact" value="${contact.ContactID}" checked><span></span>
                                    &nbsp;${contact.Name}
                                    </label>
                                <span class="label ` + (contact.dbID ? 'label-success' : 'label-danger') +
                                ` label-inline mr-2">` + (contact.dbID ? 'Update' : 'New') + `</span>
                            </li>`);
                        })
                    }
                }
            });
        }

        function del_selected() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your customers has been deleted.",
                        "success"
                    );
                    $("#client_form").submit();
                }
            });
        }
    </script>
@endsection
