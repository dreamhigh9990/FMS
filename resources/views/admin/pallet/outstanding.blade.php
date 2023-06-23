
{{-- <a href="#" onclick="event.preventDefault(); " id="add_outstanding_btn" class="btn btn-primary font-weight-bolder m-2">
    <i class="ki ki-plus icon-sm"></i>Add Outstanding
</a>
<a href="#" onclick="event.preventDefault();" id="del_outstanding_btn" class="btn btn-light-danger font-weight-bold m-2">
    <i class="ki ki-close icon-sm"></i>Delete
</a> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="outstandingModal" tabindex="-1" role="dialog" aria-labelledby="outstandingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog was-validated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="outstandingModalLabel">Update Outstanding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="updateOutstandingForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" />
                    <div class="form-group row">
                        <label class="col-form-label col-4">Outstanding Name</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="outstanding_name" name="outstanding_name" required />
                            <div class="invalid-feedback">Please input the outstanding name</div>
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
                            <select class="form-control select2" id="alerts" name="alerts">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_outstanding_btn">Update</button>
            </div>
        </div>
    </div>

</div> --}}

<table id="outstanding-table" class="display table table-bordered table-hover table-checkable" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" name="select_all" value="1" id="outstanding-select-all">
            </th>
            <th>Connote</th>
            <th>Owing Customer</th>
            <th>Age</th>
            <th>Chep</th>
            <th>Loscam</th>
        </tr>
    </thead>
</table>


