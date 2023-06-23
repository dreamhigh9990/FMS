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

                <h3 class="card-label">Freight List</h3>

                {{-- <a style="margin-left: 20px" href="{{ route('create_job_status') }}"
                    class="btn btn-primary font-weight-bolder mr-2">Update status</a> --}}
                <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#updateStatusModal">
                    Update Status
                </button>

                <!-- Modal -->
                <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog"
                    aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateStatusModalLabel">Update Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="updateStatusForm">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mx-3 my-5">
                                                {{-- <div id="connote_wraper">
                                                    <div class="form-group row">
                                                        <label class="col-4">Connote Number</label>
                                                        <div class="col-7">
                                                            <input type="text" class="form-control" value="" id="connote_no"
                                                                name='connote_no[]' placeholder="Please enter Cannote number" />
                                                        </div>
                                                    </div>
                                                </div> --}}


                                                <div class="form-group row ">
                                                    <label class="col-form-label col-3">Job Status</label>
                                                    <div class="col-5">
                                                        <select class="form-control job_status select1" id="kt_select2_1"
                                                            name="job_status" >

                                                            <option value="">-none-</option>
                                                            @foreach ($all_statuses as $status)
                                                                <option value="{{ $status->id }}"
                                                                    {{ old('status') == $status->id ? 'selected' : '' }}>
                                                                    {{ $status->job_status }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Please select Job Status</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row ">
                                                    <label class="col-form-label col-lg-3 col-sm-12">Current Branch</label>
                                                    <div class=" col-5">
                                                        <select class="form-control select1 current_branch" name="current_branch" id="current_branch" >
                                                            <option value="">-none-</option>
                                                            @foreach ($all_branches as $branch)
                                                                <option value="{{ $branch->id }}"
                                                                    {{ old('current_branch') == $branch->id ? 'selected' : '' }}>
                                                                    {{ $branch->branches }}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="invalid-feedback">Please select Branch</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-3 col-sm-12">Job Type</label>
                                                    <div class="col-5">
                                                        <select class="form-control  job_type " name="job_type">
                                                            <option value="" selected>-none-</option>
                                                            <option value="general"
                                                                {{ isset($job) && $job->job_type == 'general' ? 'selected' : '' }}>
                                                                General</option>
                                                            <option value="express"
                                                                {{ isset($job) && $job->job_type == 'express' ? 'selected' : '' }}>
                                                                Express</option>
                                                            <option value="hotshot"
                                                                {{ isset($job) && $job->job_type == 'hotshot' ? 'selected' : '' }}>
                                                                Hotshot</option>
                                                            <option value="special"
                                                                {{ isset($job) && $job->job_type == 'special' ? 'selected' : '' }}>
                                                                Special</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select Job Type</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-3 col-sm-12">Assign Driver</label>
                                                    <div class=" col-5">
                                                        <select class="form-control assigned_driver" id="kt_select2_2"
                                                            name="assigned_driver">
                                                            <option value="" selected>-none-</option>
                                                            @foreach ($all_drivers as $driver)
                                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="invalid-feedback">Please select Assign Driver</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-3">Ready Date</label>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" value="{{ old('arrival_date') }}"
                                                            id="kt_datepicker_4" name='ready_date' placeholder="ready date" />
                                                        <div class="invalid-feedback">Please select Delivered Date</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-3">Delivered Date</label>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" value="{{ old('arrival_date') }}"
                                                            id="kt_datepicker_3" name='arrival_date' placeholder="arrival date" />
                                                        <div class="invalid-feedback">Please select Delivered Date</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="updateStatus()">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="btn btn-danger font-weight-bolder" onclick="del_selected()" href="javascript:void(0)"> <i
                        class="la la-trash-o mr-2"></i>Delete All</a>

            </div>
            <div class="card-toolbar" style="margin-left:-26px;">

                <!--begin::Button-->
                <a href="{{ route('jobs.create') }}" class="btn btn-primary font-weight-bolder">
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
                    </span>New Record</a>
                    {{-- <a href="{{ route('jobs_email','14') }}">Email</a> --}}
                <!--end::Button-->
            </div>
            <div style="display: inline-grid; margin-left:1100px; margin-top:6px;">
                    @foreach ($all_statuses as $status)
                            <div style="display: inline-flex;">
                                <div style="width: 12px;height: 12px; background-color: {{ $status->status_color?$status->status_color:'grey' }};margin-left: 10px"></div>
                                <h5 style="margin-top: 0px;margin-left: 10px; font-size:12px;">{{ $status->job_status }}</h5>
                            </div>
                    @endforeach
                    <hr style='width:100%;'/>
                    <div style="display: inline-flex;">
                        <div style="width: 12px;height: 12px; background-color: #ffff08;margin-left: 10px"></div>
                        <h5 style="margin-top: 0px;margin-left: 10px; font-size:12px;">24h past due date</h5>
                    </div>
                    <div style="display: inline-flex;">
                        <div style="width: 12px;height: 12px; background-color: red;margin-left: 10px"></div>
                        <h5 style="margin-top: 0px;margin-left: 10px; font-size:12px;">48h past due date</h5>
                    </div>

            </div>
        </div>
        <div class="card-body">

            @include('admin.partials._messages')

            <div>
                <form action="{{ route('admin.delete-selected-freights') }}" method="post" id="freight_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table table-bordered table-hover table-checkable" id="freight" style="margin-top: 13px !important">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox checkbox-outline checkbox-success"><input
                                            type="checkbox"><span></span></label>

                                </th>
                                <th>Connote No</th>
                                <th>E-Connote</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Sender Branch</th>
                                <th>Reciever Branch</th>
                                <th>Current Branch</th>
                                <th>ETD Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </form>

                {{-- </form> --}}
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
                        <h4 class="modal-title" id="myModalLabel">Freight Detail</h4>
                    </div>
                    {{-- <div class="modal-body"></div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
				  </div> --}}
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

    <style>
        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button1 {
            border-radius: 2px;
        }

        .button2 {
            border-radius: 4px;
        }

        .button3 {
            border-radius: 8px;
        }

        .button4 {
            border-radius: 12px;
        }

        .button5 {
            border-radius: 50%;
        }

    </style>
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script> --}}
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
        $(function() {
            console.log("123");
            $('#freight thead tr').addClass('filters');
            $('#freight thead tr')
                .clone(true)
                // .removeClass('filters')
                .appendTo('#freight thead');

            $('#freight').DataTable({
                "order": [
                    [1, 'asc']
                ],
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": {
                    "url": "{{ route('admin.getFreight') }}",
                    "dataType": "json",
                    "type": "GET",
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
                        "data": "connote_no",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "e_connote",
                        "searchable": true,
                        "orderable": true
                    },
                    {
                        "data": "job_status"
                    },
                    {
                        "data": "customer"
                    },
                    {
                        "data": "sender_branch"
                    },
                    {
                        "data": "receiver_branch"
                    },
                    {
                        "data": "current_branch"
                    },
                    {
                        "data": "created_at",
                        "orderable": true
                    },
                    {
                        "data": "action",
                        "searchable": false,
                        "orderable": false
                    },

                ],
                "complete": function(xhr, responseText) {
                    console.log(xhr);
                    console.log(responseText); //*** responseJSON: Array[0]
                },
                "initComplete": function() {
                    var api = this.api();
                    $('#freight_filter').prepend(`
                        <span>Active: </span>
                        <span class='switch switch-outline switch-icon switch-success d-inline mr-4'>
                            <label style='margin-bottom:-13px;'>
                                <input type='checkbox'  id='active_check' name='active' value='1'>
                                <span></span>
                            </label>
                        </span>
                    `);

                    $('#active_check ').change(function() {
                        console.log(this.checked);
                        api
                            .column(0)
                            .search(
                                this.checked?1:0,
                                false,
                                true
                            )
                            .draw();
                    });


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
                                $(cell).html('<input type="text" class="form-control" style="width:120px;" placeholder="' + title + '" />');

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

        });

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
                        "Your Job has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/admin/jobs/delete/" + id;
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
                        "Your Freights has been deleted.",
                        "success"
                    );
                    $("#freight_form").submit();
                }
            });
        }
    </script>

    <script>
        // Class definition
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                // basic

                $('#job_status').select2({
                    placeholder: "Select a job status"
                });
            }


            // Public functions
            return {
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSelect2.init();
        });
    </script>

    <script>
        //Class Definition
        var KTBootstrapDatepicker = function() {
            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }
            //Private functions
            var demos = function() {
                $('#kt_datepicker_3').datepicker({
                    format: 'dd-mm-yyyy'
                });
                $('#kt_datepicker_4').datepicker({
                    format: 'dd-mm-yyyy'
                });
            }
            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();
        jQuery(document).ready(function() {
            KTBootstrapDatepicker.init();
        });
    </script>
    <script>
        function updateStatus() {
            var formData = $("#updateStatusForm, #freight_form").serialize();
            $.post("{{ route('update_job_status_bulk') }}", formData, function(data) {
                $("#updateStatusModal").modal('hide');
                $.toast({
                    heading: 'Update Job Status',
                    text: data.message,
                    hideAfter: 3000,
                    position: 'top-right',
                    icon: data.status ? 'success' : 'warning'
                })

                $('#freight').DataTable().ajax.reload();
            });
        }
    </script>
@endsection
