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
                                <a href="" class="text-muted">Manage Manifest</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Edit Manifest</a>
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
            <div class="container" style="margin-left: 20px;">
                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header" style="">
                        <div class="card-title">
                            <h3 class="card-label">Manifest Edit Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small></h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('manifest.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a href="javascript:void(0)"
                                   onclick="onUpdate()"
                                   id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Save</a>
                            </div>
                        </div>
                    </div>
                    <form class="card-body" action="{{route('update_manifest')}}" method="post" id="manifest_form">
                    @include('admin.partials._messages')
                    <!--begin::Form-->
                        <div class="container">
                            <div id="card-search-controls" class="row was-validated">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="manifest_id" value="{{$manifest->id}}">

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">

                                    <div class="form-group">
                                        <label>Driver<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-solid" name="driver">
                                            @foreach($all_drivers as $driver)
                                                @if($manifest->driver == $driver->id)
                                                    <option value="{{$driver->id}}" selected>{{$driver->name}}</option>
                                                @else
                                                    <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">

                                    <div class="form-group">
                                        <label>Manifest Type<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-solid" name="type">
                                            <option value="{{$manifest->type}}">{{$manifest->type}}</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Longhaul">Longhaul</option>
                                            <option value="Pickup">Pickup</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">
                                    <div class="form-group">
                                        <label>Dispatch Branch<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-solid" name="dispatch_branch">
                                            @foreach($all_branches as $branch)
                                                @if($manifest->dispatch_branch == $branch->id)
                                                    <option value="{{$branch->id}}"
                                                            selected>{{$branch->branches}}</option>
                                                @else
                                                    <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">
                                    <div class="form-group">
                                        <label>Receiving Branch<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-solid" name="receiving_branch">
                                            @foreach($all_branches as $branch)
                                                @if($manifest->receiving_branch == $branch->id)
                                                    <option value="{{$branch->id}}"
                                                            selected>{{$branch->branches}}</option>
                                                @else
                                                    <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">
                                    <div class="form-group">
                                        <label>Trailer<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name='trailer_name'
                                               value="{{$manifest->trailer}}" required/>

                                        <div class="invalid-feedback">Please select Trailer</div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-2 col-lg-2 col-xs-2">
                                    <div class="form-group">
                                        <label>Arrival Date<span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$manifest->arrival_date}}"
                                                   id="kt_datepicker_3" name='arrival_date' placeholder="Arrival date"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                        <!--end::Form-->
                        {{-- DataTable of Available Jobs  --}}
                        <div class="d-flex p-2 bd-highlight">
                                {{--                            first datalist--}}
                            <div class="card card-custom gutter-b m-2">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Available Jobs:
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form action="{{route('add_job_to_manifest')}}" method="post" id="add_job">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="manifest_id" value="{{ $manifest->id }}">
                                            <!--begin: Datatable-->
                                            <table class="table table-bordered table-hover table-checkable"
                                                   id="availableJobs" style="margin-top: 13px !important;">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <label class="checkbox checkbox-outline checkbox-success"><input
                                                                type="checkbox"><span></span></label>

                                                    </th>
                                                    <th>Connote ID</th>
                                                    <th>Sender name</th>
                                                    <th>Receiver name</th>
                                                    <th>Current Branch</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($driver_jobs as $driver_job)
                                                    <tr>
                                                        <td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="jobs[]" value="{{$driver_job->id}}"><span></span></label></td>
                                                        <td>{{$driver_job->connote_no}}</td>
                                                        <td>{{isset($driver_job->job_sender)?$driver_job->job_sender->sender_name:''}}</td>
                                                        <td>{{isset($driver_job->job_receiver)?$driver_job->job_receiver->receiver_name:''}}</td>
                                                        @if(isset($driver_job->job_current_branch->branches))
                                                            <td>{{$driver_job->job_current_branch->branches}}</td>
                                                        @else
                                                            <td>null</td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                                {{--                            buttons--}}
                            <div class="align-self-center" style="margin: 20px;">


                                <div class="job-select-add-button" style="margin-bottom: 20px">
                                    <a href="javascript:void(0)" style="width: 110px;" id="kt_btn3" onclick="add_selected();" class="btn btn-light-primary font-weight-bolder mr-2">
                                        Add  <i class="ki ki-double-arrow-next"></i></a>
                                </div>
                                <div class="job-select-remove-button">
                                    <a href="javascript:void(0)" style="width: 110px;" id="kt_btn2" onclick="remove_selected();" class="btn btn-light-danger font-weight-bolder mr-2">
                                        <i class="ki ki-double-arrow-back"></i>Remove</a>
                                </div>

                            </div>
                                {{--                            second datalist--}}
                            <div class="card card-custom gutter-b m-2" style="margin-top: 10px;">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Manifest:
                                            {{-- <small style="border: 1px solid black; padding: 2px 4px";; >{{$manifest->id}}</small> --}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form action="{{route('remove_jobs_from_manifest')}}" method="post" id="remove_jobs">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="manifest_id" value="{{ $manifest->id }}">
                                            <!--begin: Datatable-->
                                            <table class="table table-bordered table-hover table-checkable"
                                                   id="manifest_jobs" style="margin-top: 13px !important">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <label class="checkbox checkbox-outline checkbox-success"><input
                                                                type="checkbox"><span></span></label>

                                                    </th>
                                                    <th>Connote ID</th>
                                                    <th>Sender name</th>
                                                    <th>Receiver name</th>
                                                    <th>Current Branch</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($manifest_jobs as $manifest_job)
                                                    <tr>
                                                        <td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="jobs[]" value="{{$manifest_job->id}}"><span></span></label></td>
                                                        <td>{{$manifest_job->connote_no}}</td>
                                                        <td>{{$manifest_job->job_sender->sender_name}}</td>
                                                        <td>{{$manifest_job->job_receiver->receiver_name}}</td>
                                                        @if(isset($manifest_job->job_current_branch->branches))
                                                            <td>{{$manifest_job->job_current_branch->branches}}</td>
                                                        @else
                                                            <td>null</td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
                <!--end::Card-->

            <!--end::Container-->
    </div>
        <!--end::Entry-->
@endsection

@section('script')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <script>

        $(function () {
            $('#availableJobs').DataTable();
        });

        $(function () {
            $('#manifest_jobs').DataTable();
        });

          $(document).on('click', 'th input:checkbox', function () {

              var that = this;
              $(this).closest('table').find('tr > td:first-child input:checkbox')
                  .each(function () {
                      this.checked = that.checked;
                      $(this).closest('tr').toggleClass('selected');
                  });
          });

          function add_selected(){
              Swal.fire({
                  title: "Are you sure?",
                  text: "You want to add jobs to manifest!",
                  icon: "success",
                  showCancelButton: true,
                  confirmButtonText: "Yes, add it!"
              }).then(function(result) {
                  if (result.value) {
                      Swal.fire(
                          "Added!",
                          "Your job has been added.",
                          "success"
                      );
                      $("#add_job").submit();
                  }
              });
          }

        function remove_selected(){
            Swal.fire({
                title: "Are you sure?",
                text: "You want to remove jobs from manifest!",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, remove it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Remove!",
                        "Your job has been removed.",
                        "success"
                    );
                    $("#remove_jobs").submit();
                }
            });
        }

    </script>

    <script>

        // Class definition
        var KTSelect2 = function () {
            // Private functions
            var demos = function () {
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
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {
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
                    escapeMarkup: function (markup) {
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

            var modalDemos = function () {
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
                init: function () {
                    demos();
                    modalDemos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
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
                init: function () {
                    demos();
                }
            };
        }();
        jQuery(document).ready(function () {
            KTBootstrapDatepicker.init();
        });
    </script>
    <script>
        var btn2 = KTUtil.getById("kt_btn2");

        KTUtil.addEvent(btn2, "click", function() {
            KTUtil.btnWait(btn2, "spinner spinner-right spinner-white pr-15", "Please wait");

            setTimeout(function() {
                KTUtil.btnRelease(btn2);
            }, 1000);
        });

        var btn3 = KTUtil.getById("kt_btn3");

        KTUtil.addEvent(btn3, "click", function() {
            KTUtil.btnWait(btn3, "spinner spinner-right spinner-white pr-15", "Please wait");

            setTimeout(function() {
                KTUtil.btnRelease(btn3);
            }, 1000);
        });
    </script>
    <script>
        function onUpdate(){
            event.preventDefault();

            // var jobStatus = $('.job_status').val();
            // var branch =$('#dispatch_branch').val();
            // var arrivalDate =$('input[name="arrival_date"]').val();

            document.getElementById('manifest_form').submit();
        }
    </script>
@endsection

