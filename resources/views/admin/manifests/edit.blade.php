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
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">
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
                <a href="{{ route('manifest.store') }}"  onclick="event.preventDefault(); document.getElementById('client_add_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                  <i class="ki ki-check icon-sm"></i>Save</a>

              </div>
            </div>
          </div>
          <div class="card-body">
          @include('admin.partials._messages')
          <!--begin::Form-->
            <form class="form"  id="client_add_form" method="post" action="{{route('manifest.update',$manifest->id)}}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                  <div class="my-5">
                    <h3 class="text-dark font-weight-bold mb-10">Manifests Info: </h3>


                      <div class="form-group row {{ $errors->has('driver') ? 'has-error' : '' }}">
                          <label class="col-3">Driver</label>
                          <div class="col-5">
                              <select class="form-control driver" name="driver">

                                  @foreach($all_drivers as $driver)
                                      @if($driver->id == $manifest['driver'])
                                            <option value="{{$driver->id}}" selected>{{$driver->name}}</option>
                                      @else
                                          <option value="{{$driver->id}}">{{$driver->name}}</option>
                                      @endif
                                  @endforeach

                              </select>
                              <span class="text-danger">{{ $errors->first('driver') }}</span>
                          </div>
                      </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-3 col-sm-12">Dispatch Branch</label>
                          <div class=" col-5">
                              <select class="form-control dispatch_branch" name="dispatch_branch">

                                  <option value="{{$manifest['dispatch_branch']}}">{{$manifest->from_manifest['branches']}}</option>
                                  @foreach($all_branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                  @endforeach

                              </select>
                          </div>

                      </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-3 col-sm-12">Receiving Branch</label>
                          <div class=" col-5">
                              <select class="form-control select2" id="kt_select2_2" name="receiving_branch">

                                  <option value="{{$manifest['receiving_branch']}}">{{$manifest->to_manifest['branches']}}</option>
                                  @foreach($all_branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                  @endforeach

                              </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-3 col-sm-12">Type</label>
                          <div class=" col-5">
                              <select class="form-control select3" id="kt_select2_3" name="type">

                                    <option value="Delivery"{{($manifest['type']=='Delivery')?"selected=selected":""}}>Delivery</option>
                                    <option value="Linehaul"{{($manifest['type']=='Longhaul')?"selected=selected":""}}>Linehaul</option>
                                    <option value="Pickup"{{($manifest['type']=='Pickup')?"selected=selected":""}}>Pickup</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-3">Trailer</label>
                          <div class="col-5">
                              <input type="text" class="form-control" name='trailer_name' value="{{$manifest['trailer']}}"/>
                              @if($errors->has('trailer_name'))
                                  <div class="text-danger">{{ $errors->first('trailer_name') }}</div>
                              @endif
                          </div>
                      </div>

                        <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Arrival Date</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="input-group date" >
                                    <input type="text" class="form-control" readonly  value={{$manifest['arrival_date']}} id="kt_datepicker_3" name='arrival_date'/>
                            <div class="input-group-append">
                         <span class="input-group-text"><i class="la la-calendar"></i></span>
                        </div>
                        </div>
                      </div>
                    </div>
                </div>

              </div>

            <form>
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

@section('script')
    <script>
        // Class definition
        $('#kt_datepicker_3').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left"
        });
        var KTSelect2 = function() {
            // Private functions
            var demos = function() {
                // basic
                $('#kt_select2_1').select2({
                    placeholder: "Select a state"
                });

                $('.dispatch_branch').select2({
                    placeholder: "Select a branch"
                });

                $('.driver').select2({
                    placeholder: "Select a driver"
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

@endsection

