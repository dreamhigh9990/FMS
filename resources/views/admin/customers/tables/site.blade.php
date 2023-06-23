<h3 class="text-dark font-weight-bold m-10">Sites: </h3>

<a href="#" onclick="event.preventDefault(); " id="add_site_btn" class="btn btn-primary font-weight-bolder m-2">
    <i class="ki ki-plus icon-sm"></i>Add Site
</a>
<a href="#" onclick="event.preventDefault();" id="del_site_btn" class="btn btn-light-danger font-weight-bold m-2">
    <i class="ki ki-close icon-sm"></i>Delete
</a>

<!-- Modal -->
<div class="modal fade" id="siteModal" tabindex="-1" role="dialog" aria-labelledby="siteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog was-validated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siteModalLabel">Update Site</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="updateSiteForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id" />
                    <div class="form-group row">
                        <label class="col-form-label col-4">Site Name</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="site_name" name="site_name" required />
                            <div class="invalid-feedback">Please input the site name</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Address Line 1</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                required />
                            <div class="invalid-feedback">Please input the address line 1</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Address Line 2</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                required />
                            <div class="invalid-feedback">Please input the address line 2</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-4">Address Line 3</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="address_line_3" name="address_line_3"
                                required />
                            <div class="invalid-feedback">Please input the address line 3</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-4">Address Line 4</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="address_line_4" name="address_line_4"
                                required />
                            <div class="invalid-feedback">Please input the address line 4</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Suburb</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="suburb" name="suburb" required />
                            <div class="invalid-feedback">Please input the suburb</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Postcode</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                required />
                            <div class="invalid-feedback">Please input the postcode</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">State</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="state" name="state" required />
                            <div class="invalid-feedback">Please input the state</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Operating Hours</label>
                        <div class="col-8">
                            <input type="time" name="operating_hours" id="operating_hours"
                                class="form-control" required />
                            <div class="invalid-feedback">Please input the operating hours</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-4">Site Contact</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="site_contact" name="site_contact" required />
                            <div class="invalid-feedback">Please input the site contact</div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_site_btn">Update</button>
            </div>
        </div>
    </div>

</div>

<table id="site-table" class="display table table-bordered table-hover table-checkable" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" name="select_all" value="1" id="site-select-all">
            </th>
            <th>Site Name</th>
            <th>Address Line1</th>
            <th>Address Line2</th>
            <th>Address Line3</th>
            <th>Address Line4</th>
            <th>Suburb</th>
            <th>Postcode</th>
            <th>State</th>
            <th>Operating Hours</th>
            <th>Site Contact</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
{{-- <div class="card-body">
    <h3 class="text-dark font-weight-bold mb-10">Site: </h3>

    <div id="site_container">
        @if (isset($user->sites[0]['id']))
            <?php $x = 1; ?>
            @foreach ($user->sites as $site)
                @if ($x != 1)
                    <hr>
                    <hr>
                @endif
                <div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Site Name(Required):</label>
                            <input type="text" name="site_name[]" class="form-control"
                                placeholder="Enter a Site name"
                                value="{{ $site['site_name'] }}" />
                            <span class="form-text text-muted">Please enter your site
                                name</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Address line 1(Required):</label>
                            <input type="text" name="address_line_1[]"
                                class="form-control" placeholder="Enter a location"
                                value="{{ $site['address_line_1'] }}" />
                            <span class="form-text text-muted">Please enter your address
                                line one</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Address line 2:</label>
                            <input type="text" name="address_line_2[]"
                                class="form-control" placeholder="Enter a location"
                                value="{{ $site['address_line_2'] }}" />
                            <span class="form-text text-muted">Please enter your address
                                line two</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Suburb:</label>
                            <input type="text" name="suburb[]" class="form-control"
                                placeholder="Enter your suburb"
                                value="{{ $site['suburb'] }}" />
                            <span class="form-text text-muted">Please enter suburb</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Postal code:</label>
                            <input type="text" name="postal_code[]" class="form-control"
                                placeholder="Enter a postal code"
                                value="{{ $site['postal_code'] }}" />
                            <span class="form-text text-muted">Please enter your postal
                                code</span>
                        </div>
                        <div class="col-lg-3">
                            <label>State:</label>
                            <input type="text" name="state[]" class="form-control"
                                placeholder="Enter your state"
                                value="{{ $site['state'] }}" />
                            <span class="form-text text-muted">Please enter state</span>
                        </div>
                        <div class="col-lg-3">
                            <label>Opening time:</label>
                            <input type="time" name="opening_time[]" class="form-control"
                                placeholder="Enter your opening time"
                                value="{{ $site['opening_time'] }}" />
                            <span class="form-text text-muted">Please enter opening
                                time</span>
                        </div>
                        <div class="col-lg-2">
                            <div>
                                @if ($x != 1)
                                    <a href="javascript:void(0)"
                                        class="remove-site-update"><span
                                            style="color: red">Remove</span></a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <?php $x++; ?>
            @endforeach
        @else
            <div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Site Name:</label>
                        <input type="text" name="site_name[]" class="form-control"
                            placeholder="Enter a Site name" />
                        <span class="form-text text-muted">Please enter your site
                            name</span>
                    </div>
                    <div class="col-lg-6">
                        <label>Address line 1:</label>
                        <input type="text" name="address_line_1[]" class="form-control"
                            placeholder="Enter a location" />
                        <span class="form-text text-muted">Please enter your address line
                            one</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Address line 2:</label>
                        <input type="text" name="address_line_2[]" class="form-control"
                            placeholder="Enter a location" />
                        <span class="form-text text-muted">Please enter your address line
                            two</span>
                    </div>
                    <div class="col-lg-6">
                        <label>Suburb:</label>
                        <input type="text" name="suburb[]" class="form-control"
                            placeholder="Enter your suburb" />
                        <span class="form-text text-muted">Please enter suburb</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>Postal code:</label>
                        <input type="text" name="postal_code[]" class="form-control"
                            placeholder="Enter a postal code" />
                        <span class="form-text text-muted">Please enter your postal
                            code</span>
                    </div>
                    <div class="col-lg-3">
                        <label>State:</label>
                        <input type="text" name="state[]" class="form-control"
                            placeholder="Enter your state" />
                        <span class="form-text text-muted">Please enter state</span>
                    </div>
                    <div class="col-lg-3">
                        <label>Opening time:</label>
                        <input type="time" name="opening_time[]" class="form-control"
                            placeholder="Enter your opening time" />
                        <span class="form-text text-muted">Please enter opening time</span>
                    </div>
                </div>
            </div>
        @endif

    </div>


    <div class="form-group row">
        <div class="col-lg-12">
            <a href="javascript:void(0)" onclick="add_site()"
                class="btn btn-success btn-sm mr-3 float-right ">
                <i class="flaticon2-pie-chart"></i>Add new site</a>
        </div>
    </div>
</div> --}}

