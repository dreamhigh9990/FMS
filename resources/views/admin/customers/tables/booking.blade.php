
{{-- <a href="#" onclick="event.preventDefault(); " id="add_booking_btn" class="btn btn-primary font-weight-bolder m-2">
    <i class="ki ki-plus icon-sm"></i>Add Booking
</a>
<a href="#" onclick="event.preventDefault();" id="del_booking_btn" class="btn btn-light-danger font-weight-bold m-2">
    <i class="ki ki-close icon-sm"></i>Delete
</a> --}}
<h3 class="text-dark font-weight-bold m-10">Bookings: </h3>
<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog was-validated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Update Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="updateBookingForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" />

                    <div class="form-group row">
                        <label class="col-form-label col-4">Status ^v</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="statusv" name="statusv" required />
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
                        <label class="col-form-label col-4">Item QTY</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="item_qty" name="item_qty" required />
                            <div class="invalid-feedback">Please input the item_qty</div>
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
                <button type="button" class="btn btn-primary update_booking_btn">Update</button>
            </div>
        </div>
    </div>

</div>

<table id="booking-table" class="display table table-bordered table-hover table-checkable" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" name="select_all" value="1" id="booking-select-all">
            </th>
            <th>Status ^v</th>
            <th>Creation Date</th>
            <th>Consignment</th>
            <th>Item QTY</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Delivery Date</th>
            <th>Amount</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>
</table>

<div>

    {{--<div class="card-body">
            <h3 class="text-dark font-weight-bold mb-10">Primary Booking: </h3>
            <div class="form-group row was-validated">
                <div class="col-lg-6">
                    <label><strong>Primary booking Name </strong><span
                            style="color: red;font-size: 22px;">*</span>:</label>
                    @if (isset($user['primary_booking']->booking_name))
                        <input type="hidden" name="p_id"
                            value="{{ $user['primary_booking']->id }}" required />
                        <input type="text" name="p_booking_name" class="form-control"
                            placeholder="Enter Booking name"
                            value="{{ $user['primary_booking']->booking_name }}" required />
                    @else
                        <input type="text" name="p_booking_name" class="form-control"
                            placeholder="Enter Booking name" required />
                    @endif

                    <div class="invalid-feedback" id="p_span">Please enter your booking
                        name</div>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['primary_booking']->position))
                        <input type="text" name="p_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['primary_booking']->position }}" />
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
                        @if (isset($user['primary_booking']->mobile))
                            <input type="text" name="p_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['primary_booking']->mobile }}" />
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
                        @if (isset($user['primary_booking']->office_phone))
                            <input type="text" name="p_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['primary_booking']->office_phone }}" />
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
                        @if (isset($user['primary_booking']->fax))
                            <input type="text" name="p_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['primary_booking']->fax }}" />
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
                        @if (isset($user['primary_booking']->email))
                            <input type="email" name="p_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['primary_booking']->email }}" required />
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
            <h3 class="text-dark font-weight-bold mb-10">Secondary Booking: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Booking Name:</label>
                    @if (isset($user['secondary_booking']->booking_name))
                        <input type="hidden" name="s_id"
                            value="{{ $user['secondary_booking']->id }}">
                        <input type="text" name="sender_booking_name" class="form-control"
                            placeholder="Enter Booking name"
                            value="{{ $user['secondary_booking']->booking_name }}" />
                    @else
                        <input type="text" name="sender_booking_name" class="form-control"
                            placeholder="Enter Booking name" />
                    @endif

                    <span class="form-text text-muted">Please enter your booking name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['secondary_booking']->position))
                        <input type="text" name="s_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['secondary_booking']->position }}" />
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
                        @if (isset($user['secondary_booking']->mobile))
                            <input type="text" name="s_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['secondary_booking']->mobile }}" />
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
                        @if (isset($user['secondary_booking']->office_phone))
                            <input type="text" name="s_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['secondary_booking']->office_phone }}" />
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
                        @if (isset($user['secondary_booking']->fax))
                            <input type="text" name="s_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['secondary_booking']->fax }}" />
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
                        @if (isset($user['secondary_booking']->email))
                            <input type="email" name="s_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['secondary_booking']->email }}" />
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
            <h3 class="text-dark font-weight-bold mb-10">Other Booking: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Booking Name:</label>
                    @if (isset($user['other_booking']->booking_name))
                        <input type="hidden" name="o_id"
                            value="{{ $user['other_booking']->id }}">
                        <input type="text" name="o_booking_name" class="form-control"
                            placeholder="Enter Booking name"
                            value="{{ $user['other_booking']->booking_name }}" />
                    @else
                        <input type="text" name="o_booking_name" class="form-control"
                            placeholder="Enter Booking name" />
                    @endif

                    <span class="form-text text-muted">Please enter your booking name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['other_booking']->position))
                        <input type="text" name="o_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['other_booking']->position }}" />
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
                        @if (isset($user['other_booking']->mobile))
                            <input type="text" name="o_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['other_booking']->mobile }}" />
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
                        @if (isset($user['other_booking']->office_phone))
                            <input type="text" name="o_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['other_booking']->office_phone }}" />
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
                        @if (isset($user['other_booking']->fax))
                            <input type="text" name="o_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['other_booking']->fax }}" />
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
                        @if (isset($user['other_booking']->email))
                            <input type="email" name="o_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['other_booking']->email }}" />
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

