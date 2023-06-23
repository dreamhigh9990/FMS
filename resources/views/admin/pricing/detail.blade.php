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
                                <a href="" class="text-muted">Manage Pricing</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">View Pricing</a>
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
                            <h3 class="card-label">Pricing View Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small></h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('pricing.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>



                        </div>
                    </div>
                    <div class="card-body">
                    @include('admin.partials._messages')
                    <!--begin::Form-->
                            @csrf
                            <div class="row">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-10">
                                    <div>
                                        <h3 class="text-dark font-weight-bold mb-10">Pricing Info: </h3>

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label><h6>Title:</h6></label>
                                                <span>&nbsp;&nbsp;{{$pricing->title}}</span>
                                            </div>

                                            <div class="col-lg-6">
                                                <label><h6>Update price by %:</h6></label>
                                                    <span>&nbsp;&nbsp;{{$pricing->discount}}</span>
                                            </div>
                                        </div>

                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                        <h4>Pricing Details:</h4>
                                        {{--item-table-start--}}
                                        <div class="container-fluid border border-gray">
                                            <table class="table table-responsive-sm" id='itemtable' style="margin-top: 20px;">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Item Type</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Discount</th>
                                                    <th>Reversal Price</th>
                                                    <th>View Price by</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i = 0; $i<count($pricing->price_detail); $i++)
                                                    <tr>
                                                        <td>
                                                            <span> {{$pricing->price_detail[$i]['item_type_id']}}</span>
                                                            <input type='hidden' id='random_no_id' name='random_no[]' value='{{$pricing->price_detail[$i]['row_no']}}'>
                                                        </td>

                                                        <td>
                                                            <span>{{$pricing->price_detail[$i]['from_branch']->branches}}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{$pricing->price_detail[$i]['to_branch']->branches}}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{$pricing->price_detail[$i]['discount_for_item']}}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{$pricing->price_detail[$i]['reversal_pricing']}}</span>
                                                        </td>

                                                        <td>
                                                            <a class='btn btn-sm btn-clean btn-icon show_modal' title='View Price by Weight' href='javascript:void(0)'><i class='icon-1x text-dark-50 flaticon-add'></i> </a>
                                                            <a class='btn btn-sm btn-clean btn-icon show_modal_spc' title='View Price by PI Spc' href='javascript:void(0)'><i class='icon-1x text-dark-50 flaticon2-add-1'></i> </a>
                                                        </td>


                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                        {{--item-table-end--}}




                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray;margin-top: 20px;">
                                        <h4 style="margin-top: 20px;margin-bottom: 20px;">Pricing Fee:</h4>
                                        <div class="form-group row {{ $errors->has('pickup_fee') ? 'has-error' : '' }}">
                                            <label class="col-2"><h6>Pickup fee</h6></label>
                                            <div class="col-4">
                                                <span>{{ $pricing->pickup_fee}}</span>                                               <span class="text-danger">{{ $errors->first('pickup_fee') }}</span>
                                            </div>
                                            <label class="col-2"><h6>Delivery Fee</h6></label>
                                            <div class="col-4">
                                               <span>{{ $pricing->delivery_fee}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row ">

                                            <label class="col-2"><h6>Con Fee</h6></label>
                                            <div class="col-4">
                                                <span>{{ $pricing->con_fee}}</span>

                                            </div>
                                            <label class="col-2"><h6>Fuel Levy</h6></label>
                                            <div class="col-4">
                                                <span>{{$pricing->fuel_levy}}</span>

                                            </div>

                                        </div>
                                        <div class="form-group row ">

                                            <label class="col-2"><h6>Futile Pickup Fee</h6></label>
                                            <div class="col-4">
                                               <span>{{$pricing->futile_pickup_fee}} </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-1"></div>
                            </div>

                        <!--end::Form-->
                    </div>
                </div>


                <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body" id="price_by_w_id">
                                <div id="modal_body">

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary w_close_mod"onclick="javascript:void(0);">Close</button>
                            </div>

                        </div>

                    </div>
                </div>

                {{--                Price by PL SPC modal--}}


                <!--end::Card-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

@section('script')
    <script>

        //add price by weight start
        $("body").on("click",".show_modal",function () {
            var random_no = $(this).parent().parent().find('td:first-child').find('#random_no_id').val();

            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/get_add_price_by_weight',
                //url: '/admin/pricing/store',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    "_token": "{{ csrf_token() }}",
                    'random_no': random_no,

                    /* remind that 'data' is the response of the AjaxController */

                },
                success: function (data) {

                    var rowscollect = [];

                    for (var i = 0; i< data.length; i++){
                        var pre_rows = '';
                        pre_rows = '                                            <tr>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].w_from + '</span>&nbsp<span>KG</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].w_to + '</span>&nbsp<span>KG</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].w_cost+ '</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                            </tr>';

                        //console.log(pre_rows);
                        rowscollect.push(pre_rows);
                    }





                    var modal_table = '<div class="container-fluid border border-gray">\n' +
                        '                                    <table class="table table-responsive-sm" id=\'price_by_w_table\' style="margin-top: 20px;">\n' +
                        '                                        <thead class="thead-light">\n' +
                        '                                        <tr>\n' +
                        '                                            <th>From</th>\n' +
                        '                                            <th>To</th>\n' +
                        '                                            <th>Cost</th>\n' +
                        '                                        </tr>\n' +
                        '                                        </thead>\n' +
                        '                                        <tbody>\n' +
                        '                                        <form id="modal_form">\n' +
                        '                                            <input type="hidden" id="row_no" name="row_no" value="'+random_no+'">\n' +
                        rowscollect+
                        '                                        </form>\n' +
                        '                                        </tbody>\n' +
                        '                                    </table>\n' +
                        '                                </div>';

                    $('#modal_body').append(modal_table);
                    $('#exampleModal').modal('show');



                }

        });






        });
        $("body").on("click",".w_close_mod",function () {
            $('#modal_body').html('');
            $('#exampleModal').modal('hide');
        });
        $("body").on("click",".show_modal_spc",function () {
            var random_no = $(this).parent().parent().find('td:first-child').find('#random_no_id').val();
            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/get_add_price_by_spc',
                //url: '/admin/pricing/store',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    "_token": "{{ csrf_token() }}",
                    'random_no': random_no,

                    /* remind that 'data' is the response of the AjaxController */

                },
                success: function (data) {
                    console.log(data);
                    var rowscollect = [];

                    for (var i = 0; i< data.length; i++){
                        var pre_rows = '';
                        pre_rows = '                                            <tr>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].spc_form + '</span>&nbsp<span>KG</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].spc_to + '</span>&nbsp<span>KG</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                                <td>\n' +
                            '                                                    <div class="input-group input-group-sm mb-3">\n' +
                            '                                                        <span>' + data[i].spc_cost+ '</span>\n' +
                            '                                                    </div>\n' +
                            '                                                </td>\n' +
                            '                                            </tr>';

                        //console.log(pre_rows);
                        rowscollect.push(pre_rows);
                    }





                    var modal_table = '<div class="container-fluid border border-gray">\n' +
                        '                                    <table class="table table-responsive-sm" id=\'price_by_w_table\' style="margin-top: 20px;">\n' +
                        '                                        <thead class="thead-light">\n' +
                        '                                        <tr>\n' +
                        '                                            <th>From</th>\n' +
                        '                                            <th>To</th>\n' +
                        '                                            <th>Cost</th>\n' +
                        '                                        </tr>\n' +
                        '                                        </thead>\n' +
                        '                                        <tbody>\n' +
                        '                                        <form id="modal_form">\n' +
                        '                                            <input type="hidden" id="row_no" name="row_no" value="'+random_no+'">\n' +
                        rowscollect+
                        '                                        </form>\n' +
                        '                                        </tbody>\n' +
                        '                                    </table>\n' +
                        '                                </div>';

                    $('#modal_body').append(modal_table);
                    $('#exampleModal').modal('show');



                }

        });

        });
        $("body").on("click",".p_close_mod",function () {
            $('#modal_body').html('');
            $('#exampleModal').modal('hide');
        });

    </script>
    <script>

        // Class definition
        var KTSelect2 = function () {
            // Private functions
            var demos = function () {
                // basic
                $('#kt_select2_1').select2({
                    placeholder: "Select a Item Type"
                });

                // nested
                $('#kt_select2_2').select2({
                    placeholder: "Select a Branch"
                });

                // multi select
                $('#kt_select2_3').select2({
                    placeholder: "Select a Branch",
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
@endsection

