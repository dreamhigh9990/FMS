<h3 class="text-dark font-weight-bold m-10">Invoices: </h3>

{{-- <a href="#" onclick="event.preventDefault(); " id="add_invoice_btn" class="btn btn-primary font-weight-bolder m-2">
    <i class="ki ki-plus icon-sm"></i>Add Invoice
</a>
<a href="#" onclick="event.preventDefault();" id="del_invoice_btn" class="btn btn-light-danger font-weight-bold m-2">
    <i class="ki ki-close icon-sm"></i>Delete
</a> --}}

<!-- Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog was-validated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Update Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="updateInvoiceForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" />

                    <div class="form-group row">
                        <label class="col-form-label col-4">Invoice#</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="invoice_no" name="invoice_no" required />
                            <div class="invalid-feedback">Please input the Status</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Consignment</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="consignment" name="consignment" required />
                            <div class="invalid-feedback">Please input the consignment</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Sender</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="sender" name="sender" required />
                            <div class="invalid-feedback">Please input the sender</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Receiver</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="receiver" name="receiver" required />
                            <div class="invalid-feedback">Please input the receiver</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Delivery Date</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="delivery_date" name="delivery_date" required />
                            <div class="invalid-feedback">Please input the delivery date</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Amount</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="amount" name="amount" required />
                            <div class="invalid-feedback">Please input the amount</div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_invoice_btn">Update</button>
            </div>
        </div>
    </div>

</div>

<table id="invoice-table" class="display table table-bordered table-hover table-checkable" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" name="select_all" value="1" id="invoice-select-all">
            </th>
            <th>Invoice#^v</th>
            <th>Creation Date</th>
            <th>Consignment</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Delivery Date</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<div>

    {{--<div class="card-body">
            <h3 class="text-dark font-weight-bold mb-10">Primary Invoice: </h3>
            <div class="form-group row was-validated">
                <div class="col-lg-6">
                    <label><strong>Primary invoice Name </strong><span
                            style="color: red;font-size: 22px;">*</span>:</label>
                    @if (isset($user['primary_invoice']->invoice_name))
                        <input type="hidden" name="p_id"
                            value="{{ $user['primary_invoice']->id }}" required />
                        <input type="text" name="p_invoice_name" class="form-control"
                            placeholder="Enter Invoice name"
                            value="{{ $user['primary_invoice']->invoice_name }}" required />
                    @else
                        <input type="text" name="p_invoice_name" class="form-control"
                            placeholder="Enter Invoice name" required />
                    @endif

                    <div class="invalid-feedback" id="p_span">Please enter your invoice
                        name</div>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['primary_invoice']->position))
                        <input type="text" name="p_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['primary_invoice']->position }}" />
                    @else
                        <input type="text" name="p_position" class="form-control"
                            placeholder="Enter Position" />
                    @endif

                    <span class="form-text text-muted">Please enter your position</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Mobile:</label>
                    <div class="input-group">
                        @if (isset($user['primary_invoice']->mobile))
                            <input type="text" name="p_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['primary_invoice']->mobile }}" />
                        @else
                            <input type="text" name="p_mobile" class="form-control"
                                placeholder="Enter your mobile" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-mobile"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your Phone number</span>
                </div>
                <div class="col-lg-6">
                    <label>Office Phone:</label>
                    <div class="input-group">
                        @if (isset($user['primary_invoice']->office_phone))
                            <input type="text" name="p_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['primary_invoice']->office_phone }}" />
                        @else
                            <input type="text" name="p_office_phone" class="form-control"
                                placeholder="Enter your office phone number" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-phone-square"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your office phone</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Fax:</label>
                    <div class="input-group">
                        @if (isset($user['primary_invoice']->fax))
                            <input type="text" name="p_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['primary_invoice']->fax }}" />
                        @else
                            <input type="text" name="p_fax" class="form-control"
                                placeholder="Enter your Fax" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-fax"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your fax</span>
                </div>
                <div class="col-lg-6 was-validated">
                    <label><strong> Email </strong><span
                            style="color: red;font-size: 22px;">*</span>:</label>
                    <div class="input-group">
                        @if (isset($user['primary_invoice']->email))
                            <input type="email" name="p_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['primary_invoice']->email }}" required />
                        @else
                            <input type="email" name="p_email" class="form-control"
                                placeholder="Enter your office Email" required />
                        @endif

                        <div class="invalid-feedback">Please enter your email on validate </div>
                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-envelope-o"></i></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-dark font-weight-bold mb-10">Secondary Invoice: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Invoice Name:</label>
                    @if (isset($user['secondary_invoice']->invoice_name))
                        <input type="hidden" name="s_id"
                            value="{{ $user['secondary_invoice']->id }}">
                        <input type="text" name="sender_invoice_name" class="form-control"
                            placeholder="Enter Invoice name"
                            value="{{ $user['secondary_invoice']->invoice_name }}" />
                    @else
                        <input type="text" name="sender_invoice_name" class="form-control"
                            placeholder="Enter Invoice name" />
                    @endif

                    <span class="form-text text-muted">Please enter your invoice name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['secondary_invoice']->position))
                        <input type="text" name="s_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['secondary_invoice']->position }}" />
                    @else
                        <input type="text" name="s_position" class="form-control"
                            placeholder="Enter Position" />
                    @endif

                    <span class="form-text text-muted">Please enter your position</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Mobile:</label>
                    <div class="input-group">
                        @if (isset($user['secondary_invoice']->mobile))
                            <input type="text" name="s_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['secondary_invoice']->mobile }}" />
                        @else
                            <input type="text" name="s_mobile" class="form-control"
                                placeholder="Enter your mobile" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-mobile"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your Phone number</span>
                </div>
                <div class="col-lg-6">
                    <label>Office Phone:</label>
                    <div class="input-group">
                        @if (isset($user['secondary_invoice']->office_phone))
                            <input type="text" name="s_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['secondary_invoice']->office_phone }}" />
                        @else
                            <input type="text" name="s_office_phone" class="form-control"
                                placeholder="Enter your office phone number" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-phone-square"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your office phone</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Fax:</label>
                    <div class="input-group">
                        @if (isset($user['secondary_invoice']->fax))
                            <input type="text" name="s_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['secondary_invoice']->fax }}" />
                        @else
                            <input type="text" name="s_fax" class="form-control"
                                placeholder="Enter your Fax" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-fax"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your fax</span>
                </div>
                <div class="col-lg-6">
                    <label>email:</label>
                    <div class="input-group">
                        @if (isset($user['secondary_invoice']->email))
                            <input type="email" name="s_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['secondary_invoice']->email }}" />
                        @else
                            <input type="email" name="s_email" class="form-control"
                                placeholder="Enter your office Email" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-envelope-o"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your email</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-dark font-weight-bold mb-10">Other Invoice: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Invoice Name:</label>
                    @if (isset($user['other_invoice']->invoice_name))
                        <input type="hidden" name="o_id"
                            value="{{ $user['other_invoice']->id }}">
                        <input type="text" name="o_invoice_name" class="form-control"
                            placeholder="Enter Invoice name"
                            value="{{ $user['other_invoice']->invoice_name }}" />
                    @else
                        <input type="text" name="o_invoice_name" class="form-control"
                            placeholder="Enter Invoice name" />
                    @endif

                    <span class="form-text text-muted">Please enter your invoice name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['other_invoice']->position))
                        <input type="text" name="o_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['other_invoice']->position }}" />
                    @else
                        <input type="text" name="o_position" class="form-control"
                            placeholder="Enter Position" />
                    @endif

                    <span class="form-text text-muted">Please enter your position</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Mobile:</label>
                    <div class="input-group">
                        @if (isset($user['other_invoice']->mobile))
                            <input type="text" name="o_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['other_invoice']->mobile }}" />
                        @else
                            <input type="text" name="o_mobile" class="form-control"
                                placeholder="Enter your mobile" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-mobile"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your Phone number</span>
                </div>
                <div class="col-lg-6">
                    <label>Office Phone:</label>
                    <div class="input-group">
                        @if (isset($user['other_invoice']->office_phone))
                            <input type="text" name="o_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['other_invoice']->office_phone }}" />
                        @else
                            <input type="text" name="o_office_phone" class="form-control"
                                placeholder="Enter your office phone number">
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-phone-square"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your office phone</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Fax:</label>
                    <div class="input-group">
                        @if (isset($user['other_invoice']->fax))
                            <input type="text" name="o_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['other_invoice']->fax }}" />
                        @else
                            <input type="text" name="o_fax" class="form-control"
                                placeholder="Enter your Fax" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-fax"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your fax</span>
                </div>
                <div class="col-lg-6">
                    <label>email:</label>
                    <div class="input-group">
                        @if (isset($user['other_invoice']->email))
                            <input type="email" name="o_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['other_invoice']->email }}" />
                        @else
                            <input type="email" name="o_email" class="form-control"
                                placeholder="Enter your office Email" />
                        @endif

                        <div class="input-group-append"><span class="input-group-text"><i
                                    class="la la-envelope-o"></i></span></div>
                    </div>
                    <span class="form-text text-muted">Please enter your email</span>
                </div>
            </div>
        </div>--}}

    </div>

