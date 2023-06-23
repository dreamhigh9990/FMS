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
                                <a href="" class="text-muted">Manage Jobs</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Update Job Status</a>
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
                            <h3 class="card-label">Update Job status Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small>
                            </h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('jobs.index') }}"
                                class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a href=""
                                    onclick="onUpdate()"
                                    id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>update</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.partials._messages')
                        <!--begin::Form-->
                        {{ Form::open(['route' => 'update_job_status','class' => 'form','id' => 'client_add_form','enctype' => 'multipart/form-data']) }}
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Update Job Status: </h3>

                                    <div id="connote_wraper">
                                        <div class="form-group row connote-group">
                                            <label class="col-form-label col-3">Connote Number</label>
                                            <div class="col-5">
                                                <input type="text" class="form-control" value="" id="connote_no"
                                                    name='connote_no' placeholder="Please enter Cannote number" />
                                                {{-- <select class="form-control connote_no select1" id="kt_select3_1"
                                                    name="connote_no" >

                                                    <option value=""></option>
                                                    @foreach ($all_connotes as $connotes)
                                                        <option value="{{ $connotes->id }}"
                                                            {{ old('status') == $connotes->id ? 'selected' : '' }}>
                                                            {{ $connotes->connote_no }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            <div class="col-4">
                                                <a style="float:left; margin-left:10px;" onclick="addconnote()" href="javascript:void(0);"
                                                    class="btn btn-icon btn-light-success btn-circle btn-sm mr-2">
                                                    <i class="flaticon2-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group row connote-no-group">
                                        </div>
                                        <div class="invalid-feedback connote-error">Please add Connotes</div>
                                    </div>

                                    <hr>
                                    <div class="was-validated">

                                        <div class="form-group row ">
                                            <label class="col-form-label col-3">Job Status</label>
                                            <div class="col-5">
                                                <select class="form-control job_status select1" id="kt_select2_1"
                                                    name="job_status" >

                                                    <option value="">-none-</option>
                                                    @foreach ($all_statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ old('status') == $status->id ? 'selected' : '' }}>
                                                            {{ $status->job_status }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Please select Job Status</div>
                                            </div>
                                        </div>

                                        <div class="form-group row @error('current_branch') is-invalid @enderror">
                                            <label class="col-form-label col-lg-3 col-sm-12">Current Branch</label>
                                            <div class=" col-5">
                                                <select class="form-control select1 current_branch" name="current_branch" id="current_branch" >
                                                    <option value="">-none-</option>
                                                    @foreach ($all_branches as $branch)
                                                        <option value="{{ $branch->id }}"
                                                            {{ old('current_branch') == $branch->id ? 'selected' : '' }}>
                                                            {{ $branch->branches }}</option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">Please select Branch</div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-3 col-sm-12">Job Type</label>
                                            <div class="col-5">
                                                <select class="form-control  job_type " name="job_type">
                                                    <option value="" selected>-none-</option>
                                                    <option value="general">
                                                        General</option>
                                                    <option value="express">
                                                        Express</option>
                                                    <option value="hotshot">
                                                        Hotshot</option>
                                                    <option value="special">
                                                        Special</option>
                                                </select>
                                                <div class="invalid-feedback">Please select Job Type</div>
                                            </div>
                                        </div>

                                        <div class="form-group row @error('current_branch') is-invalid @enderror">
                                            <label class="col-form-label col-lg-3 col-sm-12">Assign Driver</label>
                                            <div class=" col-5">
                                                <select class="form-control assigned_driver select2" id="kt_select2_2"
                                                    name="assigned_driver">
                                                    <option value="" selected>-none-</option>
                                                    @foreach ($all_drivers as $driver)
                                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">Please select Assign Driver</div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3">Ready Date</label>
                                            <div class="col-5">
                                                <input type="text" class="form-control" value=""
                                                    id="kt_datepicker_4" name='ready_date' placeholder="ready date" />
                                                <div class="invalid-feedback">Please select Ready Date</div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-3">Delivered Date</label>
                                            <div class="col-5">
                                                <input type="text" class="form-control" value=""
                                                    id="kt_datepicker_3" name='arrival_date' placeholder="arrival date" />
                                                <div class="invalid-feedback">Please select Delivered Date</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
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
        $(".connote-btn").click(function(){
            $(this).remove();
        });

        $('#connote_no').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                // alert('You pressed a "enter" key in textbox');
                addconnote();
            }
        });

        function addconnote() {
            // var connote_input = '<div class="form-group row">\n' +
            //     '                                            <label class="col-3">Connote Number</label>\n' +
            //     '                                            <div class="col-5">\n' +
            //     '                                                <input type="text" class="form-control" value=""  id="connote_no" name="connote_no[]" placeholder="Please enter Cannote number"/>\n' +
            //     '                                            </div>\n' +
            //     '                                            \n' +
            //     @error('connote_no')
            //         \n' +
            //         ' <div class="alert alert-danger">{{ $message }}</div>\n' +
            //         '
            //     @enderror\n' +
            //     '<a  href="javascript:void(0);" style="margin-left:5px;" class="input-group-append close btn btn-icon  btn-circle btn-sm mr-2"><i style="color:red;" class="flaticon2-delete"></i></a>\n' +
            //     '                                        </div>';

            // $('#connote_wraper').append(connote_input);
            var con_no =  $('#connote_no').val().replaceAll(" ",""); //$('#select2-kt_select3_1-container').html().replaceAll("\n","").replaceAll(" ","");
            var con_lists=[];
            $('span.con-no-label').each(function (index) {
                con_lists.push($(this).html().replaceAll("\n","").replaceAll(" ",""));
            });

            $('.connote-error').removeClass("d-block");
            if(con_no!="" && con_lists.filter(e=>e==con_no).length==0){
                $('.connote-no-group').append(`
                    <button type="button" class="btn btn-secondary connote-btn">
                        <span class='con-no-label'>${con_no}</span>
                        <span aria-hidden="true">&times;</span>
                    </button>
                `);
                $('#connote_no').val('');
                $('#connote_no').focus();
                $(".connote-btn").click(function(){
                    $(this).remove();
                });
            }else{
                swal({
                    title: "Alert!",
                    text: "Do not Duplicate Connote Number or empty number, Retry again.",
                    icon: "warning",
                }).then(e=>{
                    $('#connote_no').val('');
                    $('#connote_no').focus();
                });

            }
        }

        $("body").on("click", ".close", function() {
            $(this).parent().remove();
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
                $('#kt_select3_1').select2({
                    placeholder: "Select a connote no"
                });

                // nested
                $('#kt_select2_2').select2({
                    placeholder: "Select a state"
                });


                $('.receiver_branch').select2({
                    placeholder: "Select a receiver branch"
                });

                $('.current_branch').select2({
                    placeholder: "Select a current branch"
                });

                $('.job_type').select2({
                    placeholder: "Select a job type"
                });

                $('.job_status').select2({
                    placeholder: "Select a status"
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
    <script>
        //Class Definition
        var KTBootstrapDatepicker = function() {
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
            var demos = function() {
                $('#kt_datepicker_3').datepicker({
                    format: 'dd-mm-yyyy'
                });

                $('#kt_datepicker_4').datepicker({
                    format: 'dd-mm-yyyy'
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
    <script>
        function onUpdate(){
            event.preventDefault();

            var con_lists=[];
            $('span.con-no-label').each(function (index) {
                con_lists.push($(this).html().replaceAll("\n","").replaceAll(" ",""));
            });
            if(con_lists.length==0){
                $('.connote-error').addClass("d-block");
            }else{
                $('.connote-error').removeClass("d-block");
            }

            var jobStatus = $('.job_status').val();
            var branch =$('#current_branch').val();
            var arrivalDate =$('input[name="arrival_date"]').val();
            console.log("AAA", jobStatus, branch, arrivalDate)
            if(con_lists.length>0){
                // document.getElementById('client_add_form').submit();
                var formData = $("#client_add_form").serialize();
                formData = formData +'&connote_nums='+con_lists.join();
                console.log(formData);
                $.post("{{ route('update_job_status_bulk') }}", formData, function(data) {
                    $.toast({
                        heading: 'Update Job Status'+data.res,
                        text: data.message,
                        hideAfter: 3000,
                        position: 'top-right',
                        icon: data.status ? 'success' : 'warning'
                    })
                    $('.connote-error').removeClass("d-block");
                    // $("#client_add_form").trigger("reset");
                    $('.connote-no-group').html('');
                });
            }else{
                swal({
                    title: "Alert!",
                    text: "Please input your required information",
                    icon: "warning",
                });
            }

        }
    </script>
@endsection
