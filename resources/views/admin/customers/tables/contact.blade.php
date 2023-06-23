<h3 class="text-dark font-weight-bold m-10">Contact Details: </h3>

<a href="#" onclick="event.preventDefault(); " id="add_contact_btn" class="btn btn-primary font-weight-bolder m-2">
    <i class="ki ki-plus icon-sm"></i>Add Contact
</a>
<a href="#" onclick="event.preventDefault();" id="del_contact_btn" class="btn btn-light-danger font-weight-bold m-2">
    <i class="ki ki-close icon-sm"></i>Delete
</a>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog was-validated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Update Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="updateContactForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" />
                    <div class="form-group row">
                        <label class="col-form-label col-4">Contact Name</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="contact_name" name="contact_name" required />
                            <div class="invalid-feedback">Please input the contact name</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Position</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="position" name="position" required />
                            <div class="invalid-feedback">Please input the position</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Mobile</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" required />
                            <div class="invalid-feedback">Please input the mobile phone number</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Office</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="office_phone" name="office_phone" required />
                            <div class="invalid-feedback">Please input the office phone number</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Email</label>
                        <div class="col-8">
                            <input type="email" class="form-control" id="email" name="email" required />
                            <div class="invalid-feedback">Please input the email</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Alerts</label>
                        <div class="col-8">
                            {{-- <input type="text" class="form-control" id="alerts" name="alerts" /> --}}
                            <select class="form-control" id="alerts" name="alerts">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_contact_btn">Update</button>
            </div>
        </div>
    </div>

</div>

<table id="contact-table" class="display table table-bordered table-hover table-checkable" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" name="select_all" value="1" id="contact-select-all">
            </th>
            <th>Name</th>
            <th>Position</th>
            <th>Mobile</th>
            <th>Office</th>
            <th>Email</th>
            <th>Alerts</th>
            <th>Action</th>
        </tr>
    </thead>
</table>


<div>

    {{--<div class="card-body">
            <h3 class="text-dark font-weight-bold mb-10">Primary Contact: </h3>
            <div class="form-group row was-validated">
                <div class="col-lg-6">
                    <label><strong>Primary contact Name </strong><span
                            style="color: red;font-size: 22px;">*</span>:</label>
                    @if (isset($user['primary_contact']->contact_name))
                        <input type="hidden" name="p_id"
                            value="{{ $user['primary_contact']->id }}" required />
                        <input type="text" name="p_contact_name" class="form-control"
                            placeholder="Enter Contact name"
                            value="{{ $user['primary_contact']->contact_name }}" required />
                    @else
                        <input type="text" name="p_contact_name" class="form-control"
                            placeholder="Enter Contact name" required />
                    @endif

                    <div class="invalid-feedback" id="p_span">Please enter your contact
                        name</div>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['primary_contact']->position))
                        <input type="text" name="p_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['primary_contact']->position }}" />
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
                        @if (isset($user['primary_contact']->mobile))
                            <input type="text" name="p_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['primary_contact']->mobile }}" />
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
                        @if (isset($user['primary_contact']->office_phone))
                            <input type="text" name="p_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['primary_contact']->office_phone }}" />
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
                        @if (isset($user['primary_contact']->fax))
                            <input type="text" name="p_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['primary_contact']->fax }}" />
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
                        @if (isset($user['primary_contact']->email))
                            <input type="email" name="p_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['primary_contact']->email }}" required />
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
            <h3 class="text-dark font-weight-bold mb-10">Secondary Contact: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Contact Name:</label>
                    @if (isset($user['secondary_contact']->contact_name))
                        <input type="hidden" name="s_id"
                            value="{{ $user['secondary_contact']->id }}">
                        <input type="text" name="sender_contact_name" class="form-control"
                            placeholder="Enter Contact name"
                            value="{{ $user['secondary_contact']->contact_name }}" />
                    @else
                        <input type="text" name="sender_contact_name" class="form-control"
                            placeholder="Enter Contact name" />
                    @endif

                    <span class="form-text text-muted">Please enter your contact name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['secondary_contact']->position))
                        <input type="text" name="s_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['secondary_contact']->position }}" />
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
                        @if (isset($user['secondary_contact']->mobile))
                            <input type="text" name="s_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['secondary_contact']->mobile }}" />
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
                        @if (isset($user['secondary_contact']->office_phone))
                            <input type="text" name="s_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['secondary_contact']->office_phone }}" />
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
                        @if (isset($user['secondary_contact']->fax))
                            <input type="text" name="s_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['secondary_contact']->fax }}" />
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
                        @if (isset($user['secondary_contact']->email))
                            <input type="email" name="s_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['secondary_contact']->email }}" />
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
            <h3 class="text-dark font-weight-bold mb-10">Other Contact: </h3>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Contact Name:</label>
                    @if (isset($user['other_contact']->contact_name))
                        <input type="hidden" name="o_id"
                            value="{{ $user['other_contact']->id }}">
                        <input type="text" name="o_contact_name" class="form-control"
                            placeholder="Enter Contact name"
                            value="{{ $user['other_contact']->contact_name }}" />
                    @else
                        <input type="text" name="o_contact_name" class="form-control"
                            placeholder="Enter Contact name" />
                    @endif

                    <span class="form-text text-muted">Please enter your contact name</span>
                </div>
                <div class="col-lg-6">
                    <label>Position:</label>
                    @if (isset($user['other_contact']->position))
                        <input type="text" name="o_position" class="form-control"
                            placeholder="Enter Position"
                            value="{{ $user['other_contact']->position }}" />
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
                        @if (isset($user['other_contact']->mobile))
                            <input type="text" name="o_mobile" class="form-control"
                                placeholder="Enter your mobile"
                                value="{{ $user['other_contact']->mobile }}" />
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
                        @if (isset($user['other_contact']->office_phone))
                            <input type="text" name="o_office_phone" class="form-control"
                                placeholder="Enter your office phone number"
                                value="{{ $user['other_contact']->office_phone }}" />
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
                        @if (isset($user['other_contact']->fax))
                            <input type="text" name="o_fax" class="form-control"
                                placeholder="Enter your Fax"
                                value="{{ $user['other_contact']->fax }}" />
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
                        @if (isset($user['other_contact']->email))
                            <input type="email" name="o_email" class="form-control"
                                placeholder="Enter your office Email"
                                value="{{ $user['other_contact']->email }}" />
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

