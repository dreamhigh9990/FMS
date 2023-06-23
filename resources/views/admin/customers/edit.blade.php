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
                                <a href="{{ route('customers.index') }}" class="text-muted">Manage Customer</a>
                            </li>
                            @if (isset($user))
                                <li class="breadcrumb-item text-muted">
                                    Edit Customer
                                </li>

                                <li class="breadcrumb-item text-muted">
                                    {{ $user->name }}
                                </li>
                            @else
                                <li class="breadcrumb-item text-muted">
                                    New Customer
                                </li>
                            @endif

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
                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header" style="">
                        <div class="card-title">
                            <h3 class="card-label">Customer Edit Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small>
                            </h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('customers.index') }}"
                                class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>
                            <div class="btn-group">
                                @if (isset($user['primary_contact']->contact_name))
                                    <a href="#" onclick="event.preventDefault(); save_customer_form();" id="kt_btn"
                                        class="btn btn-primary font-weight-bolder">
                                        <i class="ki ki-check icon-sm"></i>update</a>
                                @else
                                    <a href="#" onclick="event.preventDefault(); save_customer_form();" id="kt_btn"
                                        class="btn btn-primary font-weight-bolder">
                                        <i class="ki ki-check icon-sm"></i>save</a>
                                @endif

                            </div>


                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.partials._messages')
                        <!--begin::Form-->
                        {{-- {{ Form::model(['method' => 'PATCH', 'class' => 'form', 'id' => 'client_update_form', 'enctype' => 'multipart/form-data']) }} --}}
                        <form id="client_update_form">
                            @csrf
                        <div class="card-body">
                            <h3 class="text-dark font-weight-bold mb-10">Customer Info: </h3>
                            <div class="form-group row was-validated">

                                @if (isset($user))
                                    <div class="col-lg-4">
                                        <label><strong> Name: </strong><span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                        <!-- {{ Form::text('name', $user['name'], ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Name', 'required' => 'true']) }} -->
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Name" value="{{ $user->name }}" required />
                                    </div>
                                    <div class="invalid-feedback">Please enter customer name</div>
                                    <div class="col-lg-4">
                                        <label>Pricing Plan</label>
                                        <div>
                                            <select class="form-control" id="kt_select2_1" name="plan">
                                                @foreach ($plans as $plan)
                                                    <option value="{{ $plan['id'] }}" {{$plan['id']==$user['plan']?'selected':''}}>{{ $plan['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">If plan does not exist, <a
                                                href="{{ route('pricing.create') }}" target="_blank">Create a
                                                Plan</a></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Active</label>
                                        <div class="col-4">
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox" {{ $user->active ? 'checked' : '' }}
                                                        name="active" onclick="check_method()">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-4">
                                        <label><strong>Name: </strong><span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                        <!-- {{ Form::text('name', null, ['class' => 'form-control form-control-solid', 'id' => 'name', 'placeholder' => 'Enter Name', 'required' => 'true']) }} -->
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Name" required />
                                        <div class="invalid-feedback">Please enter customer name</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Pricing Plan</label>
                                        <div>
                                            <select class="form-control" id="kt_select2_1" name="plan">
                                                @foreach ($plans as $plan)
                                                    <option value="{{ $plan['id'] }}">{{ $plan['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">If plan does not exist, <a
                                                href="{{ route('pricing.create') }}" target="_blank">Create a
                                                Plan</a></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Active</label>
                                        <div class="col-4">
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label><input type="checkbox" checked="checked" name="active" value="1">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row was-validated">
                                <div class="col-lg-4">
                                    <label>Primary Contact</label>
                                    <div>
                                        <select class="form-control " id="primary_contact" name="primary_contact">
                                            @foreach ($contacts as $contact)
                                                <option value="{{ $contact['id'] }}" {{isset($user) &&  $user->primary_contact==$contact['id']?'selected':''}}>{{ $contact['contact_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">If contact does not exist,
                                        <a href="">Create a contact</a></span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Primary Site</label>
                                    <div>
                                        <select class="form-control " id="primary_site" name="primary_site">
                                            @foreach ($sites as $site)
                                                <option value="{{ $site['id'] }}" {{isset($user) &&  $user->primary_site==$site['id']?'selected':''}} >{{ $site['site_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">If site does not exist,
                                        <a href="">Create a site</a></span>
                                </div>
                            </div>
                        </div>

                        </form>
                        {{-- {{ Form::close() }} --}}

                        <hr>
                        <div class="tab">
                            <button class="tablinks c_detail" onclick="openCity(event, 'contact')">Contact Details <span
                                    style="color: red;font-size: 15px;">*</span></button>
                            <button class="tablinks t_sites" onclick="openCity(event, 'sites')">Sites <span
                                style="color: red;font-size: 15px;">*</span></button>
                            {{-- <button class="tablinks p_address" onclick="openCity(event, 'address')">Address <span
                                    style="color: red;font-size: 15px;">*</span></button> --}}
                            <button class="tablinks p_account_detail" onclick="openCity(event, 'account_detail')">Account
                                Detail <span style="color: red;font-size: 15px;">*</span></button>
                            <button class="tablinks t_bookings" onclick="openCity(event, 'bookings')">Bookings</button>
                            <button class="tablinks t_invoices" onclick="openCity(event, 'invoices')">Invoices</button>
                            <button class="tablinks t_notes" onclick="openCity(event, 'notes')">Notes</button>
                            <button class="tablinks t_attachments" onclick="openCity(event, 'attachments')">Attachments</button>

                        </div>

                        <form class="form" id="customer_form" method="post"
                            @if (isset($user)) action="{{ route('update_customer') }}" @else action="{{ route('store_customer') }}" @endif
                            enctype="multipart/form-data">
                            @csrf

                            @if (isset($user))
                                <input type="hidden" class="customer_id" value="{{ $user->id }}" name="c_id">
                            @endif

                            <input type="hidden" value="" name="c_name">
                            <input type="hidden" value="" name="c_plan">
                            <input type="hidden" value="" name="c_active">




                            <div id="address" class="tabcontent">
                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Primary Address: </h3>
                                    <div class="form-group row was-validated">
                                        <div class="col-lg-6">
                                            <label><strong>Address Line 1 </strong><span
                                                    style="color: red;font-size: 22px;">*</span>:</label>
                                            @if (isset($user['address']['0']->p_address_line_1))
                                                <input type="text" name="p_address_line_1" id="p_address_line_1"
                                                    class="form-control" placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->p_address_line_1 }}" required />
                                            @else
                                                <input type="text" name="p_address_line_1" id="p_address_line_1"
                                                    class="form-control" placeholder="Enter a location" required />
                                            @endif
                                            <div class="invalid-feedback">Please enter your address line 1</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Address Line 2:</label>
                                            @if (isset($user['address']['0']->p_address_line_2))
                                                <input type="text" name="p_address_line_2" class="form-control"
                                                    id="p_address_line_2" placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->p_address_line_2 }}" />
                                            @else
                                                <input type="text" name="p_address_line_2" class="form-control"
                                                    id="p_address_line_2" placeholder="Enter a location" />
                                            @endif
                                            <div class="invalid-feedback">Please enter your address line 2</div>
                                        </div>

                                    </div>
                                    <div class="form-group row was-validated">
                                        <div class="col-lg-6">
                                            <label>Suburb:<span style="color: red;font-size: 22px;">*</span></label>
                                            @if (isset($user['address']['0']->p_suburb))
                                                <input type="text" name="p_suburb" class="form-control"
                                                    placeholder="Enter your suburb"
                                                    value="{{ $user['address']['0']->p_suburb }}" required />
                                            @else
                                                <input type="text" name="p_suburb" class="form-control"
                                                    placeholder="Enter your suburb" required />
                                            @endif
                                            <div class="invalid-feedback">Please enter your Suburb.</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><strong>Postal Code </strong><span
                                                    style="color: red;font-size: 22px;">*</span>:</label>
                                            @if (isset($user['address']['0']->p_postal_code))
                                                <input type="text" name="p_postal_code" class="form-control"
                                                    id="p_postal_code" placeholder="Enter your postal code"
                                                    value="{{ $user['address']['0']->p_postal_code }}" required />
                                            @else
                                                <input type="text" name="p_postal_code" class="form-control"
                                                    id="p_postal_code" placeholder="Enter your postal code" required />
                                            @endif

                                            <div class="invalid-feedback">Please enter your Postal</div>
                                        </div>
                                    </div>
                                    <div class="form-group row was-validated">
                                        <div class="col-lg-6">
                                            <label>State:<span style="color: red;font-size: 22px;">*</span></label>
                                            @if (isset($user['address']['0']->p_state))
                                                <input type="text" name="p_state" class="form-control"
                                                    placeholder="Enter your state"
                                                    value="{{ $user['address']['0']->p_state }}" required />
                                            @else
                                                <input type="text" name="p_state" class="form-control"
                                                    placeholder="Enter your state" required />
                                            @endif

                                            <div class="invalid-feedback">Please enter your State</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Opening Time:</label>
                                            @if (isset($user['address']['0']->p_opening_time))
                                                <input type="time" name="p_opening_time" class="form-control"
                                                    placeholder="Enter your opening time"
                                                    value="{{ $user['address']['0']->p_opening_time }}" />
                                            @else
                                                <input type="time" name="p_opening_time" class="form-control"
                                                    placeholder="Enter your opening time" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your opening time</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Business Address: </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Address Line 1:</label>
                                            @if (isset($user['address']['0']->b_address_line_1))
                                                <input type="text" name="b_address_line_1" id="b_address_line_1"
                                                    class="form-control" placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->b_address_line_1 }}" />
                                            @else
                                                <input type="text" name="b_address_line_1" id="b_address_line_1"
                                                    class="form-control" placeholder="Enter a location" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your address line 1</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Address Line 2:</label>
                                            @if (isset($user['address']['0']->b_address_line_2))
                                                <input type="text" name="b_address_line_2" id="b_address_line_2"
                                                    class="form-control" placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->b_address_line_2 }}" />
                                            @else
                                                <input type="text" name="b_address_line_2" id="b_address_line_2"
                                                    class="form-control" placeholder="Enter a location" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your address line 2</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Suburb:</label>
                                            @if (isset($user['address']['0']->b_suburb))
                                                <input type="text" name="b_suburb" class="form-control"
                                                    placeholder="Enter your suburb"
                                                    value="{{ $user['address']['0']->b_suburb }}" />
                                            @else
                                                <input type="text" name="b_suburb" class="form-control"
                                                    placeholder="Enter your suburb" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Suburb</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Postal Code:</label>
                                            @if (isset($user['address']['0']->b_postal_code))
                                                <input type="text" name="b_postal_code" class="form-control"
                                                    placeholder="Enter your postal code"
                                                    value="{{ $user['address']['0']->b_postal_code }}" />
                                            @else
                                                <input type="text" name="b_postal_code" class="form-control"
                                                    placeholder="Enter your postal code" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Postal</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>State:</label>
                                            @if (isset($user['address']['0']->b_state))
                                                <input type="text" name="b_state" class="form-control"
                                                    placeholder="Enter your state"
                                                    value="{{ $user['address']['0']->b_state }}" />
                                            @else
                                                <input type="text" name="b_state" class="form-control"
                                                    placeholder="Enter your state" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your State</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Opening Time:</label>
                                            @if (isset($user['address']['0']->b_opening_time))
                                                <input type="time" name="b_opening_time" class="form-control"
                                                    placeholder="Enter your opening time"
                                                    value="{{ $user['address']['0']->b_opening_time }}" />
                                            @else
                                                <input type="time" name="b_opening_time" class="form-control"
                                                    placeholder="Enter your opening time" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your opening time</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Residential Address: </h3>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Address Line 1:</label>
                                            @if (isset($user['address']['0']->r_address_line_1))
                                                <input type="text" name="receiver_address_line_1"
                                                    id="receiver_address_line_1" class="form-control"
                                                    placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->receiver_address_line_1 }}" />
                                            @else
                                                <input type="text" name="receiver_address_line_1"
                                                    id="receiver_address_line_1" class="form-control"
                                                    placeholder="Enter a location" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your address line 1</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Address Line 2:</label>
                                            @if (isset($user['address']['0']->receiver_address_line_2))
                                                <input type="text" name="receiver_address_line_2"
                                                    id="receiver_address_line_2" class="form-control"
                                                    placeholder="Enter a location"
                                                    value="{{ $user['address']['0']->receiver_address_line_2 }}" />
                                            @else
                                                <input type="text" name="receiver_address_line_2"
                                                    id="receiver_address_line_2" class="form-control"
                                                    placeholder="Enter a location" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your address line 2</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Suburb:</label>
                                            @if (isset($user['address']['0']->r_suburb))
                                                <input type="text" name="r_suburb" class="form-control"
                                                    placeholder="Enter your suburb"
                                                    value="{{ $user['address']['0']->r_suburb }}" />
                                            @else
                                                <input type="text" name="r_suburb" class="form-control"
                                                    placeholder="Enter your suburb" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Suburb</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Postal Code:</label>
                                            @if (isset($user['address']['0']->r_postal_code))
                                                <input type="text" name="r_postal_code" class="form-control"
                                                    placeholder="Enter your postal code"
                                                    value="{{ $user['address']['0']->r_postal_code }}" />
                                            @else
                                                <input type="text" name="r_postal_code" class="form-control"
                                                    placeholder="Enter your postal code" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Postal</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>State:</label>
                                            @if (isset($user['address']['0']->r_state))
                                                <input type="text" name="receiver_state" class="form-control"
                                                    placeholder="Enter your state"
                                                    value="{{ $user['address']['0']->receiver_state }}" />
                                            @else
                                                <input type="text" name="receiver_state" class="form-control"
                                                    placeholder="Enter your state" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your State</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Opening Time:</label>
                                            @if (isset($user['address']['0']->r_opening_time))
                                                <input type="time" name="r_opening_time" class="form-control"
                                                    placeholder="Enter your opening time"
                                                    value="{{ $user['address']['0']->r_opening_time }}" />
                                            @else
                                                <input type="time" name="r_opening_time" class="form-control"
                                                    placeholder="Enter your opening time" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your opening time</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="account_detail" class="tabcontent">
                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Account Details: </h3>
                                    <div class="form-group row was-validated">
                                        <div class="col-lg-6">
                                            <label><strong>Business name </strong><span
                                                    style="color: red;font-size: 22px;">* </span>:</label>
                                            @if (isset($user['account_detail']['0']->business_name))
                                                <input type="text" name="business_name" class="form-control"
                                                    placeholder="Enter a Business name"
                                                    value="{{ $user['account_detail']['0']->business_name }}" required />
                                            @else
                                                <input type="text" name="business_name" class="form-control"
                                                    placeholder="Enter a Business name" required />
                                            @endif

                                            <div class="invalid-feedback">Please enter your business name</div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <label>Trading name:</label>
                                            @if (isset($user['account_detail']['0']->trading_name))
                                                <input type="text" name="trading_name" class="form-control"
                                                    placeholder="Enter a trading name"
                                                    value="{{ $user['account_detail']['0']->trading_name }}" />
                                            @else
                                                <input type="text" name="trading_name" class="form-control"
                                                    placeholder="Enter a trading name" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Trading name</span>
                                        </div> --}}

                                        {{-- <div class="col-lg-2">
                                            <label>Account status:</label>
                                            <div>
                                                @if (isset($user['account_detail']['0']->account_status))
                                                    <select class="form-control select2" id="kt_select2_2"
                                                        name="account_status">
                                                        @if ($user['account_detail']['0']->account_status == 'active')
                                                            <option selected value="active">Active</option>
                                                            <option value="closed">Closed</option>
                                                            <option value="on_hold">On hold</option>
                                                        @elseif($user['account_detail']['0']->account_status == 'closed')
                                                            <option value="active">Active</option>
                                                            <option selected value="closed">Closed</option>
                                                            <option value="on_hold">On hold</option>
                                                        @else
                                                            <option value="active">Active</option>
                                                            <option value="closed">Closed</option>
                                                            <option selected value="on_hold">On hold</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    <select class="form-control select2" id="kt_select2_2"
                                                        name="account_status">
                                                        <option value="active">Active</option>
                                                        <option value="closed">Closed</option>
                                                        <option value="on_hold">On hold</option>
                                                    </select>
                                                @endif

                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4">
                                            <label>Credit limit:</label>
                                            @if (isset($user['account_detail']['0']->credit_limit))
                                                <input type="text" name="credit_limit" class="form-control"
                                                    placeholder="Enter your credit limit"
                                                    value="{{ $user['account_detail']['0']->credit_limit }}" />
                                            @else
                                                <input type="text" name="credit_limit" class="form-control"
                                                    placeholder="Enter your credit limit" />
                                            @endif
                                            <span class="form-text text-muted">Please enter your credit limit</span>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        {{-- <div class="col-lg-6">
                                            <label>Account Manager:</label>
                                            @if (isset($user['account_detail']['0']->account_manager))
                                                <input type="text" name="account_manager" class="form-control"
                                                    placeholder="Enter your Account manager"
                                                    value="{{ $user['account_detail']['0']->account_manager }}" />
                                            @else
                                                <input type="text" name="account_manager" class="form-control"
                                                    placeholder="Enter your Account manager" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Account manager</span>
                                        </div> --}}

                                    </div>
                                    <div class="form-group row was-validated">
                                        <div class="col-lg-6">
                                            <label><strong>Account Code </strong><span
                                                    style="color: red;font-size: 22px;">*</span> :</label>
                                            @if (isset($user['account_detail']['0']->account_code))
                                                <input type="text" name="account_code" class="form-control"
                                                    placeholder="Enter your Account Code"
                                                    value="{{ $user['account_detail']['0']->account_code }}" required />
                                            @else
                                                <input type="text" name="account_code" class="form-control"
                                                    placeholder="Enter your Account Code" required />
                                            @endif

                                            <div class="form-text text-muted">Please enter your Account code</div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>ACN:</label>
                                            @if (isset($user['account_detail']['0']->ACN))
                                                <input type="text" name="acn" class="form-control"
                                                    placeholder="Enter your ACN"
                                                    value="{{ $user['account_detail']['0']->ACN }}" />
                                            @else
                                                <input type="text" name="acn" class="form-control"
                                                    placeholder="Enter your ACN" />
                                            @endif

                                            <span class="form-text text-muted">Please enter ACN</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>ABN:</label>
                                            @if (isset($user['account_detail']['0']->ABN))
                                                <input type="text" name="abn" class="form-control"
                                                    placeholder="Enter ABN"
                                                    value="{{ $user['account_detail']['0']->ABN }}" />
                                            @else
                                                <input type="text" name="abn" class="form-control"
                                                    placeholder="Enter ABN" />
                                            @endif
                                            <span class="form-text text-muted">Please enter ABN</span>
                                        </div>
                                        {{-- <div class="col-lg-2">
                                            <label>Industry:</label>
                                            <div>
                                                @if (isset($user['account_detail']['0']->industry))
                                                    <select class="form-control select2" id="kt_select2_3" name="industry">
                                                        <option value="{{ $user['account_detail']['0']->industry }}">
                                                            {{ $user['account_detail']['0']->industry }}</option>
                                                        <option value="agriculture">Agriculture</option>
                                                        <option value="automotive">Automotive</option>
                                                        <option value="defense">Defence</option>
                                                        <option value="education">Education</option>
                                                        <option value="environment">Environment</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" id="kt_select2_3" name="industry">
                                                        <option value="agriculture">Agriculture</option>
                                                        <option value="automotive">Automotive</option>
                                                        <option value="defense">Defence</option>
                                                        <option value="education">Education</option>
                                                        <option value="environment">Environment</option>
                                                    </select>
                                                @endif

                                            </div>
                                        </div> --}}
                                        <div class="col-lg-2">
                                            <label>Payment terms:</label>
                                            <div>
                                                @if (isset($user['account_detail']['0']->payment_terms))
                                                    <select class="form-control select2" id="payment_terms"
                                                        name="payment_term">
                                                        <option
                                                            value="{{ $user['account_detail']['0']->payment_terms }}">
                                                            {{ $user['account_detail']['0']->payment_terms }}</option>
                                                        <option value="cod">COD</option>
                                                        <option value="net 7">Net 7</option>
                                                        <option value="net 30">Net 30</option>
                                                        <option value="net 21">Net 21</option>
                                                        <option value="net 60">Net 60</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" id="payment_terms"
                                                        name="payment_term">
                                                        <option value="cod">COD</option>
                                                        <option value="net 7">Net 7</option>
                                                        <option value="net 30">Net 30</option>
                                                        <option value="net 21">Net 21</option>
                                                        <option value="net 60">Net 60</option>
                                                    </select>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Review Date:</label>
                                            @if (isset($user['account_detail']['0']->review_date))
                                                <input type="date" name="Review_date" class="form-control"
                                                    placeholder="Enter your Review Date"
                                                    value="{{ $user['account_detail']['0']->review_date }}" />
                                            @else
                                                <input type="date" name="Review_date" class="form-control"
                                                    placeholder="Enter your Review Date" />
                                            @endif

                                            <span class="form-text text-muted">Please enter your Review Date</span>
                                        </div>
                                        {{-- <div class="col-lg-2">
                                            <label>Billing method:</label>
                                            <div>
                                                @if (isset($user['account_detail']['0']->billing_method))
                                                    <select class="form-control select2" id="billing_method"
                                                        name="billing_method">
                                                        <option
                                                            value="{{ $user['account_detail']['0']->billing_method }}">
                                                            {{ $user['account_detail']['0']->billing_method }}</option>
                                                        <option value="cheque">Cheque</option>
                                                        <option value="cod">COD</option>
                                                        <option value="credit_card">Credit Card</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" id="billing_method"
                                                        name="billing_method">
                                                        <option value="cheque">Cheque</option>
                                                        <option value="cod">COD</option>
                                                        <option value="credit_card">Credit Card</option>
                                                    </select>
                                                @endif

                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Do not generate invoices:</label>
                                            <div class="col-4">
                                                <span class="switch switch-outline switch-icon switch-success">
                                                    <label>
                                                        <input type="checkbox" name="cgen_invoice_chk" id="gen_invoice_chk"
                                                         {{ isset($user['account_detail']) && $user['account_detail']['0']->gen_invoice_chk=='Yes' ? 'checked' : '' }}
                                                        onclick="check_gen_invoice_chk()" >
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="gen_invoice_chk"  value="{{ isset($user['account_detail'])&&$user['account_detail']['0']->gen_invoice_chk}}">

                                        <div class="col-lg-2">
                                            <label>Xero Link:</label>
                                            <div class="col-4">
                                                <span class="switch switch-outline switch-icon switch-success">
                                                    <label>
                                                        <input type="checkbox" name="cxero_link_chk" id="xero_link_chk"
                                                         {{ isset($user['account_detail']) &&  $user['account_detail']['0']->xero_link_chk=='Yes' ? 'checked' : '' }}
                                                        onclick="check_xero_link_chk()" >
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="xero_link_chk"  value="{{isset($user['account_detail']) && $user['account_detail']['0']->xero_link_chk}}">

                                        <div class="col-lg-4">
                                            <label>Invoice Export</label>
                                            <div>
                                                <select class="form-control select2" id="kt_select_invoice_export" name="invoice_export">
                                                    @foreach ($invoice_exports as $invoice_export)
                                                        <option value="{{ $invoice_export }}" {{isset($user['account_detail']['0']->invoice_export)&&$user['account_detail']['0']->invoice_export==$invoice_export?'selected':''}}>{{ $invoice_export }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="notes" class="tabcontent">
                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Notes: </h3>
                                    <div id="note_container">
                                        @if (isset($user->notes[0]['id']))
                                            @foreach ($user->notes as $note)
                                                <div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label> note:</label>
                                                            <input type="text" id="note_area" class="form-control"
                                                                name="note[]" value="{{ $note['note'] }}">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>{{ $note['author'] }}</label>
                                                            <input type="hidden" name="author_name[]"
                                                                value="{{ $note['author'] }}">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>{{ $note['date'] }}</label>
                                                            <input type="hidden" name="date[]"
                                                                value="{{ date('Y/m/d') }}">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <a href="javascript:void(0)" class="remove-note"><span
                                                                    style="color: red">X</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group row">

                                                <div class="col-lg-6">
                                                    <label>Add new notes:</label>
                                                    <input type="text" id="note_area" class="form-control" name="note[]">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>{{ auth()->user()->name }}</label>
                                                    <input type="hidden" name="author_name[]"
                                                        value="{{ auth()->user()->name }}">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>{{ date('Y/m/d') }}</label>
                                                    <input type="hidden" name="date[]" value="{{ date('Y/m/d') }}">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>Remove</label>
                                                </div>

                                            </div>
                                        @endif

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <a href="javascript:void(0)" onclick="add_note()"
                                                class="btn btn-success btn-sm mr-3 float-left ">
                                                <i class="flaticon2-pie-chart"></i>Add new note</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="attachments" class="tabcontent">
                                <div class="card-body">
                                    <h3 class="text-dark font-weight-bold mb-10">Attachments: </h3>
                                    <div class="form-group row">
                                        @if (isset($user['attachments']['file']))
                                            <div class="col-lg-6">
                                                <label>Update file:</label>
                                                <input type="file" id="c_file" name="file" class="form-control" />
                                                <span class="form-text text-muted">Files must be less than 2 MB.</span>
                                                <span class="form-text text-muted">Allowed file types: txt pdf xls docx
                                                    jpeg jpg msg xlsx.</span>
                                            </div>
                                        @else
                                            <div class="col-lg-6">
                                                <label>Add a new file:</label>
                                                <input type="file" id="c_file" name="file" class="form-control" />
                                                <span class="form-text text-muted">Files must be less than 2 MB.</span>
                                                <span class="form-text text-muted">Allowed file types: txt pdf xlsdocx jpeg
                                                    jpg msg xlsx.</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </form>


                        <div id="sites" class="tabcontent">
                            @include('admin.customers.tables.site')
                        </div>

                        <div id="contact" class="tabcontent">
                            @include('admin.customers.tables.contact')
                        </div>

                        <div id="bookings" class="tabcontent">
                            @include('admin.customers.tables.booking')
                        </div>

                        <div id="invoices" class="tabcontent">
                            @include('admin.customers.tables.invoice')
                        </div>

                    </div>

                    <!--end::Form-->
                </div>
            </div>
            <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    </div>
@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/dataTables.editor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!--end::Page Vendors Styles-->
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.editor.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.buttons.min.js') }}"></script> --}}

    @include('admin.customers.tables.contact_script')

    @include('admin.customers.tables.site_script')

    @include('admin.customers.tables.booking_script')

    @include('admin.customers.tables.invoice_script')

    <script>


        function check_method() {
            var customer_active = $('input[name="active"]').is(":checked");

            if (customer_active == true) {
                $('input[name="c_active"]').val('1');
            } else if (customer_active == false) {
                $('input[name="c_active"]').val('0');
            }

        }

        function check_gen_invoice_chk() {
            var customer_gen_invoice_chk = $('input[name="cgen_invoice_chk"]').is(":checked");

            if (customer_gen_invoice_chk == true) {
                $('input[name="gen_invoice_chk"]').val('Yes');
            } else if (customer_gen_invoice_chk == false) {
                $('input[name="gen_invoice_chk"]').val('No');
            }

        }

        function check_xero_link_chk() {
            var customer_active = $('input[name="cxero_link_chk"]').is(":checked");

            if (customer_active == true) {
                $('input[name="xero_link_chk"]').val('Yes');
            } else if (customer_active == false) {
                $('input[name="xero_link_chk"]').val('No');
            }

        }

        function save_customer_form() {

            var contact_name = $('input[name="p_contact_name"]').val();
            var p_email = $('input[name="p_email"]').val();
            var p_address_line_1 = $('input[name="p_address_line_1"]').val();
            var p_postal_code = $('input[name="p_postal_code"]').val();
            var business_name = $('input[name="business_name"]').val();
            var account_code = $('input[name="account_code"]').val();
            var p_suburb = $('input[name="p_suburb"]').val();
            var p_state = $('input[name="p_state"]').val();
            if (contact_name == "" || p_email == "") {
                swal({
                    title: "Alert!",
                    text: "Primary name and Primary email is required",
                    icon: "warning",
                });

                $('.c_detail').addClass('active').removeClass('tablinks');
                openCity(event, 'contact');

            // } else if (p_address_line_1 == "" || p_postal_code == "" || p_suburb == "" || p_state == "") {
            //     swal({
            //         title: "Alert!",
            //         text: "address, suburb, state and Postal code is required",
            //         icon: "warning",
            //     });


            //     $('.p_address').addClass('active').removeClass('tablinks');
            //     openCity(event, 'address');

            } else if (!siteTable.data().count()) {
                swal({
                    title: "Alert!",
                    text: "Customer's site is required!",
                    icon: "warning",
                });


                // $('.t_sites').addClass('active').removeClass('tablinks');
                openCity(event, 'sites');

            } else if (business_name == "" || account_code == "") {
                swal({
                    title: "Alert!",
                    text: "Business and Account code is required",
                    icon: "warning",
                });

                $('.p_address').addClass('tablinks').removeClass('active');
                $('.p_account_detail').addClass('active').removeClass('tablinks');
                openCity(event, 'account_detail');

            } else {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");


                if (customer_name) {
                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);

                    // document.getElementById('customer_form').submit();

                    var formData = $("#customer_form").serialize();
                    formData +="&"+ $("#client_update_form").serialize();

                    var siteData =[];
                    siteTable.rows().data().map((row) => {
                        siteData.push(row);
                    });
                    formData += "&siteData="+JSON.stringify(siteData);

                    //----contact
                    var contactData =[];
                    contactTable.rows().data().map((row) => {
                        contactData.push(row);
                    });
                    formData += "&contactData="+JSON.stringify(contactData);

                    //----invoice
                    var invoiceData =[];
                    invoiceTable.rows().data().map((row) => {
                        invoiceData.push(row);
                    });
                    formData += "&invoiceData="+JSON.stringify(invoiceData);

                    //----booking
                    var bookingData =[];
                    bookingTable.rows().data().map((row) => {
                        bookingData.push(row);
                    });
                    formData += "&bookingData="+JSON.stringify(bookingData);

                    console.log("formdata",formData);

                    $.post($("#customer_form").attr('action'), formData, function(data) {
                        $.toast({
                            heading: 'Save customer',
                            text: data.message,
                            hideAfter: 3000,
                            position: 'top-right',
                            icon: data.status ? 'success' : 'warning'
                        })
                        // $('#freight').DataTable().ajax.reload();
                    });
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name required",
                        icon: "warning",
                    });
                }
            }

        }

        function contact_form_action() {

            var contact_name = $('input[name="p_contact_name"]').val();
            if (contact_name == "") {
                swal({
                    title: "Alert!",
                    text: "Primary name is required",
                    icon: "warning",
                });
            } else {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");


                if (customer_name) {
                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);


                    document.getElementById('contact_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name required",
                        icon: "warning",
                    });
                }
            }
        }

        function address_form_action() {
            var p_address_line_1 = $('input[name="p_address_line_1"]').val();
            var p_postal_code = $('input[name="p_postal_code"]').val();
            if (p_address_line_1 && p_postal_code) {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");

                if (customer_name) {
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);
                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    document.getElementById('address_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name is required",
                        icon: "warning",
                    });
                }

            } else {
                swal({
                    title: "Alert!",
                    text: "Primary address line 1 and primary postal code is required",
                    icon: "warning",
                });
            }
        }

        function account_detail_form_action() {
            var business_name = $('input[name="business_name"]').val();
            if (business_name) {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");

                if (customer_name) {
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);

                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    document.getElementById('account_detail_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name is required",
                        icon: "warning",
                    });
                }

            } else {
                swal({
                    title: "Alert!",
                    text: "Business name is required",
                    icon: "warning",
                });
            }
        }

        function note_form_action() {
            var note = $('#note_area').val();
            if (note) {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");

                if (customer_name) {
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);
                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    document.getElementById('note_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name is required",
                        icon: "warning",
                    });
                }

            } else {
                swal({
                    title: "Alert!",
                    text: "Note is required",
                    icon: "warning",
                });
            }
        }

        function attachment_form_action() {
            var file = $('#c_file').val();
            if (file) {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");

                if (customer_name) {
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);

                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    document.getElementById('attachement_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name is required",
                        icon: "warning",
                    });
                }

            } else {
                swal({
                    title: "Alert!",
                    text: "File is required",
                    icon: "warning",
                });
            }
        }

        function site_form_action() {
            var err;
            var site_name = $('input[name="site_name[]"]').map(function() {
                if ($(this).val() == "") {
                    err = 'empty'
                } else {
                    return $(this).val();
                }

            }).get();
            var address_line_1 = $('input[name="address_line_1[]"]').map(function() {
                if ($(this).val() == "") {
                    err = 'empty'
                } else {
                    return $(this).val();
                }

            }).get();


            if (err) {
                swal({
                    title: "Alert!",
                    text: "Site name and address line 1 is required",
                    icon: "warning",
                });
            } else {
                var customer_name = $('input[name="name"]').val();
                var customer_plan = $('#kt_select2_1').val();
                var customer_active = $('input[name="active"]').is(":checked");

                if (customer_name) {
                    $('input[name="c_name"]').val(customer_name);
                    $('input[name="c_plan"]').val(customer_plan);
                    if (customer_active == true) {
                        $('input[name="c_active"]').val('1');
                    } else if (customer_active == false) {
                        $('input[name="c_active"]').val('0');
                    }
                    document.getElementById('site_form').submit();
                } else {
                    swal({
                        title: "Alert!",
                        text: "Customer name is required",
                        icon: "warning",
                    });
                }
            }
        }

        function add_note() {
            var note_row = '                   <div class="form-group row"><div class="col-lg-6">\n' +
                '                                      <input type="text" class="form-control" name="note[]">\n' +
                '                                  </div>\n' +
                '                                  <div class="col-lg-2">\n' +
                '                                      <label>{{ auth()->user()->name }}</label>\n' +
                '                                       <input type="hidden" name="author_name[]" value="{{ auth()->user()->name }}">\n' +
                '                                  </div>\n' +
                '                                  <div class="col-lg-2">\n' +
                '                                      <label>{{ date('Y/m/d') }}</label>\n' +
                '                                      <input type="hidden" name="date[]" value="{{ date('Y/m/d') }}">\n' +
                '                                  </div>\n' +
                '                                  <div class="col-lg-2">\n' +
                '                                      <div>\n' +
                '                                          <a href="javascript:void(0)" class="remove-note"><span style="color: red">X</span></a>\n' +
                '                                      </div>\n' +
                '                              </div></div>';
            $('#note_container').append(note_row);
        }

        function add_site() {

            var site_row = '<div><hr><hr><h3 class="text-dark font-weight-bold mb-10">Site: </h3>\n' +
                '                                  <div class="form-group row">\n' +
                '                                      <div class="col-lg-6">\n' +
                '                                          <label>Site Name(Required):</label>\n' +
                '                                          <input type="text" name="site_name[]" class="form-control" placeholder="Enter a Site name"/>\n' +
                '                                          <span class="form-text text-muted">Please enter your site name</span>\n' +
                '                                      </div>\n' +
                '                                      <div class="col-lg-6">\n' +
                '                                          <label>Address line 1(Required):</label>\n' +
                '                                          <input type="text" name="address_line_1[]" class="form-control" placeholder="Enter a location"/>\n' +
                '                                          <span class="form-text text-muted">Please enter your address line one</span>\n' +
                '                                      </div>\n' +
                '                                  </div>\n' +
                '\n' +
                '                                  <div class="form-group row">\n' +
                '                                      <div class="col-lg-6">\n' +
                '                                          <label>Address line 2:</label>\n' +
                '                                          <input type="text" name="address_line_2[]" class="form-control" placeholder="Enter a location"/>\n' +
                '                                          <span class="form-text text-muted">Please enter your address line two</span>\n' +
                '                                      </div>\n' +
                '                                      <div class="col-lg-6">\n' +
                '                                          <label>Suburb:</label>\n' +
                '                                          <input type="text" name="suburb[]" class="form-control" placeholder="Enter your suburb"/>\n' +
                '                                          <span class="form-text text-muted">Please enter suburb</span>\n' +
                '                                      </div>\n' +
                '                                  </div>\n' +
                '\n' +
                '                                  <div class="form-group row">\n' +
                '                                      <div class="col-lg-6">\n' +
                '                                          <label>Postal code:</label>\n' +
                '                                          <input type="text" name="postal_code[]" class="form-control" placeholder="Enter a postal code"/>\n' +
                '                                          <span class="form-text text-muted">Please enter your postal code</span>\n' +
                '                                      </div>\n' +
                '                                      <div class="col-lg-3">\n' +
                '                                          <label>State:</label>\n' +
                '                                          <input type="text" name="state[]" class="form-control" placeholder="Enter your state"/>\n' +
                '                                          <span class="form-text text-muted">Please enter state</span>\n' +
                '                                      </div>\n' +
                '                                      <div class="col-lg-3">\n' +
                '                                          <label>Opening time:</label>\n' +
                '                                          <input type="time" name="opening_time[]" class="form-control" placeholder="Enter your opening time"/>\n' +
                '                                          <span class="form-text text-muted">Please enter opening time</span>\n' +
                '                                      </div>\n' +
                '                                  </div>\n' +
                '                                  <div class="col-lg-2">\n' +
                '                                      <div>\n' +
                '                                          <a href="javascript:void(0)" class="remove-site"><span style="color: red">Remove</span></a>\n' +
                '                                      </div>\n' +
                '                              </div></div>';

            $('#site_container').append(site_row);

        }



        $("body").on("click", ".remove-site", function() {
            $(this).parent().parent().parent().remove();
        });
        $("body").on("click", ".remove-site-update", function() {
            $(this).parent().parent().parent().parent().remove();
        });

        $("body").on("click", ".remove-note", function() {
            $(this).parent().parent().parent().remove();
        });

        var avatar1 = new KTImageInput('kt_image_1');

        $(document).ready(function() {
            $('.c_detail').addClass('active').removeClass('tablinks');
            openCity(event, 'contact');
        });


        function openCity(evt, cityName) {
            if (cityName != 'contact') {
                $('.c_detail').addClass('tablinks').removeClass('active');
            }

            if (cityName != 'address') {
                $('.p_address').addClass('tablinks').removeClass('active');
            }
            if (cityName != 'account_detail') {
                $('.p_account_detail').addClass('tablinks').removeClass('active');
            }


            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            // evt.currentTarget.className += " active";

        }

        var user_plan = "{{isset($user)?$user['plan']:''}}";

        // Class definition
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                $('#kt_select9_1').select2({
                    placeholder: "Select a option"
                });
                $('#kt_select_invoice_export').select2({
                    placeholder: "Select a option"
                });

                $('#kt_select9_2').select2({
                    placeholder: "Select a option"
                });
                // basic
                // $('#kt_select2_1').select2({
                //     placeholder: "Select a state"
                // });

                $( "#kt_select2_1").click(function() {
                    var CSRF_TOKEN = '{{ csrf_token() }}';
                    $.get("{{ route('get-all-pricings') }}", {_token: CSRF_TOKEN}, function(data) {
                        console.log("res",data);
                        $("#kt_select2_1").html("");
                        data.map(e=>{
                            $("#kt_select2_1").append("<option value='"+e.id+"' "+ (user_plan==e.id?'selected':'') +" >"+e.title+"</option>");
                        });
                    });
                });

                $("#kt_select2_1").change(function() {
                    user_plan = $(this).val();
                });

                // nested
                $('#kt_select2_2').select2({
                    placeholder: "Select a state"
                });

                // multi select
                $('#kt_select2_3').select2({
                    placeholder: "Select a state",
                });
                $('#payment_terms').select2({
                    placeholder: "Select a state",
                });

                $('#billing_method').select2({
                    placeholder: "Select method",
                });

                // basic
                $('#kt_select2_4').select2({
                    placeholder: "Select a state",
                    allowClear: true
                });

                // loading data from array
                var data = [{
                    id: 0,
                    text: 'Enhancement'
                }, {
                    id: 1,
                    text: 'Bug'
                }, {
                    id: 2,
                    text: 'Duplicate'
                }, {
                    id: 3,
                    text: 'Invalid'
                }, {
                    id: 4,
                    text: 'Wontfix'
                }];

                $('#kt_select2_5').select2({
                    placeholder: "Select a value",
                    data: data
                });

                // loading remote data

                function formatRepo(repo) {
                    if (repo.loading) return repo.text;
                    var markup = "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                        "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
                    if (repo.description) {
                        markup += "<div class='select2-result-repository__description'>" + repo.description +
                            "</div>";
                    }
                    markup += "<div class='select2-result-repository__statistics'>" +
                        "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo
                        .forks_count + " Forks</div>" +
                        "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo
                        .stargazers_count + " Stars</div>" +
                        "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo
                        .watchers_count + " Watchers</div>" +
                        "</div>" +
                        "</div></div>";
                    return markup;
                }

                function formatRepoSelection(repo) {
                    return repo.full_name || repo.text;
                }

                $("#kt_select2_6").select2({
                    placeholder: "Search for git repositories",
                    allowClear: true,
                    ajax: {
                        url: "https://api.github.com/search/repositories",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;

                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    minimumInputLength: 1,
                    templateResult: formatRepo, // omitted for brevity, see the source of this page
                    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });

                // custom styles

                // tagging support
                $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
                    placeholder: "Select an option",
                });

                // disabled mode
                $('#kt_select2_7').select2({
                    placeholder: "Select an option"
                });

                // disabled results
                $('#kt_select2_8').select2({
                    placeholder: "Select an option"
                });

                // limiting the number of selections
                $('#kt_select2_9').select2({
                    placeholder: "Select an option",
                    maximumSelectionLength: 2
                });

                // hiding the search box
                $('#kt_select2_10').select2({
                    placeholder: "Select an option",
                    minimumResultsForSearch: Infinity
                });

                // tagging support
                $('#kt_select2_11').select2({
                    placeholder: "Add a tag",
                    tags: true
                });

                // disabled results
                $('.kt-select2-general').select2({
                    placeholder: "Select an option"
                });
            }

            var modalDemos = function() {
                $('#kt_select2_modal').on('shown.bs.modal', function() {
                    // basic
                    $('#kt_select2_1_modal').select2({
                        placeholder: "Select a state"
                    });

                    // nested
                    $('#kt_select2_2_modal').select2({
                        placeholder: "Select a state"
                    });

                    // multi select
                    $('#kt_select2_3_modal').select2({
                        placeholder: "Select a state",
                    });

                    // basic
                    $('#kt_select2_4_modal').select2({
                        placeholder: "Select a state",
                        allowClear: true
                    });
                });
            }

            // Public functions
            return {
                init: function() {
                    demos();
                    modalDemos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSelect2.init();

        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLR_rl5ubFeXO416DX1CVq3avkGpTj3Qs&libraries=places">
    </script>
    <script>
        var autocomplete, autocomplete2, autocomplete3, autocomplete4, autocomplete5, autocomplete6;
        google.maps.event.addDomListener(window, 'load', initAutocomplete);

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete.getPlace();
            let address1 = "";
            let postcode = "";
            console.log("Plavce", place);

            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }
                    case "locality":
                        // document.querySelector("#locality").value = component.long_name;
                        $('input[name="p_suburb"]').val(component.long_name);
                        break;
                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.short_name;
                        $('input[name="p_state"]').val(component.short_name);
                        break;
                    }
                    case "country":
                        // document.querySelector("#country").value = component.long_name;
                        break;
                }
            }
            // $('input[name="p_address_line_2"]').val(address1);
            $('input[name="p_postal_code"]').val(postcode);
        }

        function fillInAddress2() {
            // Get the place details from the autocomplete object.
            const place = autocomplete3.getPlace();
            let address1 = "";
            let postcode = "";
            console.log("Plavce", place);

            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }
                    case "locality":
                        // document.querySelector("#locality").value = component.long_name;
                        $('input[name="b_suburb"]').val(component.long_name);
                        break;
                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.short_name;
                        $('input[name="b_state"]').val(component.short_name);
                        break;
                    }
                    case "country":
                        // document.querySelector("#country").value = component.long_name;
                        break;
                }
            }
            // $('input[name="b_address_line_2"]').val(address1);
            $('input[name="b_postal_code"]').val(postcode);
        }

        function fillInAddress3() {
            // Get the place details from the autocomplete object.
            const place = autocomplete5.getPlace();
            let address1 = "";
            let postcode = "";
            console.log("Plavce", place);

            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }
                    case "locality":
                        // document.querySelector("#locality").value = component.long_name;
                        $('input[name="r_suburb"]').val(component.long_name);
                        break;
                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.short_name;
                        $('input[name="receiver_state"]').val(component.short_name);
                        break;
                    }
                    case "country":
                        // document.querySelector("#country").value = component.long_name;
                        break;
                }
            }
            // $('input[name="r_address_line_2"]').val(address1);
            $('input[name="r_postal_code"]').val(postcode);
        }

        function initAutocomplete() {
            var options = {
                componentRestrictions: {
                    country: 'au'
                },
                fields: ["address_components", "geometry"],
                types: ["address"],
            };

            var input = document.getElementById('p_address_line_1');
            autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener("place_changed", fillInAddress);

            var input2 = document.getElementById('p_address_line_2');
            autocomplete2 = new google.maps.places.Autocomplete(input2, options);

            var input3 = document.getElementById('b_address_line_1');
            autocomplete3 = new google.maps.places.Autocomplete(input3, options);
            autocomplete3.addListener("place_changed", fillInAddress2);

            var input4 = document.getElementById('b_address_line_2');
            autocomplete4 = new google.maps.places.Autocomplete(input4, options);

            var input5 = document.getElementById('receiver_address_line_1');
            autocomplete5 = new google.maps.places.Autocomplete(input5, options);
            autocomplete5.addListener("place_changed", fillInAddress3);

            var input6 = document.getElementById('receiver_address_line_2');
            autocomplete6 = new google.maps.places.Autocomplete(input6, options);



        }
    </script>

@endsection
@section('style')
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #edeaf4;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 15px;
            font-family: "Nunito", sans-serif;

        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

    </style>
@endsection
