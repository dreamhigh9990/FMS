@extends('admin.layouts.master')
@section('title',$title)
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
                <a href="" class="text-muted">Manage Employees</a>
              </li>
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">Edit Employees</a>
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
        <!--begin::Card-->
        <div class="card card-custom card-sticky" id="kt_page_sticky_card">
          <div class="card-header" style="">
            <div class="card-title">
              <h3 class="card-label">Employees Edit Form
                <i class="mr-2"></i>
                <small class="">try to scroll the page</small></h3>

            </div>
            <div class="card-toolbar">

              <a href="{{ route('employee.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

              <div class="btn-group">
                <a href="javascript:void(0)"  onclick="event.preventDefault(); document.getElementById('client_add_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                  <i class="ki ki-check icon-sm"></i>Save</a>

              </div>
            </div>
          </div>
          <div class="card-body">
          @include('admin.partials._messages')
          <!--begin::Form-->
            <form class="form"  id="client_add_form" method="post" action="{{route('employee.update',$employee->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                  <div class="my-3">
                    <h3 class="text-dark font-weight-bold mb-10">Employee Details: </h3>
                    <hr>

                    <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : '' }} {{ $errors->has('last_name') ? 'has-error' : '' }}">
                          <label class="col-2">First Name:</label>
                          <div class="col-4">
                              <input type="text" name="first_name" id="first_name" class="form-control form-control-solid" placeholder="Enter firstname here" value="{{ $employee['first_name'] }}">
                              <span class="text-danger">{{ $errors->first('first_name') }}</span>
                          </div>
                          <label class="col-2">Last Name:</label>
                          <div class="col-4">
                              <input type="text" name="last_name" id="last_name" class="form-control form-control-solid" placeholder="Enter last name here" value = {{ $employee['last_name'] }}>
                              <span class="text-danger">{{ $errors->first('last_name') }}</span>
                          </div>
                    </div>
                    <div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }} {{ $errors->has('mobile') ? 'has-error' : '' }}">
                          <label class="col-2">Mobile:</label>
                          <div class="col-4">
                              <input type="number" class="form-control form-control-solid" name="mobile" id="mobile" value="{{ $employee['mobile'] }}" >
                              <span class="text-danger">{{ $errors->first('mobile') }}</span>
                          </div>
                            <label class="col-2">Branch:</label>
                           <div class=" col-4">
                              <select class="form-control select2" id="kt_select2_2" name="branch">

                                  @foreach($all_branches as $branch)
                                      @if($employee->branch_id == $branch->id)
                                        <option value="{{$branch->id}}" selected>{{$branch->branches}}</option>
                                      @else
                                          <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                      @endif
                                  @endforeach

                              </select>
                          </div>
                    </div>
                    <div class="form-group row {{ $errors->has('employee_id') ? 'has-error' : '' }} {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                          <label class="col-2">Employee ID</label>
                          <div class="col-4">
                              <input type="text" name="employee_id" id="employee_id" class="form-control form-control-solid" value="{{ $employee['employee_id'] }}" placeholder="Enter Employee ID here">
                              <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                          </div>

                    </div>
                    <h3 class="text-dark font-weight-bold mb-10">Employee Login Details: </h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Can Use App?</label>
                        <div class="col-3">
                        <span class="switch switch-outline switch-icon switch-success">
                            <label>
                            <input type="checkbox" {{($employee['can_use_app'])?'checked':''}} name="can_use_app"/>
                            <span></span>
                            </label>
                        </span>
                    </div>
                    <label class="col-3 col-form-label">Can Login?</label>
                    <div class="col-3">
                    <span class="switch switch-outline switch-icon switch-warning">
                        <label>
                        <input type="checkbox" {{($employee['can_login'])?'checked':''}} name="can_login"/>
                        <span></span>
                        </label>
                    </span>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label  class="col-2 col-form-label">New Password</label>
                    <div class="col-4">
                    <input class="form-control form-control-solid  @error('password') is-invalid @else is-valid @enderror " type="password" id="password" name="password" placeholder="Enter New Password Here"/>
                    </div>
                    @error('password')
                           <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label  class="col-2 col-form-label">Confirm Password</label>
                    <div class="col-4">
                    <input class="form-control form-control-solid @error('password_confirmation') is-invalid @else is-valid @enderror" type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter Password Again Here" />
                    </div>

                        @error('password_confirmation')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    <label  class="col-2 col-form-label">New PIN</label>
                    <div class="col-4">
                    <input class="form-control form-control-solid" type="password" id="new_pin" name="new_pin"  placeholder="Enter New PIN Here"/>
                    </div>
                    </div>

                    </div>
                </div>
                </div>

              </div>

            </form>
            <!--end::Form-->
          </div>
        </div>
        <!--end::Card-->
    </div>
      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>
@endsection

@section('script')
    <script>
    $('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
    });
    </script>
    <script>

        // Class definition
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                // basic
                $('#kt_select2_1').select2({
                    placeholder: "Select a state"
                });

                // nested
                $('#kt_select2_2').select2({
                    placeholder: "Select a state"
                });

                // multi select
                $('#kt_select2_3').select2({
                    placeholder: "Select a state",
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
                        markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
                    }
                    markup += "<div class='select2-result-repository__statistics'>" +
                        "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
                        "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                        "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
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
                $('#kt_select2_modal').on('shown.bs.modal', function () {
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
<script>
            //Class Definition
        var KTBootstrapDatepicker = function () {
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
        var demos = function () {
        $('#kt_datepicker_3').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left"
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
@endsection

