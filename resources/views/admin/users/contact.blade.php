<h3 class="text-dark font-weight-bold m-10"> </h3>

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
    </div>

