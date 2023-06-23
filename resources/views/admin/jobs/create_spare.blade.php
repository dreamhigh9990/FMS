@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
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
                                <a href="" class="text-muted">Add Job</a>
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
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header" style="">
                        <div class="card-title">
                            <h3 class="card-label">Job Add Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small>
                            </h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('jobs.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a href="{{ route('jobs.store') }}" onclick="event.preventDefault(); job_form_submit();"
                                    id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Save</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.partials._messages')
                        <!--begin::Form-->
                        {{ Form::open(['route' => 'jobs.store','class' => 'form','id' => 'job_add_form','enctype' => 'multipart/form-data']) }}
                        @csrf
                        <div class="row">
                            <div class="col-xl-1"></div>
                            <div class="col-xl-10">
                                <div>
                                    <h3 class="text-dark font-weight-bold mb-10">Job Info: </h3>
                                    <div style="padding: 40px;border: 2px solid lightgray;">
                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <label>Job No:</label>
                                                <input readonly type="text" name="job_no" class="form-control"
                                                    value="{{ $job_no }}" />
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Connote No:</label>
                                                <input readonly type="text" name="connote_no" class="form-control"
                                                    value="{{ $connote_no }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Customer:</label>
                                                <div>
                                                    <select class="form-control select2" id="customer_id">
                                                        <option value="">select customer</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="form-text text-muted">If customer doesn't exist, <a
                                                            href="{{ route('customers.create') }}"> Add Customer</a></span>

                                                </div>
                                            </div>
                                            <div class="col-lg-3" style="margin-top: 30px">
                                                <a href="javascript:void(0);" onclick="get_customer()"
                                                    class="btn btn-primary btn-sm float-left">Edit Customer</a>
                                            </div>
                                            <div class="col-lg-5" style="margin-top: 30px">
                                                <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                    <a href="javascript:void(0);" onclick="makeitsender();"
                                                        class="btn btn-secondary">Make Sender</a>
                                                    <a href="javascript:void(0);" onclick="makeitreceiver();"
                                                        class="btn btn-secondary">Make Receiver</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Reference:</label>
                                                <input type="text" name="m_reference" class="form-control" />
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Invoice no:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="invoice_no" class="form-control" disabled />
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0);" class="btn open_invoice"><i id="lock"
                                                                class="fa fa-lock"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Add a new file:</label>
                                                <input type="file" id="job_file" name="m_file" class="form-control-file"
                                                    accept=".txt,.pdf,.jpeg,.jpg,.docx,.doc,.ppt,.pptx,.xls,.xlsx" />
                                            </div>
                                            <div class="col-lg-8">
                                                <span class="form-text text-muted">Files must be less than <strong>2
                                                        MB.</strong></span>
                                                <span class="form-text text-muted">Allowed file types:<strong>txt pdf jpeg
                                                        jpg docx doc ppt pptx xls xlsx</strong>.</span>
                                            </div>
                                        </div>
                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Manual Connote No:</label>
                                                <input type="text" name="m_connote_no" class="form-control" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Quote No:</label>
                                                <input type="text" name="quote_no" class="form-control" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Job Type:</label>

                                                <div>
                                                    <select class="form-control srequired job_type select2"
                                                        id="kt_select2_3" name="job_type">
                                                        <option value="" selected>-none-</option>
                                                        <option value="general">General</option>
                                                        <option value="express">Express</option>
                                                        <option value="hotshot">Hotshot</option>
                                                        <option value="special">Special</option>
                                                    </select>
                                                </div>
                                                <br>

                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <div class="col-lg-4">
                                                <label>Assigned Driver:</label>
                                                <div>
                                                    <select class="form-control assigned_driver select2 srequired"
                                                        id="kt_select2_2" name="assigned_driver">
                                                        <option value="" selected>-none-</option>
                                                        @foreach ($all_drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Job Status:</label>
                                                <div>
                                                    <select class="form-control job_status srequired select2"
                                                        id="job_status" name="job_status">
                                                        <option value="" selected>-none-</option>
                                                        @foreach ($all_status as $status)
                                                            <option value="{{ $status->id }}">{{ $status->job_status }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>current Branch:</label>
                                                <div>
                                                    <select class="form-control select2" id="current_branch"
                                                        name="current_branch" disabled>
                                                        <option></option>
                                                        @foreach ($all_branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->branches }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="padding: 40px; border: 2px solid lightgray; margin-top: 30px;">

                                        <h4>SENDER:</h4>
                                        <div id="sender_div">
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <label>Sender Name:</label>
                                                    <div>
                                                        <input type="hidden" name="sender_name" id="hidden_sender_name">
                                                        <select class="form-control srequired sender_name select2"
                                                            id="customer_id2">
                                                            <option value="">Select sender</option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="checkbox" style="margin-top: 30px;">
                                                        <input type="checkbox" name="manual_entry" id="s_manual_entry" />
                                                        <span></span>
                                                        &nbsp;
                                                        Manual Entry
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label>Address line 1:</label>
                                                    <input type="text" name="sender_address_line_1"
                                                        class=" required form-control" id="sender_address_line_1_id"
                                                        placeholder="Enter a location" />

                                                </div>

                                                <div class="col-lg-6">
                                                    <label>Address line 2:</label>
                                                    <input type="text" name="sender_address_line_2" class="form-control"
                                                        id="sender_address_line_2_id" placeholder="Enter a location" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Suburb:</label>
                                                    <input type="text" name="suburb" class="form-control" id="suburb" />
                                                </div>
                                                <div class="col-4">
                                                    <label>Postal Code:</label>
                                                    <input type="text" name="postal_code" class="form-control"
                                                        id="postal_code_id" />
                                                </div>

                                                <div class="col-4">
                                                    <label>State:</label>
                                                    <input type="text" name="sender_state" class="required form-control"
                                                        id="sender_state" />

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Time:</label>
                                                    <input type="text" name="s_time" class="form-control" id="s_time" />
                                                </div>
                                                <div class="col-4">
                                                    <label>Contact:</label>
                                                    <input type="text" name="sender_contact" class="required form-control"
                                                        id="sender_contact" />

                                                </div>
                                                <div class="col-4">
                                                    <label>Phone:</label>
                                                    <input type="text" name="s_phone" class="form-control" id="s_phone" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Sender Branch:</label>
                                                <div>
                                                    <select class="form-control srequired sender_branch select2 branches"
                                                        name="sender_branch">
                                                        <option value=""></option>
                                                        @foreach ($all_branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->branches }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="checkbox" style="margin-top: 30px;">
                                                    <input type="checkbox" name="third_part_collection_charge" />
                                                    <span></span>
                                                    &nbsp;
                                                    Third Party Collection Charge
                                                </label>

                                            </div>
                                            <div class="col-lg-4">
                                                <div style="margin-top: 25px;" class="btn-group" role="group"
                                                    aria-label="Basic example">
                                                    <a href="javascript:void(0)" onclick="j_pickup()"
                                                        class="btn btn-secondary"
                                                        style="border: deepskyblue 2px solid">Pick Up</a>
                                                    <button onclick="j_received()" class="btn btn-secondary"
                                                        style="border: deepskyblue 2px solid">Received In</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Charge Collector Name:</label>
                                                <div>
                                                    <select class="form-control select2 charge_collector_name"
                                                        id="customer_id4" name="charge_collector_name">
                                                        <option value="teryTruck 1">Terytruck 1</option>
                                                        <option value="teryTruck 2">Terytruck 2</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label>Cost($):</label>
                                                <input type="text" name="charge_collector_cost" class="form-control"
                                                    id="cost_id" placeholder="Enter a cost" />

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Ready Date:</label>
                                                <input type="text" name="ready_date" class="form-control" id="datepicker"
                                                    placeholder="Ready date" />
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Ready Time:</label>
                                                <input type="text" name="ready_time" class="form-control" id="time_id" />
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Pick Up notes:</label>
                                                <textarea class="form-control" style="height: 130px" name="Pick_up_notes"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div style="padding: 40px; border: 2px solid lightgray; margin-top: 30px;">

                                        <h4>RECEIVER:</h4>
                                        <div id="receiver_div">
                                            <div class="form-group row">
                                                <div class="col-8">
                                                    <label>Receiver name:</label>
                                                    <div>
                                                        <input type="hidden" name="receiver_name" id="hidden_receiver_name">
                                                        <select class="form-control srequired receiver_name select2"
                                                            id="customer_id5">
                                                            <option value="">Select receiver</option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-4">
                                                    <label class="checkbox" style="margin-top: 30px;">
                                                        <input type="checkbox" name="r_manual_entry" id="r_manual_entry" />
                                                        <span></span>
                                                        &nbsp;
                                                        Manual Entry
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <label>Address line 1:</label>
                                                    <input type="text" name="receiver_address_line_1"
                                                        class="required form-control" id="receiver_address_line_1" />

                                                </div>

                                                <div class="col-6">
                                                    <label>Address line 2:</label>
                                                    <input type="text" name="receiver_address_line_2" class="form-control"
                                                        id="receiver_address_line_2" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Suburb:</label>
                                                    <input type="text" name="r_suburb" class="form-control"
                                                        id="r_suburb" />
                                                </div>
                                                <div class="col-4">
                                                    <label>Postal Code:</label>
                                                    <input type="text" name="r_postal_code" class="form-control"
                                                        id="r_postal_code_id" />
                                                </div>
                                                <div class="col-4">
                                                    <label>State:</label>
                                                    <input type="text" name="receiver_state" class="required form-control"
                                                        id="receiver_state" />

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Time:</label>
                                                    <input type="text" name="r_time" class="form-control" id="r_time" />
                                                </div>
                                                <div class="col-4">
                                                    <label>Contact:</label>
                                                    <input type="text" name="receiver_contact" class="required form-control"
                                                        id="receiver_contact" />

                                                </div>
                                                <div class="col-4">
                                                    <label>Phone:</label>
                                                    <input type="text" name="r_phone" class="form-control"
                                                        id="r_phone" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Receiver Branch:</label>
                                                <div>
                                                    <select class="form-control srequired receiver_branch select2 branches"
                                                        name="receiver_branch">
                                                        <option value=""></option>
                                                        @foreach ($all_branches as $branch)
                                                            <option value="{{ $branch->id }}">{{ $branch->branches }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label class="col-form-label">Onforwarder</label>
                                                <div class="col-form-label">
                                                    <div class="radio-inline">
                                                        <label class="radio radio-primary">
                                                            <input class="no_onforworder" type="radio" name="onforworder"
                                                                value="no" checked="checked" />
                                                            <span></span>
                                                            No
                                                        </label>
                                                        <label class="radio radio-primary">
                                                            <input class="yes_onforworder" type="radio" name="onforworder"
                                                                value="yes" />
                                                            <span></span>
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label class="checkbox" style="margin-top: 30px;">
                                                    <input type="checkbox" name="r_collect_at_branch" />
                                                    <span></span>
                                                    &nbsp;
                                                    Collect at branch
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-6">
                                                <label>Forwarder list:</label>
                                                <div>
                                                    <select class="form-control forword_list forworder_option select2"
                                                        id="Forwarder list" name="forworder_option" disabled>
                                                        <option value="Jhon forworder 1">Jhon forworder 1</option>
                                                        <option value="Jhon forworder 2">Jhon forworder 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label>Reference:</label>
                                                <input type="text" name="r_reference" class="form-control"
                                                    id="reference_id" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label>Delivery Notes:</label>
                                                <textarea class="form-control r_Pick_up_notes" style="height: 130px" name="r_Pick_up_notes"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12" style="margin-top: 20px;">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-secondary btn-lg float-right">Calculate</a>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    {{-- add item start --}}

                                    <h4>ADD ITEMS:</h4>
                                    <div style="padding: 20px; border: 2px solid lightgray; margin-top: 30px;"
                                        id="item_parent_div">
                                        <div id="item-table">
                                            <input type="hidden" value="{{ rand(10000, 100000) }}" name="random_no[]"
                                                id="random_no">
                                            <div style="border: 1px solid lightgray; padding: 20px;">
                                                <div class="form-group row">
                                                    <div class="col-lg-2">
                                                        <label>REFERENCE:</label>
                                                        <input type="text" name="item_reference[]"
                                                            class="form-control form-control-sm" id="item_reference" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>QTY:</label>
                                                        <input type="number" name="item_qty[]"
                                                            class="required form-control form-control-sm" id="item_qty" />

                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>ITEM TYPE:</label>
                                                        <div>
                                                            <select
                                                                class="form-control srequired item_type form-control-sm item_type"
                                                                name="item_type[]">
                                                                <option value=""></option>
                                                                @foreach ($all_items as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->item_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>DESCRIPTION:</label>
                                                        <input type="text" name="item_description[]"
                                                            class="form-control form-control-sm" id="item_description" />
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-lg-2">
                                                        <label>LENGTH:</label>
                                                        <input type="number" name="item_length[]"
                                                            class=" required form-control form-control-sm"
                                                            id="item_length" />
                                                        <br>

                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>WIDTH:</label>
                                                        <input type="number" name="item_width[]"
                                                            class="required form-control form-control-sm"
                                                            id="item_width" />

                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>HEIGHT:</label>
                                                        <input type="number" name="item_height[]"
                                                            class="required form-control form-control-sm"
                                                            id="item_height" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>WEIGHT:</label>
                                                        <input type="number" name="item_weight[]"
                                                            class="required form-control form-control-sm"
                                                            id="item_weight" />
                                                    </div>



                                                    <div class="col-lg-2">
                                                        <label>T WEIGHT:</label>
                                                        <input type="number" name="item_tweight[]"
                                                            class="form-control form-control-sm" id="item_tweight"
                                                            readonly />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="checkbox" style="margin-top: 30px;">
                                                            <input type="checkbox" name="item_stackable[]" />
                                                            <span></span>
                                                            &nbsp
                                                            STACKABLE
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-2">
                                                        <label>PLT SPC:</label>
                                                        <input type="text" name="item_plt_spc[]"
                                                            class="form-control form-control-sm" id="item_plt_spc" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label></label>
                                                        <input type="button"
                                                            class="form-control btn-sm btn-primary form-control-sm"
                                                            id="item_dg_detail" value="DG DETAILS" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>CUBIC(m³):</label>
                                                        <input type="nuber" name="item_cubic_m3[]"
                                                            class="form-control form-control-sm" id="item_cubic_m3" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>COST($):</label>
                                                        <input type="text" name="item_cost[]"
                                                            class="form-control form-control-sm" id="item_cost" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>COMMENTS:</label>
                                                        <input type="text" name="item_comments[]"
                                                            class="form-control form-control-sm" id="item_comments" />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label>ITEM DETAIL:</label>
                                                        <input type="text" name="item_detail[]"
                                                            class="form-control form-control-sm" id="item_detail" />
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
                                    </div>

                                    {{-- add item end --}}

                                    <input type="hidden" id="item_dg_data" name="item_dg_data" value="">


                                    <br>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <button onclick="event.preventDefault(); addItem();"
                                                class="btn btn-secondary btn-lg float-left">Add New</button>
                                        </div>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                    <h4>LOAD RESTRAINTS</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="bolsters" />
                                                <span></span>
                                                &nbsp
                                                Bolsters
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="chains" />
                                                <span></span>
                                                &nbsp
                                                Chains
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="dogs" />
                                                <span></span>
                                                &nbsp
                                                Dogs
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="gates" />
                                                <span></span>
                                                &nbsp
                                                Gates
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="rt" />
                                                <span></span>
                                                &nbsp
                                                RT
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="straps" />
                                                <span></span>
                                                &nbsp
                                                Straps
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="timber" />
                                                <span></span>
                                                &nbsp
                                                Timber
                                            </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="trap" />
                                                <span></span>
                                                &nbsp
                                                Trap
                                            </label>
                                        </div>
                                    </div>

                                    <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                    <br>
                                    <h4>PALLET CONTROL</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>In Chep:</label>
                                            <input type="text" name="in_chep" class="form-control form-control-sm"
                                                id="item_in_chep" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Out Chep:</label>
                                            <input type="text" name="out_chep" class="form-control form-control-sm"
                                                id="item_out_chep" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label>In Loscam:</label>
                                            <input type="text" name="in_loscam" class="form-control form-control-sm"
                                                id="item_in_loscam" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Out Loscam:</label>
                                            <input type="text" name="out_loscam" class="form-control form-control-sm"
                                                id="item_out_loscam" />
                                        </div>
                                    </div>
                                    <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                    <br>
                                    <h4>TOTAL PRICE</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label>Total Price($):</label>
                                            <input type="text" name="job_total_price" class="form-control form-control-sm"
                                                id="job_total_price" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Handling Fee($):</label>
                                            <input type="text" name="job_handling_fee" class="form-control form-control-sm"
                                                id="job_handling_fee" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Hand Unload Fee($):</label>
                                            <input type="text" name="job_unload_fee" class="form-control form-control-sm"
                                                id="job_unload_fee" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" name="job_pick_up_fee" />
                                                <span></span>
                                                &nbsp
                                                Include Pickup Fee?
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="checkbox" style="margin-top: 30px;">
                                                <input type="checkbox" checked name="job_delivery_fee" />
                                                <span></span>
                                                &nbsp
                                                Include Delevery Fee?
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-1"></div>
                        </div>

                    </div>
                    {{ Form::close() }}
                    <!--end::Form-->
                </div>
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
            var item_html = '                            <div id="item-table">\n' +
                '                                           <input type="hidden" value="' + js_random_no +
                '" name="random_no[]" id="random_no">\n' +
                '                                            <div style="border: 1px solid lightgray; padding: 20px;">\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>REFERENCE:</label>\n' +
                '                                                        <input type="text" name="item_reference[]" class="form-control form-control-sm" id="item_reference"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>QTY:</label>\n' +
                '                                                        <input type="number" name="item_qty[]" class="form-control required form-control-sm" id="item_qty"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-4">\n' +
                '                                                        <label>ITEM TYPE:</label>\n' +
                '                                                        <div>\n' +
                '                                                            <select class="form-control srequired item_type"  name="item_type[]">\n' +
                '                                                                 <option value=""></option>\n' +
                @foreach ($all_items as $item)
                    \n' +
                    ' <option value="{{ $item->id }}">{{ $item->item_name }}</option>\n' +
                    '
                @endforeach\n' +
                '                                                            </select>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-4">\n' +
                '                                                        <label>DESCRIPTION:</label>\n' +
                '                                                        <input type="text" name="item_description[]" class="form-control form-control-sm" id="item_description"/>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>LENGTH:</label>\n' +
                '                                                        <input type="number" name="item_length[]" class=" required form-control form-control-sm" id="item_length"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>WIDTH:</label>\n' +
                '                                                        <input type="number" name="item_width[]" class="required form-control form-control-sm" id="item_width"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>HEIGHT:</label>\n' +
                '                                                        <input type="number" name="item_height[]" class="required form-control form-control-sm" id="item_height"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>WEIGHT:</label>\n' +
                '                                                        <input type="number" name="item_weight[]" class="required form-control form-control-sm" id="item_weight"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>T WEIGHT:</label>\n' +
                '                                                        <input type="number" name="item_tweight[]" class="form-control form-control-sm" id="item_tweight" readonly />\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label class="checkbox" style="margin-top: 30px;">\n' +
                '                                                            <input type="checkbox" name="item_stackable[]"/>\n' +
                '                                                            <span></span>\n' +
                '                                                            &nbsp\n' +
                '                                                            STACKABLE\n' +
                '                                                        </label>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>PLT SPC:</label>\n' +
                '                                                        <input type="text" name="item_plt_spc[]" class="form-control form-control-sm" id="item_plt_spc"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label></label>\n' +
                '                                                        <input type="button" class="form-control btn-sm btn-primary" id="item_dg_detail" value="DG DETAILS"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>CUBIC(m³):</label>\n' +
                '                                                        <input type="number" name="item_cubic_m3[]" class="form-control form-control-sm" id="item_cubic_m3"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>COST($):</label>\n' +
                '                                                        <input type="text" name="item_cost[]" class="form-control form-control-sm" id="item_cost"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
                '                                                        <label>COMMENTS:</label>\n' +
                '                                                        <input type="text" name="item_comments[]" class="form-control form-control-sm" id="item_comments"/>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="col-lg-2">\n' +
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
                '                                                            <span></span>\n' +
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
                @foreach ($customers as $customer)
                    \n' +
                    ' <option value="{{ $customer->id }}">{{ $customer->name }}</option>\n' +
                    '
                @endforeach\n' +
                '                                                            </select>\n' +
                '                                                        </div>\n' +

                '                                                    </div>\n' +
                '                                                    <div class="col-lg-4">\n' +
                '                                                        <label class="checkbox" style="margin-top: 30px;">\n' +
                '                                                            <input type="checkbox" name="manual_entry" id="s_manual_entry"/>\n' +
                '                                                            <span></span>\n' +
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
                        if (data.address['0']['p_address_line_1']) {
                            var address_line_1 = data.address['0']['p_address_line_1'];
                        } else {
                            var address_line_1 = '';
                        }

                        var address_line_2 = data.address['0']['p_address_line_2'];
                        var suburb = data.address['0']['p_suburb'];
                        var postal_code = data.address['0']['p_postal_code'];
                        var state = data.address['0']['p_state'];
                        var time = data.address['0']['p_opening_time'];
                        var contact = data['primary_contact']['contact_name'];
                        var phone = data['primary_contact']['mobile'];

                        //$('#customer_id2').val(data.id).change();


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
            });
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
                '                                                        <span></span>\n' +
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
                @foreach ($customers as $customer)
                    \n' +
                    ' <option value="{{ $customer->id }}">{{ $customer->name }}</option>\n' +
                    '
                @endforeach\n' +
                '                                                        </select>\n' +
                '                                                    </div>\n' +

                '                                                </div>\n' +
                '                                                <div class="col-4">\n' +
                '                                                    <label class="checkbox" style="margin-top: 30px;">\n' +
                '                                                        <input type="checkbox" name="r_manual_entry" id="r_manual_entry"/>\n' +
                '                                                        <span></span>\n' +
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
                        $('#r_conreceiver_contacttact').val(contact);
                        $('#r_phone').val(phone);

                    }
                });
            });
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
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left"
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
                var cubicmeter = (item_width * item_height * $(this).val()) / 100;
                $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
            }
        });

        $("body").on("input", "#item_width", function() {
            var item_width = $(this).parent().parent().parent().find("#item_length").val();
            var item_height = $(this).parent().parent().parent().find("#item_height").val();
            if (item_width && item_height) {
                var cubicmeter = (item_width * item_height * $(this).val()) / 100;
                $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
            }
        });

        $("body").on("input", "#item_height", function() {
            var item_width = $(this).parent().parent().parent().find("#item_length").val();
            var item_height = $(this).parent().parent().parent().find("#item_width").val();
            if (item_width && item_height) {
                var cubicmeter = (item_width * item_height * $(this).val()) / 100;
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

        function j_pickup() {
            var branch_val = $('#customer_id3').val();
            $('#current_branch').val(branch_val).change();
            $('#job_status').val('1').change();
        }

        function j_received() {
            event.preventDefault();
            var branch_val = $('#customer_id3').val();
            $('#current_branch').val(branch_val).change();

            $('#job_status').val('2').change();
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
                document.location.href = url;
            } else {
                alert('Please select a customer')
            }

        }

        function makeitsender() {

            var customer_id = $('#customer_id').val();


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



        $('#job_status').select2({
            placeholder: "Select a job status"
        });
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




        /////////////////////// job form submit end /////////////

        function job_form_submit() {

            $('#item_dg_data').val(JSON.stringify(item_childs));
            var connote_no = $('input[name="connote_no"]').val();
            var m_connote_no = $('input[name="m_connote_no"]').val();
            if (m_connote_no) {
                $('input[name="connote_no"]').val(m_connote_no);
            }
            var fill = 'true';
            $(".required").each(function() {
                var field_val = $(this).val();
                if (!field_val) {
                    $(this).addClass('border border-danger');
                    fill = "false";
                    Swal.fire({
                        title: 'Fill all the fields to proceed your JOb',
                    })
                }

            });

            $(".srequired").each(function() {
                var field_val = $(this).val();
                if (!field_val) {
                    $(this).parent().addClass('border border-danger');
                    fill = "false";
                    Swal.fire({
                        title: 'Fill all the fields to proceed your JOb',
                    })
                }

            });
            if (fill == "true") {
                document.getElementById('job_add_form').submit();
            }

        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
