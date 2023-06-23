@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Manage Jobs</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href=""
                                    class="text-muted">{{ isset($job) && isset($job->id) ? 'Edit Job' : 'Add Job' }}</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <!--begin::Container-->

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <!--begin::Card-->
        <div class="card card-custom card-sticky" id="kt_page_sticky_card">
            <div class="card-header" style="">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($job) && isset($job->id) ? 'Job Edit Form' : 'Job Add Form' }}
                        <i class="mr-2"></i>
                        <small class="">try to scroll the page</small>
                    </h3>

                </div>
                <div class="card-toolbar">
                    <a href="javascript:void(0)" onclick="onPrintConnote()"
                        class="btn btn-light-primary font-weight-bolder mr-2">
                        <i class="ki ki-bold-sort icon-sm"></i>Print Connote</a>
                    <a href="javascript:void(0)" onclick="onPrintLabel()"
                        class="btn btn-light-primary font-weight-bolder mr-2">
                        <i class="ki ki-bold-sort icon-sm"></i>Print Label</a>

                    <a href="{{ route('freight-index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                        <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                    <div class="btn-group">
                        <a href="javascript:void(0)" onclick="onSubmitForm()" id="kt_btn"
                            class="btn btn-primary font-weight-bolder">
                            <i
                                class="ki ki-check icon-sm"></i>{{ isset($job) && isset($job->id) ? 'Update' : 'Save' }}</a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('admin.partials._messages')
                <!--begin::Form-->
                {{-- {{ Form::open(['route' => 'jobs.store', 'class' => 'form','target'=>'_blank' 'id' => 'job_add_form', 'enctype' => 'multipart/form-data']) }} --}}
                <form action="{{route('jobs.store')}}"  class="form" target='_blank' id="job_add_form" method="post" target='_blank' enctype="multipart/form-data">


                @csrf

                <input type="hidden" name="jid" value="{{isset($job) ? ($job->id):''}}">
                <input type="hidden" name="jsender" value="{{isset($job) ? ($job->job_sender->id):''}}">
                <input type="hidden" name="jreceiver" value="{{isset($job) ? ($job->job_receiver->id):''}}">
                <input type="hidden" name="jload_restraints" value="{{isset($job)&&isset($job->job_load_restraints) ? ($job->job_load_restraints->id):''}}">
                <input type="hidden" name="jpallet_control" value="{{isset($job)&&isset($job->job_pallet_control) ? ($job->job_pallet_control->id):''}}">
                <input type="hidden" name="jtotal_price" value="{{isset($job)&&isset($job->job_total_price) ? ($job->job_total_price->id):''}}">

                <div style="padding: 40px;border: 2px solid lightgray;background-color:#ebedeb">

                    <div class="form-group row container-fluid valid-forms">
                        <div class="col-sm">
                            <label style="width:auto">Job No:</label>
                            <input readonly type="text" name="job_no" class="form-control"
                                value="{{ isset($job) && isset($job->id) ? $job->job_no : $job_no }}" />
                        </div>
                        <div class="col-sm">
                            <label>Connote No:</label>
                            <input readonly type="text" name="connote_no" class="form-control"
                                value="{{ isset($job) && isset($job->id) ? $job->connote_no : $connote_no }}" />
                        </div>
                        <div class="col-sm">
                            <label>Manual Conn No:</label>
                            <input type="text" name="m_connote_no" class="form-control"
                                value="{{ isset($job) && isset($job->id) ? $job->m_connote_no : '' }}" />
                        </div>
                        <div class="col-sm">
                            <label>Quote No:</label>
                            <input type="text" name="quote_no" class="form-control"
                                value="{{ isset($job) && isset($job->id) ? $job->quote_no : '' }}" />
                        </div>
                        <div class="col-sm valid-forms">
                            <label>Job Type <span style="color: red;font-size: 15px;">*</span>:</label>

                            <select class="form-control  job_type select2 " id="kt_select2_3" name="job_type" required>
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
                            <div class="invalid-feedback">Please select this field.</div>
                            <br>
                        </div>
                        <div class="col-sm">
                            <label>Assigned Driver:</label>
                            <div>
                                <select class="form-control assigned_driver select2" id="kt_select2_2"
                                    name="assigned_driver">
                                    <option value="" selected>-none-</option>
                                    @foreach ($all_drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row container-fluid valid-forms">
                        <div class="col-sm-2">
                            <label>Customer:</label>
                            <div>
                                <select class="form-control select2" id="customer_id">
                                    <option value="">select customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">If customer doesn't exist
                                    <a href="{{ route('customers.create') }}"> Add Customer</a></span>

                            </div>
                        </div>
                        <div class="col-sm-2" style="margin-top: 30px">
                            <a href="javascript:void(0);" onclick="get_customer()"
                                class="btn btn-primary btn-sm float-left">Edit Customer</a>
                        </div>
                        <div class="col-lg-2">
                            <label>Reference:</label>
                            <input type="text" name="m_reference" class="form-control"
                                value="{{ isset($job) && isset($job->id) ? $job->m_reference : '' }}" />
                        </div>
                        <div class="col-lg-2">
                            <label>Invoice no:</label>
                            <div class="input-group mb-3">
                                <input type="text" name="invoice_no" class="form-control" disabled
                                    value="{{ isset($job) && isset($job->id) ? $job->invoice_no : '' }}" />
                                <div class="input-group-append">
                                    <a href="javascript:void(0);" class="btn open_invoice"><i id="lock"
                                            class="fa fa-lock"></i></a>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Job Status <span style="color: red;font-size: 15px;">*</span>:</label>
                            <select class="form-control job_status srequired " onchange="myFunction()" id="job_status" name="job_status" required>
                                <option value="" selected>-None-</option>
                                @foreach ($all_status as $status)
                                    <option value="{{ $status->id }}"
                                        {{ isset($job) && $job->job_status == $status->id ? 'selected' : '' }}>{{ $status->job_status }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select this field.</div>
                        </div>
                            <p id="demo"></p>
                        <script>
                            function myFunction() {
                                var x = document.getElementById("job_status").value;
                                var branch_val = $('.sender_branch').val();
                                if(x==4){
                                    $('#current_branch').val(branch_val).change();
                                }

                            }
                        </script>
                        <div class="col-sm-2">
                            <label>current Branch:</label>
                            <div>
                                <select class="form-control select2" id="current_branch" name="current_branch" disabled>
                                    <option></option>
                                    @foreach ($all_branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branches }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row container-fluid">
                        <div class="col-sm-3" style="margin-top: 15px">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="javascript:void(0);" id="makeitsender" onclick="makeitsender();"
                                    class="btn btn-secondary" style="background-color: #cfd4d1">Make Sender</a>
                                &nbsp;
                                <a href="javascript:void(0);" id="makeitreceiver" onclick="makeitreceiver();"
                                    class="btn btn-secondary" style="background-color: #cfd4d1">Make Receiver</a>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Add a new file:</label>
                            <input type="file" id="job_file" name="m_file" class="form-control-file"
                                accept=".txt,.pdf,.jpeg,.jpg,.docx,.doc,.ppt,.pptx,.xls,.xlsx" />
                        </div>
                        <div class="col-lg-4">
                            <span class="form-text text-muted">Files must be less than <strong>2 MB.</strong></span>
                            <span class="form-text text-muted">Allowed file types:<strong>txt pdf jpeg jpg docx doc ppt pptx
                                    xls xlsx</strong>.</span>
                        </div>
                        <div class="col-lg-2" style="margin-top: 6px">

                            <!-- Modal -->
                            <div class="modal fade" id="palletModal" tabindex="-1" role="dialog"
                                aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 740px;">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="updateStatusModalLabel">Pallet Control</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    {{-- <p style="text-align:center; font-size:large;">Exchange In</p> --}}
                                                    <div class="mx-6 my-6">
                                                        <div class="row" style="text-align: center;">
                                                            <div class="col-6">
                                                                <p style="font-size:medium;">Consignee</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p style="font-size:medium;">Consignor</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6" style="border-right: 1px dashed #333;">
                                                    <div class="form-group row justify-content-center">
                                                        <label class="checkbox checkbox-rounded checkbox-primary" >
                                                            <input type="radio" name="consignee_check" value="transfer" />
                                                            <span></span>
                                                            &nbsp
                                                            Transfer In
                                                        </label>
                                                    </div>
                                                    <div class="mx-6 my-6">
                                                        <div class="form-group row ">
                                                            <label class="col-form-label col-6" style="color: red;">Loscam</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_in_loscam' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row ">
                                                            <label class="col-form-label col-lg-6 col-sm-6" style="color: blue;">Chep</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_in_chep' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-6 col-sm-6">Transfer #</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_in_no' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <label class="checkbox checkbox-rounded checkbox-primary" style="">
                                                            <input type="radio" name="consignee_check" value="exchange" />
                                                            <span ></span>
                                                            &nbsp
                                                            Exchange In
                                                        </label>
                                                    </div>

                                                    <div class="mx-6 my-6">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-6 col-sm-6" style="color: red;">Loscam</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='exchange_in_loscam' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-6" style="color: blue;">Chep</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='exchange_in_chep' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <label class="checkbox checkbox-rounded checkbox-primary" style="">
                                                            <input type="radio" name="consignee_check" value="na" checked/>
                                                            <span ></span>
                                                            &nbsp
                                                            N/A
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="col-6" >
                                                    <div class="form-group row justify-content-center">
                                                        <label class="checkbox checkbox-rounded checkbox-primary" style="">
                                                            <input type="radio" name="consignor_check" value="transfer" />
                                                            <span ></span>
                                                            &nbsp
                                                            Transfer Out
                                                        </label>
                                                    </div>
                                                    <div class="mx-6 my-6">
                                                        <div class="form-group row ">
                                                            <label class="col-form-label col-6" style="color: red;">Loscam</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_out_loscam' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row ">
                                                            <label class="col-form-label col-lg-6 col-sm-6" style="color: blue;">Chep</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_out_chep' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-6 col-sm-6">Transfer #</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='transfer_out_no' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <div class="form-group row justify-content-center">
                                                            <label class="checkbox checkbox-rounded checkbox-primary" style="">
                                                                <input type="radio" name="consignor_check" value="exchange" />
                                                                <span ></span>
                                                                &nbsp
                                                                Exchange Out
                                                            </label>
                                                        </div>

                                                    <div class="mx-6 my-6">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-6 col-sm-6" style="color: red;">Loscam</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='exchange_out_loscam' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-6" style="color: blue;">Chep</label>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control" name='exchange_out_chep' />
                                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row justify-content-center">
                                                        <label class="checkbox checkbox-rounded checkbox-primary" style="">
                                                            <input type="radio" name="consignor_check" value="na" checked/>
                                                            <span ></span>
                                                            &nbsp
                                                            N/A
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer" style="display:contents;">
                                            <button type="button" class="btn btn-primary m-3" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">

                </div>

                <div class="row">

                    <div class="col-sm container-fluid"
                        style="padding: 40px; border: 2px solid lightgray; margin-top: 30px;background-color:#ebedeb">
                        <h4>SENDER:</h4>
                        <div id="sender_div" class="valid-forms">
                            <div class="form-group row ">

                                <div class="col-lg-8">
                                    <label>Sender Name <span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="hidden" name="sender_name" id="hidden_sender_name" value="{{isset($job) ? ($job->job_sender->sender_name):''}}">
                                    <select class="form-control srequired sender_name select2"
                                        id="customer_id2" required>
                                        <option value="">Select sender</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ isset($job) && $job->job_sender->sender_name == $customer->name ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select this field.</div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="checkbox" style="margin-top: 30px;">
                                        <input type="checkbox" name="manual_entry" id="s_manual_entry" />
                                        <span style="background-color: #989c99"></span>
                                        &nbsp;
                                        Manual Entry
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Address line 1<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="sender_address_line_1" class=" required form-control"
                                        id="sender_address_line_1_id" placeholder="Enter a location"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->sender_address_line_1 : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input Address line 1.</div>
                                </div>

                                <div class="col-lg-6">
                                    <label>Address line 2:</label>
                                    <input type="text" name="sender_address_line_2" class="form-control"
                                        id="sender_address_line_2_id" placeholder="Enter a location"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->sender_address_line_2 : '' }}"
                                         />
                                    {{-- <div class="invalid-feedback">Please input Address line 2.</div> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Suburb:</label>
                                    <input type="text" name="suburb" class="form-control" id="suburb"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->suburb : '' }}" />
                                </div>
                                <div class="col-4">
                                    <label>Postal Code:</label>
                                    <input type="text" name="postal_code" class="form-control" id="postal_code_id"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->postal_code : '' }}" />
                                </div>

                                <div class="col-4">
                                    <label>State<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="sender_state" class="required form-control" id="sender_state"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->sender_state : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input State.</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Time:</label>
                                    <input type="text" name="s_time" class="form-control" id="s_time"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->s_time : '' }}" />
                                </div>
                                <div class="col-4">
                                    <label>Contact<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="sender_contact" class="required form-control"
                                        id="sender_contact"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->sender_contact : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input Contact.</div>
                                </div>
                                <div class="col-4">
                                    <label>Phone:</label>
                                    <input type="text" name="s_phone" class="form-control" id="s_phone"
                                        value="{{ isset($job) && $job->job_sender ? $job->job_sender->s_phone : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row valid-forms">
                            <div class="col-sm">
                                <label>Sender Branch <span style="color: red;font-size: 15px;">*</span>:</label>
                                <select class="form-control srequired sender_branch select2 branches" name="sender_branch"
                                    required>
                                    <option value=""></option>
                                    @foreach ($all_branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ isset($job) && $job->sender_branch == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->branches }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select this field.</div>
                            </div>
                            <div class="col-sm">
                                <label class="checkbox" style="margin-top: 30px;">
                                    <input type="checkbox" name="third_part_collection_charge" />
                                    <span style="background-color: #989c99"></span>
                                    &nbsp;
                                    Third Party Collection Charge
                                </label>

                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm">
                                <div style="margin-top: 25px;" class="btn-group" role="group"
                                    aria-label="Basic example">
                                    <a href="javascript:void(0)" onclick="j_pickup()" class="btn btn-secondary"
                                        id="j_pickup" style="border: deepskyblue 2px solid;background-color: white">Pick Up</a>
                                    <a href="javascript:void(0)" onclick="j_received()" class="btn btn-secondary"
                                        id="j_received"
                                        style="border: deepskyblue 2px solid;background-color: white">Received In</a>
                                    <a href="javascript:void(0)" onclick="j_book()" class="btn btn-secondary"
                                        id="j_book"
                                        style="border: deepskyblue 2px solid;background-color: white">Book In</a>
                                </div>
                            </div>
                            <div class="col-sm">
                                <label>Charge Collector Name:</label>
                                <div>
                                    <select class="form-control select2 charge_collector_name" id="customer_id4"
                                        name="charge_collector_name">
                                        <option value="teryTruck 1">Terytruck 1</option>
                                        <option value="teryTruck 2">Terytruck 2</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="form-group row was-validated">
                            <div class="col-sm">
                                <label>Cost($):</label>
                                <input type="text" name="charge_collector_cost" class="form-control" id="cost_id"
                                    placeholder="Enter a cost" />

                            </div>
                            <div class="col-sm">
                                <label>Ready Date:</label>
                                <input type="text" name="ready_date" class="form-control" id="datepicker"
                                    placeholder="Ready date" value="<?php echo date("Y-m-d"); ?>" required/>
                            </div>
                            <div class="col-sm">
                                <label>Ready Time:</label>
                                <input type="text" name="ready_time" class="form-control" id="time_id" required/>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Pick Up notes:</label>
                                <textarea class="form-control" style="height: 65px" name="Pick_up_notes"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm container-fluid valid-forms"
                        style="padding: 40px; border: 2px solid lightgray; margin-top: 30px;background-color:#ebedeb">

                        <h4>RECEIVER:</h4>
                        <div id="receiver_div " class="">
                            <div class="form-group row ">
                                <input type="hidden" name="receiver_name" id="hidden_receiver_name" value="{{isset($job) ? ($job->job_receiver->receiver_name):''}}">
                                <div class="col-8">
                                    <label>Receiver name<span style="color: red;font-size: 15px;">*</span>:</label>

                                    <select class="form-control srequired receiver_name select2"
                                        id="customer_id5" required>
                                        <option value="">Select receiver</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ isset($job) && $job->job_receiver->receiver_name == $customer->name ? 'selected' : '' }}>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select this field.</div>
                                </div>
                                <div class="col-4">
                                    <label class="checkbox" style="margin-top: 30px;">
                                        <input type="checkbox" name="r_manual_entry" id="r_manual_entry" />
                                        <span style="background-color: #989c99"></span>
                                        &nbsp;
                                        Manual Entry
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Address line 1<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="receiver_address_line_1" class="required form-control"
                                        id="receiver_address_line_1"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->receiver_address_line_1 : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input Address line 1.</div>
                                </div>

                                <div class="col-6">
                                    <label>Address line 2:</label>
                                    <input type="text" name="receiver_address_line_2" class="form-control"
                                        id="receiver_address_line_2"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->receiver_address_line_2 : '' }}"
                                        />
                                    {{-- <div class="invalid-feedback">Please input Address line 2.</div> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Suburb:</label>
                                    <input type="text" name="r_suburb" class="form-control" id="r_suburb"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->r_suburb : '' }}" />
                                </div>
                                <div class="col-4">
                                    <label>Postal Code:</label>
                                    <input type="text" name="r_postal_code" class="form-control" id="r_postal_code_id"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->r_postal_code : '' }}" />
                                </div>
                                <div class="col-4">
                                    <label>State<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="receiver_state" class="required form-control"
                                        id="receiver_state"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->receiver_state : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input State.</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Time:</label>
                                    <input type="text" name="r_time" class="form-control" id="r_time"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->r_time : '' }}" />
                                </div>
                                <div class="col-4">
                                    <label>Contact<span style="color: red;font-size: 15px;">*</span>:</label>
                                    <input type="text" name="receiver_contact" class="required form-control"
                                        id="receiver_contact"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->receiver_contact : '' }}"
                                        required />
                                    <div class="invalid-feedback">Please input Contact.</div>
                                </div>
                                <div class="col-4">
                                    <label>Phone:</label>
                                    <input type="text" name="r_phone" class="form-control" id="r_phone"
                                        value="{{ isset($job) && $job->job_receiver ? $job->job_receiver->r_phone : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Receiver Branch <span style="color: red;font-size: 15px;">*</span>:</label>
                                <select class="form-control srequired receiver_branch select2 branches"
                                    name="receiver_branch" required>
                                    <option value=""></option>
                                    @foreach ($all_branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ isset($job) && $job->receiver_branch == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->branches }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please input Contact.</div>
                            </div>
                            <div class="col-6">
                                <label class="checkbox" style="margin-top: 30px;">
                                    <input type="checkbox" name="r_collect_at_branch" />
                                    <span style="background-color: #989c99"></span>
                                    &nbsp;
                                    Collect at branch
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="col-form-label">Onforwarder <span
                                        style="color: red;font-size: 15px;">*</span></label>
                                <div class="col-form-label">
                                    <div class="radio-inline">
                                        <label class="radio radio-primary">
                                            <input class="no_onforworder" type="radio" name="onforworder" value="no"
                                                checked="checked" />
                                            <span style="background-color: #989c99"></span>
                                            No
                                        </label>
                                        <label class="radio radio-primary">
                                            <input class="yes_onforworder" type="radio" name="onforworder" value="yes" />
                                            <span style="background-color: #989c99"></span>
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>Forwarder list:</label>
                                <div>
                                    <select class="form-control forword_list forworder_option select2" id="Forwarder list"
                                        name="forworder_option" disabled>
                                        <option value="Jhon forworder 1">Jhon forworder 1</option>
                                        <option value="Jhon forworder 2">Jhon forworder 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>Reference:</label>
                                <input type="text" name="r_reference" class="form-control" id="reference_id" disabled />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Delivery Notes:</label>
                                <textarea class="form-control r_Pick_up_notes" style="height: 130px" name="r_Pick_up_notes"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <br>

                {{-- add item start --}}

                <h4>ADD ITEMS:</h4>
                <div style="padding: 20px; border: 2px solid lightgray; margin-top: 30px;background-color:#ebedeb"
                    id="item_parent_div" class="valid-forms">
                    @if (!isset($job))
                        <div id="item-table">
                            <input type="hidden" value="{{ rand(10000, 100000) }}" name="random_no[]" id="random_no">
                            <div style="border: 1px solid lightgray; padding: 20px;">

                                <div class="form-group row">
                                    <div class="col-sm">
                                        <label>REFERENCE:</label>
                                        <input type="text" name="item_reference[]" class="form-control form-control-sm"
                                            id="item_reference" />
                                    </div>
                                    <div class="col-sm">
                                        <label>QTY <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="number" name="item_qty" class="required form-control form-control-sm"
                                            id="item_qty" required />

                                        <div class="invalid-feedback">Please input QTY.</div>
                                    </div>
                                    <div class="col-sm">
                                        <label>ITEM TYPE <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <select class="form-control srequired item_type form-control-sm item_type"
                                            name="item_type" required>
                                            <option value=""></option>
                                            @foreach ($all_items as $item)
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please input ITEM TYPE.</div>
                                        <br>
                                    </div>
                                    <div class="col-sm">
                                        <label>DESCRIPTION:</label>
                                        <input type="text" name="item_description[]" class="form-control form-control-sm"
                                            id="item_description" />
                                    </div>
                                    <div class="col-sm">
                                        <label>LENGTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="number" name="item_length" class=" required form-control form-control-sm"
                                            id="item_length" required />
                                        <div class="invalid-feedback">Please input LENGTH.</div>
                                        <br>

                                    </div>
                                    <div class="col-sm">
                                        <label>WIDTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="number" name="item_width" class="required form-control form-control-sm"
                                            id="item_width" required />
                                        <div class="invalid-feedback">Please input WIDTH.</div>
                                    </div>
                                    <div class="col-sm">
                                        <label>HEIGHT(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="number" name="item_height" class="required form-control form-control-sm"
                                            id="item_height" required />
                                        <div class="invalid-feedback">Please input HEIGHT.</div>
                                    </div>
                                    <div class="col-sm">
                                        <label>Net WEIGHT(KG) <span style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="number" name="item_weight" class="required form-control form-control-sm"
                                            id="item_weight" required />
                                        <div class="invalid-feedback">Please input Net WEIGHT.</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm">
                                        <label>Gross WEIGHT:</label>
                                        <input type="number" name="item_tweight[]" class="form-control form-control-sm"
                                            id="item_tweight" readonly />
                                    </div>
                                    <div class="col-sm">
                                        <label class="checkbox" style="margin-top: 30px;">
                                            <input type="checkbox" name="item_stackable[]" />
                                            <span style="background-color: #989c99"></span>
                                            &nbsp
                                            STACKABLE
                                        </label>
                                    </div>
                                    <div class="col-sm">
                                        <label>PLT SPC:</label>
                                        <input type="text" name="item_plt_spc[]" class="form-control form-control-sm"
                                            id="item_plt_spc" />
                                    </div>
                                    <div class="col-sm">
                                        <label></label>
                                        <input type="button" class="form-control btn-sm btn-primary form-control-sm mt-2"
                                            id="item_dg_detail" value="DG DETAILS" />
                                    </div>
                                    <div class="col-sm">
                                        <label>CUBIC(m³):</label>
                                        <input type="nuber" name="item_cubic_m3[]" class="form-control form-control-sm"
                                            id="item_cubic_m3" />
                                    </div>
                                    <div class="col-sm">
                                        <label>COST($):</label>
                                        <input type="text" name="item_cost[]" class="form-control form-control-sm"
                                            id="item_cost" />
                                    </div>
                                    <div class="col-sm">
                                        <label>COMMENTS:</label>
                                        <input type="text" name="item_comments[]" class="form-control form-control-sm"
                                            id="item_comments" />
                                    </div>
                                    <div class="col-sm">
                                        <label>ITEM DETAIL:</label>
                                        <input type="hidden" name="item_detail[]" class="form-control form-control-sm"
                                            id="item_detail" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label></label>
                                        <button onclick="event.preventDefault();"
                                            class="form-control btn btn-sm btn-secondary clone_item">Copy</button>
                                    </div>
                                    <div class="col-lg-1">
                                        <label></label>
                                        <button onclick="event.preventDefault();" id="close_item"
                                            class="form-control btn btn-sm btn-danger remove-item">X</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    @else
                        @foreach ($job->job_items as $job_item)
                            <div id="item-table">
                                <input type="hidden" value="{{ rand(10000, 100000) }}" name="random_no[]" id="random_no">
                                <div style="border: 1px solid lightgray; padding: 20px;">
                                    <input type="hidden" value="{{$job_item->id}}" name="jitem[]">
                                    <div class="form-group row">
                                        <div class="col-sm">
                                            <label>REFERENCE:</label>
                                            <input type="text" name="item_reference[]" class="form-control form-control-sm"
                                                id="item_reference" value="{{$job_item->item_reference}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label>QTY <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <input type="number" name="item_qty[]" class="required form-control form-control-sm"
                                                id="item_qty"  value="{{$job_item->item_qty}}"
                                                required />
                                            <div class="invalid-feedback">Please input QTY.</div>
                                        </div>
                                        <div class="col-sm">
                                            <label>ITEM TYPE <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <select class="form-control srequired item_type form-control-sm item_type"
                                                name="item_type[]"  required>
                                                <option value=""></option>
                                                @foreach ($all_items as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{$job_item->item_type ==$item->id?' selected ':''}}
                                                        >{{ $item->item_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please input ITEM TYPE.</div>
                                            <br>
                                        </div>
                                        <div class="col-sm">
                                            <label>DESCRIPTION:</label>
                                            <input type="text" name="item_description[]" class="form-control form-control-sm"
                                                id="item_description" value="{{$job_item->item_description}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label>LENGTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <input type="number" name="item_length[]" class=" required form-control form-control-sm"
                                                id="item_length" value="{{$job_item->item_length}}" required />
                                            <div class="invalid-feedback">Please input LENGTH.</div>
                                            <br>

                                        </div>
                                        <div class="col-sm">
                                            <label>WIDTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <input type="number" name="item_width[]" class="required form-control form-control-sm"
                                                id="item_width" value="{{$job_item->item_width}}" required />
                                            <div class="invalid-feedback">Please input WIDTH.</div>
                                        </div>
                                        <div class="col-sm">
                                            <label>HEIGHT(CM) <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <input type="number" name="item_height[]" class="required form-control form-control-sm"
                                                id="item_height" value="{{$job_item->item_height}}"  required />
                                            <div class="invalid-feedback">Please input HEIGHT.</div>
                                        </div>
                                        <div class="col-sm">
                                            <label>Net WEIGHT(KG) <span style="color: red;font-size: 15px;">*</span>:</label>
                                            <input type="number" name="item_weight[]" class="required form-control form-control-sm"
                                                id="item_weight" value="{{$job_item->item_weight}}" required />
                                            <div class="invalid-feedback">Please input Net WEIGHT.</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm">
                                            <label>Gross WEIGHT:</label>
                                            <input type="number" name="item_tweight[]" class="form-control form-control-sm"
                                                id="item_tweight" value="{{$job_item->item_tweight}}" readonly />
                                        </div>
                                        <div class="col-sm">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="item_stackable[]" />
                                                <span style="background-color: #989c99"></span>
                                                &nbsp
                                                STACKABLE
                                            </label>
                                        </div>
                                        <div class="col-sm">
                                            <label>PLT SPC:</label>
                                            <input type="text" name="item_plt_spc[]" class="form-control form-control-sm"
                                                id="item_plt_spc" value="{{$job_item->item_plt_spc}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label></label>
                                            <input type="button" class="form-control btn-sm btn-primary form-control-sm mt-2"
                                                id="item_dg_detail" value="DG DETAILS" />
                                        </div>
                                        <div class="col-sm">
                                            <label>CUBIC(m³):</label>
                                            <input type="nuber" name="item_cubic_m3[]" class="form-control form-control-sm"
                                                id="item_cubic_m3" value="{{$job_item->item_cubic_m3}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label>COST($):</label>
                                            <input type="text" name="item_cost[]" class="form-control form-control-sm"
                                                id="item_cost" value="{{$job_item->item_cost}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label>COMMENTS:</label>
                                            <input type="text" name="item_comments[]" class="form-control form-control-sm"
                                                id="item_comments" value="{{$job_item->item_comments}}"/>
                                        </div>
                                        <div class="col-sm">
                                            <label>ITEM DETAIL:</label>
                                            <input type="hidden" name="item_detail[]" class="form-control form-control-sm"
                                                id="item_detail" value="{{$job_item->item_detail}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label></label>
                                            <button onclick="event.preventDefault();"
                                                class="form-control btn btn-sm btn-secondary clone_item">Copy</button>
                                        </div>
                                        <div class="col-lg-1">
                                            <label></label>
                                            <button onclick="event.preventDefault();" id="close_item"
                                                class="form-control btn btn-sm btn-danger remove-item">X</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    @endif

                </div>

                {{-- add item end --}}

                <input type="hidden" id="item_dg_data" name="item_dg_data" value="">


                <br>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <button onclick="event.preventDefault(); addItem();"
                            class="btn btn-secondary btn-lg float-left">Add New</button>
                            <a href="javascript:void(0);" class="btn btn-secondary btn-lg float-right mt-2" data-toggle="modal" data-target="#updateStatusModal" id="calculateModal">
                                Calculate
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog"
                                aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width:750px;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateStatusModalLabel">Pricing</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="updateStatusForm">
                                                <div class="row">
                                                    <div class="col-6" style="color:red; text-align:center;">
                                                        <h3>Manual Entry</h3>
                                                    </div>
                                                    <div class="col-6">
                                                        <h3>Freight Pricing</h3>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mx-3 my-5">

                                                            <div class="form-group row">
                                                                <label class="col-4">Pickup Fee</label>
                                                                <input type="number" class="form-control col-4" id="m_pickup_fee"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Delivery Fee</label>
                                                                <input type="number" class="form-control col-4" id="m_delivery_fee"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Con Fee</label>
                                                                <input type="number" class="form-control col-4 " id="m_con_fee"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">DG Fee</label>
                                                                <input type="number" class="form-control col-4 " id="m_dg_fee"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Surcharge</label>
                                                                <input type="number" class="form-control col-4 " id="m_surcharge"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Fuel Levy</label>
                                                                <input type="number" class="form-control col-4 " id="m_fuel_levy"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Discount</label>
                                                                <input type="number" class="form-control col-4" id="m_discount"/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mx-3 my-5">

                                                            <div class="form-group row ">
                                                                <label class="col-4" style="margin-botton:35px">Pickup Fee</label>
                                                                <input disabled id="r_pickup_fee" name="pickup_fee" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Delivery Fee</label>
                                                                <input type="number"  disabled id="r_delivery_fee" name="delivery_fee" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-4">Con Fee</label>
                                                                <input type="number" disabled id="r_con_fee" name="con_fee" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-4">DG Fee</label>
                                                                <input disabled id="r_dg_fee" name="dg_fee" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Surcharge</label>
                                                                <input disabled id="r_surcharge" name="surcharge" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label class="col-4">Fuel Levy</label>
                                                                <input disabled id="r_fuel_levy" name="fuel_levy" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-4">Discount</label>
                                                                <input disabled id="r_discount" name="price_discount" class="col-4 form-control border-0" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
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
                    </div>
                </div>

                <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                <div class="container-fluid"
                    style="padding: 20px; border: 2px solid lightgray; margin-top: 30px;background-color:#ebedeb">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-left">
                                <h4>LOAD RESTRAINTS</h4>
                            </div>
                            <button type="button" class="btn btn-primary float-right mr-3" data-toggle="modal" data-target="#palletModal">
                                Pallet Control
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="bolsters" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Bolsters
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="chains" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Chains
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="dogs" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Dogs
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="gates" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Gates
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="rt" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                RT
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="straps" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Straps
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="timber" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Timber
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="trap" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Trap
                            </label>
                        </div>
                    </div>

                    {{-- <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                    <br>
                    <h4>PALLET CONTROL</h4>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>In Chep:</label>
                            <input type="text" name="in_chep" class="form-control form-control-sm" id="item_in_chep" />
                        </div>
                        <div class="col-lg-3">
                            <label>Out Chep:</label>
                            <input type="text" name="out_chep" class="form-control form-control-sm" id="item_out_chep" />
                        </div>
                        <div class="col-lg-3">
                            <label>In Loscam:</label>
                            <input type="text" name="in_loscam" class="form-control form-control-sm" id="item_in_loscam" />
                        </div>
                        <div class="col-lg-3">
                            <label>Out Loscam:</label>
                            <input type="text" name="out_loscam" class="form-control form-control-sm"
                                id="item_out_loscam" />
                        </div>
                    </div> --}}

                    <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                    <br>
                    <h4>TOTAL PRICE</h4>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label>Total Price($):</label>
                            <input type="text" name="job_total_price" class="form-control form-control-sm"
                                id="job_total_price" />
                        </div>
                        <div class="col-sm">
                            <label>Handling Fee($):</label>
                            <input type="text" name="job_handling_fee" class="form-control form-control-sm"
                                id="job_handling_fee" />
                        </div>
                        <div class="col-sm">
                            <label>Hand Unload Fee($):</label>
                            <input type="text" name="job_unload_fee" class="form-control form-control-sm"
                                id="job_unload_fee" />
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" name="job_pick_up_fee" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Include Pickup Fee?
                            </label>
                        </div>
                        <div class="col-sm">
                            <label class="checkbox" style="margin-top: 30px;">
                                <input type="checkbox" checked name="job_delivery_fee" />
                                <span style="background-color: #989c99"></span>
                                &nbsp
                                Include Delevery Fee?
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </form>
            {{-- {{ Form::close() }} --}}
            <!--end::Form-->
        </div>

        <!--end::Card-->

        <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg" id="exampleModal"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DG Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" id="price_by_w_id">
                        <div id="modal_body">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary save_mod" onclick="javascript:void(0);">Save &
                            Close</button>
                        <button type="button" class="btn btn-primary w_close_mod"
                            onclick="javascript:void(0);">Close</button>
                    </div>

                </div>

            </div>
        </div>


        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('script')
    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
    {{-- //<script async src='{{asset('js/job_script.js')}}'></script> --}}
    <script>
        function addItem() {
            var js_random_no = Math.floor(Math.random() * 10000);
            var item_html = '                            <div id="item-table" class="valid-forms">\n' +
                ' <input type="hidden" name="jitem[]"> \n'+
                '                                           <input type="hidden" value="' + js_random_no +
                '" name="random_no[]" id="random_no">\n' +
                '                                            <div style="border: 1px solid lightgray; padding: 20px;">\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-sm">\n' +
                '                                                        <label>REFERENCE:</label>\n' +
                '                                                        <input type="text" name="item_reference[]" class="form-control form-control-sm" id="item_reference"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-sm">\n' +
                '                                                        <label>QTY: <span style="color: red;font-size: 15px;">*</span></label>\n' +
                '                                                        <input type="number" name="item_qty[]" class="form-control required form-control-sm" id="item_qty"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-sm">\n' +
                '                                                        <label>ITEM TYPE: <span style="color: red;font-size: 15px;">*</span></label>\n' +
                '                                                        <div>\n' +
                '                                                            <select class="form-control srequired item_type"  name="item_type[]">\n' +
                '                                                                 <option value=""></option>\n' +
                '                                                                @foreach($all_items as $item)\n' +
                '                                                                    <option value="{{$item->id}}">{{$item->item_name}}</option>\n' +
                '                                                                @endforeach\n' +
            '                                                            </select>\n' +
            '                                                        </div>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>DESCRIPTION:</label>\n' +
            '                                                        <input type="text" name="item_description[]" class="form-control form-control-sm" id="item_description"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>LENGTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>\n' +
            '                                                        <input type="number" name="item_length[]" class=" required form-control form-control-sm" id="item_length"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>WIDTH(CM) <span style="color: red;font-size: 15px;">*</span>:</label>\n' +
            '                                                        <input type="number" name="item_width[]" class="required form-control form-control-sm" id="item_width"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>HEIGHT(CM) <span style="color: red;font-size: 15px;">*</span>:</label>\n' +
            '                                                        <input type="number" name="item_height[]" class="required form-control form-control-sm" id="item_height"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>Net WEIGHT(KG) <span style="color: red;font-size: 15px;">*</span>:</label>\n' +
            '                                                        <input type="number" name="item_weight[]" class="required form-control form-control-sm" id="item_weight"/>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="form-group row">\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>Gross WEIGHT:</label>\n' +
            '                                                        <input type="number" name="item_tweight[]" class="form-control form-control-sm" id="item_tweight" readonly />\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label class="checkbox" style="margin-top: 30px;">\n' +
            '                                                            <input type="checkbox" name="item_stackable[]"/>\n' +
            '                                                            <span style="background-color: #989c99"></span>\n' +
            '                                                            &nbsp\n' +
            '                                                            STACKABLE\n' +
            '                                                        </label>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>PLT SPC:</label>\n' +
            '                                                        <input type="text" name="item_plt_spc[]" class="form-control form-control-sm" id="item_plt_spc"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label></label>\n' +
            '                                                        <input type="button" class="form-control btn-sm btn-primary" id="item_dg_detail" value="DG DETAILS"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>CUBIC(m³):</label>\n' +
            '                                                        <input type="number" name="item_cubic_m3[]" class="form-control form-control-sm" id="item_cubic_m3"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>COST($):</label>\n' +
            '                                                        <input type="text" name="item_cost[]" class="form-control form-control-sm" id="item_cost"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>COMMENTS:</label>\n' +
            '                                                        <input type="text" name="item_comments[]" class="form-control form-control-sm" id="item_comments"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-sm">\n' +
            '                                                        <label>ITEM DETAIL:</label>\n' +
            '                                                        <input type="text" name="item_detail[]" class="form-control form-control-sm" id="item_detail"/>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="form-group row">\n' +
            '                                                    <div class="col-lg-3">\n' +
            '                                                        <label></label>\n' +
            '                                                        <button onclick="event.preventDefault();" class="form-control btn btn-sm btn-secondary clone_item">Copy</button>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-lg-1">\n' +
            '                                                        <label></label>\n' +
            '                                                        <button onclick="event.preventDefault();" id="close_item" class="form-control btn btn-sm btn-danger remove-item" >X</button>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <br>\n' +
            '                                        </div>';
            $('#item_parent_div').append(item_html);
            $('.item_type').select2({
                placeholder: "Select an item"
            });
        }
        var sender_name_status = 'false';

        $("body").on("click", "#s_manual_entry", function() {
            $("#sender_div").empty();
            var sender_form = '<div class="form-group row">\n' +
                '                                                    <div class="col-lg-8">\n' +
                '                                                        <label>Sender Name:</label>\n' +
                '                                                        <input type="text" name="sender_name" class="required form-control " id="sender_name" placeholder="Enter Sender name" />\n' +

                '                                                    </div>\n' +
                '                                                    <div class="col-lg-4">\n' +
                '                                                        <label class="checkbox" style="margin-top: 30px;">\n' +
                '                                                            <input type="checkbox" name="manual_entry" id="s_manual_entry2" checked/>\n' +
                '                                                            <span style="background-color: #989c99"></span>\n' +
                '                                                            &nbsp;\n' +
                '                                                            Manual Entry\n' +
                '                                                        </label>\n' +
                '    \n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-lg-6">\n' +
                '                                                        <label>Address line 1:</label>\n' +
                '                                                        <input type="text" name="sender_address_line_1" class="required form-control" id="sender_address_line_1_id" placeholder="Enter a location" />\n' +
                '                                                    </div>\n' +
                '    \n' +
                '                                                    <div class="col-lg-6">\n' +
                '                                                        <label>Address line 2:</label>\n' +
                '                                                        <input type="text" name="sender_address_line_2" class="form-control" id="sender_address_line_2_id" placeholder="Enter a location" />\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>Suburb:</label>\n' +
                '                                                        <input type="text" name="suburb" class="form-control" id="suburb"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>Postal Code:</label>\n' +
                '                                                        <input type="text" name="postal_code" class="form-control" id="postal_code_id"/>\n' +
                '                                                    </div>\n' +
                '    \n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>State:</label>\n' +
                '                                                        <input type="text" name="sender_state" class="required form-control" id="sender_state"/>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>Time:</label>\n' +
                '                                                        <input type="text" name="s_time" class="form-control" id="s_time"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>Contact:</label>\n' +
                '                                                        <input type="text" name="sender_contact" class="required form-control" id="sender_contact"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-4">\n' +
                '                                                        <label>Phone:</label>\n' +
                '                                                        <input type="text" name="s_phone" class="form-control" id="s_phone"/>\n' +
                '                                                    </div>\n' +
                '                                                </div>';

            $("#sender_div").html(sender_form);
            sender_name_status = 'true';
        });
        $("body").on("click", "#s_manual_entry2", function() {
            $("#sender_div").empty();
            var sender_form = '<div class="form-group row">\n' +
                '                                                    <div class="col-lg-8">\n' +
                '                                                        <label>Sender Name:</label>\n' +
                '                                                         <div>\n' +
                '<input type="hidden" name="sender_name" id="hidden_sender_name">\n' +
                '                                                            <select class="form-control srequired sender_name customer_id22" id="customer_id2">\n' +
                '                                                                   <option value="">Select sender</option>\n' +
                ' @foreach ($customers as $customer)\n' +
                    ' <option value="{{ $customer->id }}">{{ $customer->name }}</option>\n' +
                    ' @endforeach\ n ' +
            '                                                            </select>\n' +
            '                                                        </div>\n' +

            '                                                    </div>\n' +
            '                                                    <div class="col-lg-4">\n' +
            '                                                        <label class="checkbox" style="margin-top: 30px;">\n' +
            '                                                            <input type="checkbox" name="manual_entry" id="s_manual_entry"/>\n' +
            '                                                            <span style="background-color: #989c99"></span>\n' +
            '                                                            &nbsp;\n' +
            '                                                            Manual Entry\n' +
            '                                                        </label>\n' +
            '    \n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="form-group row">\n' +
            '                                                    <div class="col-lg-6">\n' +
            '                                                        <label>Address line 1:</label>\n' +
            '                                                        <input type="text" name="sender_address_line_1" class="required form-control" id="sender_address_line_1_id" placeholder="Enter a location" />\n' +
            '                                                    </div>\n' +
            '    \n' +
            '                                                    <div class="col-lg-6">\n' +
            '                                                        <label>Address line 2:</label>\n' +
            '                                                        <input type="text" name="sender_address_line_2" class="form-control" id="sender_address_line_2_id" placeholder="Enter a location" />\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="form-group row">\n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>Suburb:</label>\n' +
            '                                                        <input type="text" name="suburb" class="form-control" id="suburb"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>Postal Code:</label>\n' +
            '                                                        <input type="text" name="postal_code" class="form-control" id="postal_code_id"/>\n' +
            '                                                    </div>\n' +
            '    \n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>State:</label>\n' +
            '                                                        <input type="text" name="sender_state" class="required form-control" id="sender_state"/>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                                <div class="form-group row">\n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>Time:</label>\n' +
            '                                                        <input type="text" name="s_time" class="form-control" id="s_time"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>Contact:</label>\n' +
            '                                                        <input type="text" name="sender_contact" class="required form-control" id="sender_contact"/>\n' +
            '                                                    </div>\n' +
            '                                                    <div class="col-4">\n' +
            '                                                        <label>Phone:</label>\n' +
            '                                                        <input type="text" name="s_phone" class="form-control" id="s_phone"/>\n' +
            '                                                    </div>\n' +
            '                                                </div>';

            $("#sender_div").html(sender_form);
            sender_name_status = 'false';
            $('.customer_id22').select2({
                placeholder: "Select a sender"
            });

            // $('#customer_id2').change(function() {
            //     // alert("DFDFDF");
            //     $.ajax({
            //         type: 'POST',
            //         url: "{{ route('get_customer') }}",
            //         data: {
            //             'id': $(this).val()
            //         },
            //         headers: {
            //             'X-CSRF-Token': '{{ csrf_token() }}',
            //         },
            //         success: function(data) {
            //             console.log("sender data", data);
            //             if (data.address['0']['p_address_line_1']) {
            //                 var address_line_1 = data.address['0']['p_address_line_1'];
            //             } else {
            //                 var address_line_1 = '';
            //             }

            //             var address_line_2 = data.address['0']['p_address_line_2'];
            //             var suburb = data.address['0']['p_suburb'];
            //             var postal_code = data.address['0']['p_postal_code'];
            //             var state = data.address['0']['p_state'];
            //             var time = data.address['0']['p_opening_time'];
            //             var contact = data['primary_contact']['contact_name'];
            //             var phone = data['primary_contact']['mobile'];

            //             //$('#customer_id2').val(data.id).change();


            //             $('#customer_id5').append($('<option>', {
            //                 value: '',
            //                 text: 'Select customer',
            //                 selected: 'selected'
            //             }));

            //             // $('#hidden_receiver_name').val('');
            //             // $('#receiver_address_line_1').val('');
            //             // $('#receiver_address_line_2').val('');
            //             // $('#r_suburb').val('');
            //             // $('#r_postal_code_id').val('');
            //             // $('#receiver_state').val('');
            //             // $('#r_time').val('');
            //             // $('#receiver_contact').val('');
            //             // $('#r_phone').val('');

            //             $('#hidden_sender_name').val(data.name);
            //             $('#sender_address_line_1_id').val(address_line_1);
            //             $('#sender_address_line_2_id').val(address_line_2);
            //             $('#suburb').val(suburb);
            //             $('#postal_code_id').val(postal_code);
            //             $('#sender_state').val(state);
            //             $('#s_time').val(time);
            //             $('#sender_contact').val(contact);
            //             $('#s_phone').val(phone);

            //         }
            //     });
            // });
        });
        $("body").on("click", "#r_manual_entry", function() {
            $("#receiver_div").empty();

            var receiver_form = '<div class="form-group row">\n' +
                '                                                <div class="col-8">\n' +
                '                                                    <label>Receiver name:</label>\n' +
                '                                                    <input type="text" name="receiver_name" class="form-control" id="receiver_name" placeholder="Enter Sender name" />\n' +
                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label class="checkbox" style="margin-top: 30px;">\n' +
                '                                                        <input type="checkbox" name="r_manual_entry" id="r_manual_entry2"/>\n' +
                '                                                        <span style="background-color: #989c99"></span>\n' +
                '                                                        &nbsp;\n' +
                '                                                        Manual Entry\n' +
                '                                                    </label>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                            <div class="form-group row">\n' +
                '                                                <div class="col-6">\n' +
                '                                                    <label>Address line 1:</label>\n' +
                '                                                    <input type="text" name="receiver_address_line_1" class="form-control" id="receiver_address_line_1"/>\n' +

                '                                                </div>\n' +
                '                                                <div class="col-6">\n' +
                '                                                    <label>Address line 2:</label>\n' +
                '                                                    <input type="text" name="receiver_address_line_2" class="form-control" id="receiver_address_line_2"/>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                            <div class="form-group row">\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>Suburb:</label>\n' +
                '                                                    <input type="text" name="r_suburb" class="form-control" id="r_suburb"/>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>Postal Code:</label>\n' +
                '                                                    <input type="text" name="r_postal_code" class="form-control" id="r_postal_code_id"/>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>State:</label>\n' +
                '                                                    <input type="text" name="receiver_state" class="form-control" id="receiver_state"/>\n' +

                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                            <div class="form-group row">\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>Time:</label>\n' +
                '                                                    <input type="text" name="r_time" class="form-control" id="r_time"/>\n' +
                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>Contact:</label>\n' +
                '                                                    <input type="text" name="receiver_contact" class="form-control" id="receiver_contact"/>\n' +

                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label>Phone:</label>\n' +
                '                                                    <input type="text" name="r_phone" class="form-control" id="r_phone"/>\n' +
                '                                                </div>\n' +
                '                                            </div>';

            $("#receiver_div").html(receiver_form);

        });
        $("body").on("click", "#r_manual_entry2", function() {
            $("#receiver_div").empty();

            var receiver_form = '<div class="form-group row">\n' +
                '                                                <div class="col-8">\n' +
                '                                                    <label>Receiver name:</label>\n' +
                '                                                    <div>\n' +
                '<input type="hidden" name="receiver_name" id="hidden_receiver_name">\n' +
                '                                                        <select class="form-control select2 receiver_name customer_id55" id="customer_id5">\n' +
                '                                                             <option value="">Select receiver</option>\n' +
                '@foreach ($customers as $customer)                    \n' +
                    ' <option value="{{ $customer->id }}">{{ $customer->name }}</option>\n' +
                    '@endforeach\ n ' +
            '                                                        </select>\n' +
            '                                                    </div>\n' +

            '                                                </div>\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label class="checkbox" style="margin-top: 30px;">\n' +
            '                                                        <input type="checkbox" name="r_manual_entry" id="r_manual_entry"/>\n' +
            '                                                        <span style="background-color: #989c99"></span>\n' +
            '                                                        &nbsp;\n' +
            '                                                        Manual Entry\n' +
            '                                                    </label>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <div class="form-group row">\n' +
            '                                                <div class="col-6">\n' +
            '                                                    <label>Address line 1:</label>\n' +
            '                                                    <input type="text" name="receiver_address_line_1" class="form-control" id="receiver_address_line_1"/>\n' +

            '                                                </div>\n' +
            '                                                <div class="col-6">\n' +
            '                                                    <label>Address line 2:</label>\n' +
            '                                                    <input type="text" name="receiver_address_line_2" class="form-control" id="receiver_address_line_2"/>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <div class="form-group row">\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>Suburb:</label>\n' +
            '                                                    <input type="text" name="r_suburb" class="form-control" id="r_suburb"/>\n' +
            '                                                </div>\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>Postal Code:</label>\n' +
            '                                                    <input type="text" name="r_postal_code" class="form-control" id="r_postal_code_id"/>\n' +
            '                                                </div>\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>State:</label>\n' +
            '                                                    <input type="text" name="receiver_state" class="form-control" id="receiver_state"/>\n' +

            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                            <div class="form-group row">\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>Time:</label>\n' +
            '                                                    <input type="text" name="r_time" class="form-control" id="r_time"/>\n' +
            '                                                </div>\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>Contact:</label>\n' +
            '                                                    <input type="text" name="receiver_contact" class="form-control" id="receiver_contact"/>\n' +
            '                                                </div>\n' +
            '                                                <div class="col-4">\n' +
            '                                                    <label>Phone:</label>\n' +
            '                                                    <input type="text" name="r_phone" class="form-control" id="r_phone"/>\n' +
            '                                                </div>\n' +
            '                                            </div>';

            $("#receiver_div").html(receiver_form);
            $('.customer_id55').select2({
                placeholder: "Select a name"
            });

            $('#customer_id5').change(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get_customer') }}",
                    data: {
                        'id': $(this).val()
                    },
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        if (typeof data.address['0'] !== 'undefined') {
                            var address_line_1 = data.address['0']['p_address_line_1'];
                        } else {
                            var address_line_1 = '';
                        }

                        if (typeof data.address['0'] !== 'undefined') {
                            var address_line_2 = data.address['0']['p_address_line_2'];
                        } else {
                            var address_line_2 = '';
                        }
                        if (typeof data.address['0'] !== 'undefined') {
                            var suburb = data.address['0']['p_suburb'];
                        } else {
                            var suburb = '';
                        }

                        if (typeof data.address['0'] !== 'undefined') {
                            var postal_code = data.address['0']['p_postal_code'];
                        } else {
                            var postal_code = '';
                        }

                        if (typeof data.address['0'] !== 'undefined') {
                            var state = data.address['0']['p_state'];
                        } else {
                            var state = '';
                        }

                        if (typeof data.address['0'] !== 'undefined') {
                            var time = data.address['0']['p_opening_time'];
                        } else {
                            var time = '';
                        }

                        if (typeof data['primary_contact'] !== 'undefined') {
                            var contact = data['primary_contact']['contact_name'];
                        } else {
                            var contact = '';
                        }

                        if (typeof data['primary_contact'] !== 'undefined') {
                            var phone = data['primary_contact']['mobile'];
                        } else {
                            var phone = '';
                        }


                        $('#hidden_receiver_name').val(data.name);
                        $('#receiver_address_line_1').val(address_line_1);
                        $('#receiver_address_line_2').val(address_line_2);
                        $('#r_suburb').val(suburb);
                        $('#r_postal_code_id').val(postal_code);
                        $('#receiver_state').val(state);
                        $('#r_time').val(time);
                        $('#receiver_contact').val(contact);
                        $('#r_phone').val(phone);

                    }
                });
            });
        });

        var cal_price;
        function set_price_value(){
            $('#r_pickup_fee').val( $('#m_pickup_fee').val()==''?cal_price.pickup_fee:$('#m_pickup_fee').val());
            $('#r_delivery_fee').val( $('#m_delivery_fee').val()==''?cal_price.delivery_fee:$('#m_delivery_fee').val());
            $('#r_con_fee').val( $('#m_con_fee').val()==''?cal_price.con_fee:$('#m_con_fee').val());
            $('#r_dg_fee').val( $('#m_dg_fee').val()==''?0:$('#m_dg_fee').val());
            $('#r_surcharge').val( $('#m_surcharge').val()==''?0:$('#m_surcharge').val());
            $('#r_fuel_levy').val( $('#m_fuel_levy').val()==''?cal_price.fuel_levy:$('#m_fuel_levy').val());
            $('#r_discount').val( $('#m_discount').val()==''?cal_price.discount:$('#m_discount').val());
        }
        $('#m_pickup_fee, #m_delivery_fee, #m_con_fee, #m_dg_fee, #m_surcharge, #m_fuel_levy, #m_discount').change(function() {
            set_price_value();
        });
        $('#customer_id2').change(function() {

            $.ajax({
                type: 'POST',
                url: "{{ route('get_customer') }}",
                data: {
                    'id': $(this).val()
                },
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log("DDDDDDDDD",data);
                    cal_price = data.price_plan;
                    set_price_value();

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_1 = data.address['0']['p_address_line_1'];
                    } else {
                        var address_line_1 = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_2 = data.address['0']['p_address_line_2'];
                    } else {
                        var address_line_2 = '';
                    }
                    if (typeof data.address['0'] !== 'undefined') {
                        var suburb = data.address['0']['p_suburb'];
                    } else {
                        var suburb = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var postal_code = data.address['0']['p_postal_code'];
                    } else {
                        var postal_code = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var state = data.address['0']['p_state'];
                    } else {
                        var state = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var time = data.address['0']['p_opening_time'];
                    } else {
                        var time = '';
                    }

                    if (typeof data['primary_contact'] !== 'undefined') {
                        var contact = data['primary_contact']['contact_name'];
                    } else {
                        var contact = '';
                    }

                    if (typeof data['primary_contact'] !== 'undefined') {
                        var phone = data['primary_contact']['mobile'];
                    } else {
                        var phone = '';
                    }

                    $('#hidden_sender_name').val(data.name);
                    $('#sender_address_line_1_id').val(address_line_1);
                    $('#sender_address_line_2_id').val(address_line_2);
                    $('#suburb').val(suburb);
                    $('#postal_code_id').val(postal_code);
                    $('#sender_state').val(state);
                    $('#s_time').val(time);
                    $('#sender_contact').val(contact);
                    $('#s_phone').val(phone);

                }
            });
        });
        $('#customer_id5').change(function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('get_customer') }}",
                data: {
                    'id': $(this).val()
                },
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_1 = data.address['0']['p_address_line_1'];
                    } else {
                        var address_line_1 = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_2 = data.address['0']['p_address_line_2'];
                    } else {
                        var address_line_2 = '';
                    }
                    if (typeof data.address['0'] !== 'undefined') {
                        var suburb = data.address['0']['p_suburb'];
                    } else {
                        var suburb = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var postal_code = data.address['0']['p_postal_code'];
                    } else {
                        var postal_code = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var state = data.address['0']['p_state'];
                    } else {
                        var state = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var time = data.address['0']['p_opening_time'];
                    } else {
                        var time = '';
                    }

                    if (typeof data['primary_contact'] !== 'undefined') {
                        var contact = data['primary_contact']['contact_name'];
                    } else {
                        var contact = '';
                    }

                    if (typeof data['primary_contact'] !== 'undefined') {
                        var phone = data['primary_contact']['mobile'];
                    } else {
                        var phone = '';
                    }


                    $('#hidden_receiver_name').val(data.name);
                    $('#receiver_address_line_1').val(address_line_1);
                    $('#receiver_address_line_2').val(address_line_2);
                    $('#r_suburb').val(suburb);
                    $('#r_postal_code_id').val(postal_code);
                    $('#receiver_state').val(state);
                    $('#r_time').val(time);
                    $('#receiver_contact').val(contact);
                    $('#r_phone').val(phone);

                }
            });
        });
    </script>
    <script>
        function onPrintLabel() {
            var form = document.getElementById("job_add_form");
            form.action = "{{ route('export-label-pdf-post') }}";
            form.submit();
        }

        function onPrintConnote() {
            var form = document.getElementById("job_add_form");
            form.action = "{{ route('export-pdf-post') }}";
            form.submit();
        }

        $("body").on("click", ".open_invoice", function() {
            $('input[name="invoice_no"]').prop('disabled', false);
            $('#lock').removeClass('fa fa-lock').addClass('fas fa-lock-open');
            $(this).removeClass('open_invoice').addClass('close_invoice');
        });

        $("body").on("click", ".close_invoice", function() {
            $('input[name="invoice_no"]').prop('disabled', true);
            $('#lock').removeClass('fas fa-lock-open').addClass('fa fa-lock');
            $(this).removeClass('close_invoice').addClass('open_invoice');
        });

        $('#datepicker').datepicker({
            todayHighlight: true, // to highlight the today's date
            format: 'yyyy-mm-dd', // we format the date before we will submit it to the server side
            autoclose: true
        });


        $('#time_id').timepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left"
        });


        var item_childs = [];

        $("body").on("input", "#item_qty", function() {
            var weight = $(this).parent().parent().parent().find("#item_weight").val();
            if (weight) {
                var totalw = weight * $(this).val();
                $(this).parent().parent().parent().find("#item_tweight").val(totalw);
            }
        });

        $("body").on("input", "#item_weight", function() {
            var weight = $(this).parent().parent().parent().find("#item_qty").val();
            if (weight) {
                var totalw = weight * $(this).val();
                $(this).parent().parent().parent().find("#item_tweight").val(totalw);
            }
        });

        $("body").on("input", "#item_length", function() {
            var item_width = $(this).parent().parent().parent().find("#item_width").val();
            var item_height = $(this).parent().parent().parent().find("#item_height").val();
            if (item_width && item_height) {
                var cubicmeter = (item_width * item_height * $(this).val()) / 1000000;
                $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
            }
        });

        $("body").on("input", "#item_width", function() {
            var item_width = $(this).parent().parent().parent().find("#item_length").val();
            var item_height = $(this).parent().parent().parent().find("#item_height").val();
            if (item_width && item_height) {
                var cubicmeter = (item_width * item_height * $(this).val()) / 1000000;
                $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
            }
        });

        $("body").on("input", "#item_height", function() {
            var item_width = $(this).parent().parent().parent().find("#item_length").val();
            var item_height = $(this).parent().parent().parent().find("#item_width").val();
            if (item_width && item_height) {
                var cubicmeter = (item_width * item_height * $(this).val()) / 1000000;
                $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
            }
        });

        $("body").on("click", ".close_item", function() {

        });

        $('.item_select').select2({
            placeholder: "Select a type"
        });

        $("body").on("click", ".remove-item", function() {
            $(this).parent().parent().parent().remove();
        });
        $("body").on("click", ".clone_item", function() {
            var selected_value = $(this).parent().parent().parent().find(":selected").val();
            var this_item = $(this).parent().parent().parent().clone();
            this_item.find('select').val(selected_value).change();
            $('#item_parent_div').append(this_item);
        });


        $('input[name=radios11]').change(function() {
            if ($(this).val() === 'no') {
                $('#customer_id7').prop('disabled', 'disabled');
                $('#reference_id').prop('disabled', 'disabled');

            } else {
                $('#customer_id7').prop('disabled', false);
                $('#reference_id').prop('disabled', false);
            }
        });

        var jstatus=[];
        $('select.job_status option').each(function() {
            jstatus.push({value:$(this).val(), label:$(this).html()})

        });

        function j_pickup() {
            var branch_val = $('.sender_branch').val();

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd ;

            const d = new Date();
            let timeStr = d.toLocaleTimeString('default', {hour: 'numeric', minute: 'numeric', timeZone: 'Australia/Sydney'});

            $('#datepicker').val(today).change();
            $('#time_id').val(timeStr).change();

            $('#j_pickup').css("background-color", "lightblue");
            $('#j_received').css("background-color", "white");
            $('#j_book').css("background-color", "white");

            $('#current_branch').val(branch_val).change();
            $('#job_status').val(jstatus.filter(e=>e.label=='Ready for Pickup')[0]['value'] ).change();

        }

        function j_received() {
            event.preventDefault();

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd ;

            const d = new Date();
            let timeStr = d.toLocaleTimeString('default', {hour: 'numeric', minute: 'numeric', timeZone: 'Australia/Sydney'});

            $('#datepicker').val(today).change();
            $('#time_id').val(timeStr).change();


            var branch_val = $('.sender_branch').val();
            $('#current_branch').val("").change();

            $('#j_received').css("background-color", "lightblue");
            $('#j_pickup').css("background-color", "white");
            $('#j_book').css("background-color", "white");

            $('#job_status').val(jstatus.filter(e=>e.label=='In Branch')[0]['value'] ).change();

        }

        function j_book() {

            $('#j_book').css("background-color", "lightblue");
            $('#j_received').css("background-color", "white");
            $('#j_pickup').css("background-color", "white");
            $('#datepicker').val("").change();
            $('#time_id').val("").change();
            $('#job_status').val(jstatus.filter(e=>e.label=='Booked In')[0]['value'] ).change();
        }

        $("body").on("click", ".no_onforworder", function() {
            $("input[name='r_reference']").prop("disabled", true);
            $(".forworder_option").prop("disabled", true);
        });

        $("body").on("click", ".yes_onforworder", function() {
            $("input[name='r_reference']").prop("disabled", false);
            $(".forworder_option").prop("disabled", false);

            $('.forword_list').select2({
                placeholder: "Select an option"
            });
        });

        function get_customer() {
            var customer_id = $('#customer_id').val();
            if (customer_id) {
                let url = "{{ route('customers.edit', ':id') }}";
                url = url.replace(':id', customer_id);
                //document.location.href=url,'_blank';
                window.open(
                    url,
                    '_blank' // <- This is what makes it open in a new window.
                );
            } else {
                alert('Please select a customer')
            }
        }

        function makeitsender() {

            var customer_id = $('#customer_id').val();
            $('#makeitsender').css("background-color", "#aaadab");
            $('#makeitreceiver').css("background-color", "#cfd4d1");

            $.ajax({
                type: 'POST',
                url: "{{ route('get_customer') }}",
                data: {
                    'id': customer_id
                },
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    console.log(data);

                    //  if(data['primary_contact'] != 'null'){
                    //      alert(data['primary_contact']);
                    //  }else{
                    //      alert('null');
                    // }
                    //console.log(data['primary_contact'])

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_1 = data.address['0']['p_address_line_1'];
                    } else {
                        var address_line_1 = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_2 = data.address['0']['p_address_line_2'];
                    } else {
                        var address_line_2 = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var suburb = data.address['0']['p_suburb'];
                    } else {
                        var suburb = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var postal_code = data.address['0']['p_postal_code'];
                    } else {
                        var postal_code = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var state = data.address['0']['p_state'];
                    } else {
                        var state = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var time = data.address['0']['p_opening_time'];
                    } else {
                        var time = '';
                    }

                    if (data['primary_contact'] != 'null') {
                        var contact = '';
                        // var contact = data['primary_contact']['contact_name'];
                        //alert('not null')
                    } else {
                        var contact = data['primary_contact']['contact_name'];
                    }

                    if (data['primary_contact'] != 'null') {
                        var phone = '';
                    } else {
                        var phone = data['primary_contact']['mobile'];
                    }


                    $('#customer_id2').val(data.id).change();


                    $('#customer_id5').append($('<option>', {
                        value: '',
                        text: 'Select customer',
                        selected: 'selected'
                    }));

                    $('#hidden_receiver_name').val('');
                    $('#receiver_address_line_1').val('');
                    $('#receiver_address_line_2').val('');
                    $('#r_suburb').val('');
                    $('#r_postal_code_id').val('');
                    $('#receiver_state').val('');
                    $('#r_time').val('');
                    $('#receiver_contact').val('');
                    $('#r_phone').val('');

                    $('#hidden_sender_name').val(data.name);
                    $('#sender_address_line_1_id').val(address_line_1);
                    $('#sender_address_line_2_id').val(address_line_2);
                    $('#suburb').val(suburb);
                    $('#postal_code_id').val(postal_code);
                    $('#sender_state').val(state);
                    $('#s_time').val(time);
                    $('#sender_contact').val(contact);
                    $('#s_phone').val(phone);

                }
            });
        }

        function makeitreceiver() {
            var customer_id = $('#customer_id').val();
            $('#makeitreceiver').css("background-color", "#aaadab");
            $('#makeitsender').css("background-color", "#cfd4d1");
            $.ajax({
                type: 'POST',
                url: "{{ route('get_customer') }}",
                data: {
                    'id': customer_id
                },

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_1 = data.address['0']['p_address_line_1'];
                    } else {
                        var address_line_1 = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var address_line_2 = data.address['0']['p_address_line_2'];
                    } else {
                        var address_line_2 = '';
                    }
                    if (typeof data.address['0'] !== 'undefined') {
                        var suburb = data.address['0']['p_suburb'];
                    } else {
                        var suburb = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var postal_code = data.address['0']['p_postal_code'];
                    } else {
                        var postal_code = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var state = data.address['0']['p_state'];
                    } else {
                        var state = '';
                    }

                    if (typeof data.address['0'] !== 'undefined') {
                        var time = data.address['0']['p_opening_time'];
                    } else {
                        var time = '';
                    }

                    if (data['primary_contact'] != 'null') {
                        var contact = data['primary_contact']['contact_name'];
                    } else {
                        var contact = '';
                    }

                    if (data['primary_contact'] != 'null') {
                        var phone = data['primary_contact']['mobile'];
                    } else {
                        var phone = '';
                    }


                    $('#customer_id5').val(data.id).change();

                    $('#customer_id2').append($('<option>', {
                        value: '',
                        text: 'Select customer',
                        selected: 'selected'
                    }));
                    $('#hidden_sender_name').val('');
                    $('#sender_address_line_1_id').val('');
                    $('#sender_address_line_2_id').val('');
                    $('#suburb').val('');
                    $('#postal_code_id').val('');
                    $('#sender_state').val('');
                    $('#s_time').val('');
                    $('#sender_contact').val('');
                    $('#s_phone').val('');

                    $('#hidden_receiver_name').val(data.name);
                    $('#receiver_address_line_1').val(address_line_1);
                    $('#receiver_address_line_2').val(address_line_2);
                    $('#r_suburb').val(suburb);
                    $('#r_postal_code_id').val(postal_code);
                    $('#receiver_state').val(state);
                    $('#r_time').val(time);
                    $('#receiver_contact').val(contact);
                    $('#r_phone').val(phone);
                }
            });
        }

        /////////////////////////modal work start///////////////

        $("body").on("click", "#item_dg_detail", function() {
            var random_no = $(this).parent().parent().parent().parent().find('#random_no').val();

            if (item_childs.length > 0) {
                var dg_name = '';
                var dg_no = '';
                var dg_group = '';
                var dg_class = '';
                for (var i = 0; i < item_childs.length; i++) {
                    if (item_childs[i].o_random_no == random_no) {
                        dg_name = item_childs[i].o_dg_name;
                        dg_no = item_childs[i].o_dg_no;
                        dg_group = item_childs[i].o_dg_group;
                        dg_class = item_childs[i].o_dg_class;
                    }
                }
                var new_item_row = '<div class="form-row">\n' +
                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Name</label>\n' +
                    '      <input type="hidden" id="random_no" name="random_no" value="' + random_no + '">\n' +
                    '      <input type="text" class="form-control" id="dg_name" name="dg_name" value="' + dg_name +
                    '">\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Un No</label>\n' +
                    '      <input type="text" class="form-control" id="dg_no" name="dg_no" value="' + dg_no +
                    '">\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Packaging Group</label>\n' +
                    '      <input type="text" class="form-control" id="dg_group" name="dg_group" value="' +
                    dg_group + '">\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Class</label>\n' +
                    '<select class="custom-select" id="dg_class" name="dg_class">\n' +
                    '<option selected value="' + dg_class + '">' + dg_class + '</option>\n' +
                    '<option value="Class 1-Explosive">Class 1-Explosive</option>\n' +
                    '<option value="Class 1.4-Explosive">Class 1.4-Explosive</option>\n' +
                    '<option value="Class 1.5-Explosive">Class 1.5-Explosive</option>\n' +
                    '<option value="Class 1.6-Explosive">Class 1.6-Explosive</option>\n' +
                    '<option value="Class 2.1-Explosive">Class 2.1-Explosive</option>\n' +
                    '<option value="Class 2.2-Explosive">Class 2.2-Explosive</option>\n' +
                    '<option value="Class 2.3-Explosive">Class 2.3-Explosive</option>\n ' +
                    '</select>\n' +
                    '    </div>\n' +

                    '    </div>';


                $('#modal_body').append(new_item_row);
                $('#exampleModal').modal('show');
            } else {
                var new_item_row2 = '<div class="form-row">\n' +
                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Name</label>\n' +
                    '      <input type="hidden" id="random_no" name="random_no" value="' + random_no + '">\n' +
                    '      <input type="text" class="form-control" id="dg_name" name="dg_name" >\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Un No</label>\n' +
                    '      <input type="text" class="form-control" id="dg_no" name="dg_no">\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Packaging Group</label>\n' +
                    '      <input type="text" class="form-control" id="dg_group" name="dg_group">\n' +
                    '    </div>\n' +

                    '    <div class="form-group col-md-3">\n' +
                    '      <label for="inputCity">DG Class</label>\n' +
                    '<select class="custom-select" id="dg_class" name="dg_class">\n' +
                    '<option selected value="">Select a class</option>\n' +
                    '<option value="Class 1-Explosive">Class 1-Explosive</option>\n' +
                    '<option value="Class 1.4-Explosive">Class 1.4-Explosive</option>\n' +
                    '<option value="Class 1.5-Explosive">Class 1.5-Explosive</option>\n' +
                    '<option value="Class 1.6-Explosive">Class 1.6-Explosive</option>\n' +
                    '<option value="Class 2.1-Explosive">Class 2.1-Explosive</option>\n' +
                    '<option value="Class 2.2-Explosive">Class 2.2-Explosive</option>\n' +
                    '<option value="Class 2.3-Explosive">Class 2.3-Explosive</option>\n ' +
                    '</select>\n' +
                    '    </div>\n' +

                    '    </div>';


                $('#modal_body').append(new_item_row2);
                $('#exampleModal').modal('show');
            }

        });



        $("body").on("click", ".save_mod", function() {

            var formdata = $(this).parent().parent().find('div#price_by_w_id');
            var row_random_no = formdata.find('#random_no').val();

            var row_dg_name = formdata.find('#dg_name').val();
            var row_dg_no = formdata.find('#dg_no').val();
            var row_dg_group = formdata.find('#dg_group').val();
            var row_dg_class = formdata.find('#dg_class').val();


            if (row_dg_name && row_dg_no && row_dg_group) {
                if (item_childs.length > 0) {
                    for (var i = 0; i < item_childs.length; i++) {
                        if (item_childs[i].o_random_no == row_random_no) {
                            item_childs[i].o_dg_name = row_dg_name;
                            item_childs[i].o_dg_no = row_dg_no;
                            item_childs[i].o_dg_group = row_dg_group;
                            item_childs[i].o_dg_class = row_dg_class;

                            $('#modal_body').html('');
                            $('#exampleModal').modal('hide');
                        } else {
                            var item_child_item_object = {
                                'o_random_no': row_random_no,
                                'o_dg_name': row_dg_name,
                                'o_dg_no': row_dg_no,
                                'o_dg_group': row_dg_group,
                                'o_dg_class': row_dg_class,
                            }

                            item_childs.push(item_child_item_object);


                            $('#modal_body').html('');
                            $('#exampleModal').modal('hide');
                        }
                    }
                } else {
                    var item_child_item_object = {
                        'o_random_no': row_random_no,
                        'o_dg_name': row_dg_name,
                        'o_dg_no': row_dg_no,
                        'o_dg_group': row_dg_group,
                        'o_dg_class': row_dg_class,
                    }

                    item_childs.push(item_child_item_object);

                    $('#modal_body').html('');
                    $('#exampleModal').modal('hide');

                }

            } else {
                alert('Please fill out missing field');
            }
        });

        $("body").on("click", ".w_close_mod", function() {
            $('#modal_body').html('');
            $('#exampleModal').modal('hide');
        });

        /////////////////////////modal work end//////////////////
        /////////////////////// job form submit start ///////////

        $('.item_type').select2({
            placeholder: "Select an item"
        });

        $('.customer_id22').select2({
            placeholder: "Select a sender"
        });
        $('.branches').select2({
            placeholder: "Select a branch"
        });

        $('#customer_id').select2({
            placeholder: "Select a customer"
        });
        $('#customer_id2').select2({
            placeholder: "Select a sender"
        });

        $('#customer_id22').select2({
            placeholder: "Select a sender"
        });
        $('#customer_id3').select2({
            placeholder: "Select a Branch"
        });
        $('#customer_id4').select2({
            placeholder: "Select a name"
        });

        $('#customer_id5').select2({
            placeholder: "Select a name"
        });

        $('.customer_id55').select2({
            placeholder: "Select a name"
        });

        $('#customer_id6').select2({
            placeholder: "Select a name"
        });

        $('#customer_id7').select2({
            placeholder: "Select a name"
        });

        $('#item_type').select2({
            placeholder: "Select a name"
        });



        // $('#job_status').select2({
        //     placeholder: "Select a job status"
        // });

        // nested
        $('#kt_select2_2').select2({
            placeholder: "Select a driver"
        });

        // multi select
        $('#kt_select2_3').select2({
            placeholder: "Select a job type",
        });

        $('#customer_id').select2({
            placeholder: "Select a customer"
        });

        function onSubmitForm() {
            event.preventDefault();


            const name_arr = ['job_type', 'job_status', 'sender_name', 'sender_address_line_1',
                'sender_state', 'sender_contact', 'sender_branch', 'receiver_name', 'receiver_address_line_1',
                'receiver_state', 'receiver_contact', 'receiver_branch', 'item_qty[]',
                'item_type[]', 'item_length[]', 'item_width[]', 'item_height[]', 'item_weight[]'
            ];
            $(".valid-forms").addClass("was-validated");
            // document.getElementById('job_add_form').submit();
            for (i = 0; i < name_arr.length; i++) {
                console.log(name_arr[i], $("[name='" + name_arr[i] + "']").val());
                if ($("[name='" + name_arr[i] + "']").val() == "") {

                    $('html, body').animate({
                        scrollTop: $("[name='" + name_arr[i] + "']").offset().top - 250
                    }, 1000);

                    return false;
                }


            }


            var formData = $("#job_add_form").serialize();
            console.log("res", formData);
            $.post("{{ route('jobs.store') }}", formData, function(data) {
                console.log("DDDDDDDDDDDDDD", data);
                if(!data.xero){
                    $.toast({
                        heading: 'Manage Freight',
                        text: 'Xero connectioin failed, please connect again.',
                        hideAfter: 2000,
                        position: 'top-right',
                        icon: 'warning'
                    });
                    setTimeout(() => {
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/admin/xero/connect";
                    }, "2000");
                }else{
                    $.toast({
                        heading: 'Manage Freight',
                        text: data.message,
                        hideAfter: 3000,
                        position: 'top-right',
                        icon: data.status ? 'success' : 'warning'
                    })
                    if(data.res==''){
                        $("#job_add_form")[0].reset();
                    }
                    $(".valid-forms").removeClass("was-validated");
                }
            });
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


