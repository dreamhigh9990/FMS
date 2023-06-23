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
                            <a href="" class="text-muted">Add Pricing</a>
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
                        <h3 class="card-label">Pricing Add Form
                            <i class="mr-2"></i>
                            <small class="">try to scroll the page</small>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('pricing.index') }}" class="btn btn-light-primary font-weight-bolder mr-2">
                            <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>
                        <div class="btn-group">
                            <a href="{{ route('pricing.store') }}" onclick="onSave();"
                                id="kt_btn" class="btn btn-primary font-weight-bolder">
                                <i class="ki ki-check icon-sm"></i>Save</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.partials._messages')
                    <!--begin::Form-->
                    {{ Form::open([ 'route' => 'pricing.store','class'=>'form' ,"id"=>"client_add_form", 'enctype'=>'multipart/form-data']) }}
                    @csrf
                    <div class="row validate-form">
                        <div class="col-xl-1"></div>
                        <div class="col-xl-10">
                            <div>
                                <h3 class="text-dark font-weight-bold mb-10">Pricing Info: </h3>
                                <div class="form-group row  main-input">
                                    <div class="col-lg-6">
                                        <label><strong>Title </strong><span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                        <input type="text" name="company_title" class="form-control"
                                            placeholder="Enter price title" required/>
                                        @if($errors->has('company_title'))
                                        <div class="text-danger">{{ $errors->first('company_title') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6"><label></label>
                                        <div class="input-group" style="margin-top: 6px;">
                                            <input type="text" class="form-control" name="percentage"
                                                aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="button-addon2">Update all price by (%)</button>
                                        </div>
                                    </div>
                                </div>
                                <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray">
                                <h4>Pricing Details:</h4>
                                {{--item-table-start--}}
                                <div class="container-fluid border border-gray" id="item_div">
                                    <table class="table table-responsive-sm" id='itemtable' style="margin-top: 20px;">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Item Type</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Discount</th>
                                                <th>Reversal Price</th>
                                                <th>Add Price by</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                {{--item-table-end--}}
                                <form class=" ">
                                    <div
                                        style="border: solid lightgray 1px; padding: 20px;border-radius: 5px; margin-top: 20px;">
                                        <div class="price-form form-group row">
                                            <div class="col-lg-4">
                                                <label>Item Type:<span style="color: red;font-size: 15px;">*</span></label>
                                                <select class="form-control select2_1" id="item_type" required>
                                                    <option value="">Select a Value</option>
                                                    @foreach($items as $item)
                                                    <option value="{{$item->item_name}}">{{$item->item_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" >Please select this field.</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>From:<span style="color: red;font-size: 15px;">*</span></label>
                                                <select class="form-control select2_2" id="from"
                                                    onChange="myNewFunction(this);" required>
                                                    <option value="">Select a Value</option>
                                                    @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" >Please select this field.</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>To:<span style="color: red;font-size: 15px;">*</span></label>
                                                <select class="form-control select2_3" id="to" onChange="toFunction(this);" required>
                                                    <option value="">Select a Value</option>
                                                    @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback" >Please select this field.</div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>Discount:</label>
                                                <input type="number" class="form-control" id="discount_item" min="1" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Reversal Price Applied:</label>
                                                <div class="col-3">
                                                    <span class="switch switch-icon">
                                                        <label>
                                                            <input type="checkbox" class="form-control"
                                                                id="reversal_pricing" />
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <button class="form-control btn btn-sm btn-danger" id="itemUpdate">Add An Item</Button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray;margin-top: 20px;">
                                <h4 style="margin-top: 20px;margin-bottom: 20px;">Pricing Fee:</h4>
                                <div class="form-group row  main-input {{ $errors->has('pickup_fee') ? 'has-error' : '' }}">
                                    <label class="col-2">Pickup fee<span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                    <div class="col-4">
                                        {{ Form::number('pickup_fee', null, ['class' => 'form-control form-control-solid','id'=>'pickup_fee','placeholder'=>'Enter pickup fee here','name'=>'pickup_fee','required'=>'true','autocomplete'=>'off']) }}
                                        <span class="text-danger">{{ $errors->first('pickup_fee') }}</span>
                                    </div>
                                    <label class="col-2">Delivery Fee<span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                    <div class="col-4">
                                        {{ Form::number('delivery_fee', null, ['class' => 'form-control form-control-solid','id'=>'delivery_fee','placeholder'=>'Enter Delivery fee here','required'=>'true','step'=>'0','name'=>'delivery_fee']) }}
                                        <span class="text-danger">{{ $errors->first('delivery_fee') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row  main-input">

                                    <label class="col-2">Con Fee<span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                    <div class="col-4">
                                        {{ Form::number('con_fee', null, ['class' => 'form-control form-control-solid','id'=>'con_fee','placeholder'=>'Enter Con fee here','required'=>'true','step'=>'0','name'=>'con_fee']) }}
                                        <span class="text-danger">{{ $errors->first('con_fee') }}</span>
                                    </div>
                                    <label class="col-2">Fuel Levy<span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                    <div class="col-4">
                                        {{ Form::number('fuel_levy', null, ['class' => 'form-control form-control-solid','id'=>'fuel_levy','placeholder'=>'Enter Fuel Levy here','required'=>'true','step'=>'0','name'=>'fuel_levy']) }}
                                        <span class="text-danger">{{ $errors->first('fuel_levy') }}</span>
                                    </div>

                                </div>
                                <div class="form-group row main-input">

                                    <label class="col-2">Futile Pickup Fee<span
                                                style="color: red;font-size: 15px;">*</span>:</label>
                                    <div class="col-4">
                                        {{ Form::number('futile_pickup_fee', null, ['class' => 'form-control form-control-solid','id'=>'futile_pickup_fee','placeholder'=>'Enter futile pickup fee here','required'=>'true','step'=>'0','name'=>'futile_pickup_fee']) }}
                                        <span class="text-danger">{{ $errors->first('futile_pickup_fee') }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-1"></div>
                    </div>

                </div>

                {{Form::close()}}
                <!--end::Form-->
            </div>

            {{-- weight modal--}}
            <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg" id="exampleModal"
                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Price By Weight</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="price_by_w_id">
                            <div id="modal_body">
                            </div>
                            <button class="form-control btn btn-sm btn-primary"
                                onclick="javascript:void(0);add_w_modal_item();">Add another Item</Button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary close_modal" onclick="javascript:void(0);">Save
                                & Close</button>
                            <button type="button" class="btn btn-primary w_close_mod"
                                onclick="javascript:void(0);">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{--Price by PL SPC modal--}}
            <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg"
                id="spcexampleModal" tabindex="-1" role="dialog" aria-labelledby="spcexampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="spcexampleModalLabel">Add Price By PI SPC</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="price_by_spc_id">
                            <div id="spcmodal_body">
                            </div>
                            <button class="form-control btn btn-sm btn-primary"
                                onclick="javascript:void(0);add_spc_modal_item();">Add another Item</Button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary spc_close_modal"
                                onclick="javascript:void(0);">Save & Close</button>
                            <button type="button" class="btn btn-primary p_close_mod"
                                onclick="javascript:void(0);">Close</button>
                        </div>
                    </div>
                </div>
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
function add_w_modal_item() {
    var last_to_val = $('#price_by_w_table tr').last().find($("[name='wto[]']")).val();
    var cost_val = $('#price_by_w_table tr').last().find($("[name='wcost[]']")).val();
    if (last_to_val && cost_val) {
        $('#price_by_w_table tr').find($("[name='wto[]']")).prop('disabled', true);
        last_to_val++;
        var last_to_val_plus = last_to_val;
        last_to_val_plus++;
        var new_item_row = '<tr> <td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
            last_to_val + '" disabled>\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="wto[]" aria-describedby="tinputGroup-sizing-sm" min="' +
            last_to_val + '">\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="wcost[]" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td><input type="button"class="btn btn-sm btn-danger item_close_btn" value="X"></td></tr>';
        $("#price_by_w_table tbody").append(new_item_row);
    } else {
        alert('Please fill out missing field');
    }
    $("body").on("click", ".item_close_btn", function() {
        $(this).parent().parent().remove();
    });
}

function add_spc_modal_item() {
    var last_to_val = $('#price_by_spc_table tr').last().find($("[name='spcto[]']")).val();
    var cost_val = $('#price_by_spc_table tr').last().find($("[name='spccost[]']")).val();
    if (last_to_val && cost_val) {
        $('#price_by_spc_table tr').find($("[name='spcto[]']")).prop('disabled', true);
        last_to_val++;
        var last_to_val_plus = last_to_val;
        last_to_val_plus++;
        var new_item_row = '<tr> <td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="spcfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
            last_to_val + '" disabled>\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="spcto[]" aria-describedby="tinputGroup-sizing-sm" min="' +
            last_to_val + '">\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td>\n' +
            '<div class="input-group input-group-sm mb-3">\n' +
            '<input type="number" class="form-control" aria-label="Small" name="spccost[]" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
            '<div class="input-group-prepend">\n' +
            '<span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
            '</div>\n' +
            '</div>\n' +
            '</td>\n' +
            '<td><input type="button"class="btn btn-sm btn-danger item_close_btn" value="X"></td></tr>';
        $("#price_by_spc_table tbody").append(new_item_row);
    } else {
        alert('Please fill out missing field');
    }
    $("body").on("click", ".item_close_btn", function() {
        Swal.fire({
            icon: 'warning',
            title: 'Are You Sure',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Removing price detail!',
                    showConfirmButton: false,
                    timer: 1500,
                })
                $(this).parent().parent().remove();
            }
        });
    });
}

var item_row_no = 0;
var from_text = "";
var to_text = "";

function myNewFunction(sel) {
    from_text = sel.options[sel.selectedIndex].text;
}

function toFunction(sel) {
    to_text = sel.options[sel.selectedIndex].text;
}

$(function() {

    var parentTable = [];
    $('#itemUpdate').on('click', function() {
        event.preventDefault();
        if ($("#item_type").val() != '' && $("#from").val() != '' && $("#to").val() != '') {

            var reverse_price_val = '';
            if ($('#reversal_pricing').prop('checked')) {
                reverse_price_val = "Yes";
            } else {
                reverse_price_val = "No";
            }
            item_row_no = Math.random();

            var item_type_val = $("#item_type").val();
            var from_val = $("#from").val();

            var to_val = $("#to").val();
            var discount_val = $("#discount_item").val();


            let item_random_no_row =
                "<input type='hidden' id='random_no_id' name='random_no[]' value='" + item_row_no +
                "'>";
            let item_type = "<input type='hidden' name='item_type[]' value='" + item_type_val + "'>";
            let from = "<input type='hidden' name='from[]'value='" + from_val + "'>";
            let to = "<input type='hidden' name='to[]'value='" + to_val + "'>";
            let discount_item = "<input type='hidden' name='discount_item[]'value='" + discount_val +
                "'>";
            let reversal_pricing = "<input type='hidden' name='reversal_pricing[]'value='" +
                reverse_price_val + "'>";

            if ($("#itemtable tbody").length == 0) {
                $("#itemtable").append("<tbody></tbody>");
            }



            // Append product to the table
            $("#itemtable tbody").append("<tr>" +
                "<td>" + item_type + item_random_no_row + item_type_val + "</td>" +
                "<td>" + from + from_text + "</td>" +
                "<td>" + to + to_text + "</td>" +
                "<td>" + discount_item + discount_val + "%</td>" +
                "<td>" + reversal_pricing + reverse_price_val + "</td>" +
                "<td style='width: 250px;'>" +
                "<button class='btn btn-primary btn-xs show_modal' onclick='event.preventDefault();'>by weight</button>" +
                "<button style='margin-left: 10px' class='btn btn-primary btn-xs show_modal_spc' onclick='event.preventDefault();'>by plt spc</button>" +
                "</td>" +
                "<td>" +
                "<a class='btn btn-sm btn-clean btn-icon remove_price_detail' title='Delete Item' href='javascript:void(0)'><i class='icon-1x text-dark-50 flaticon-delete'></i> </a> " +
                "</td>" +
                "</tr>");

            // Clear form fields
            formClear();

            // Focus to product name field
            $("#item_type").focus();

            $("body").on("click", ".remove_price_detail", function() {
                $(this).parent().parent().remove();
            });
            $('.price-form').removeClass('was-validated');
            $('#item_div').removeClass('border border-danger');
            $('#item_div').addClass('border border-grey');
        } else {
            $('.price-form').addClass('was-validated');
        }
    });

    function formClear() {
        $("#item_type").val("");
        $("#from").val("");
        $("#to").val("");
        $("#discount").val("");
        $("#reversal_pricing").val("");

    }
});

var price_by_weight = [];
var price_by_SPC = [];
var last_from = 0;

    function onSave(){
        event.preventDefault();
        let arr=["company_title", "pickup_fee", "delivery_fee", "con_fee","fuel_levy","futile_pickup_fee"];
        var wineId=[];
        let allArr = arr.map(function(element){
            wineId.push($('input[name="'+element+'"]').val());
        })


        var rowCount = $('#itemtable tr').length;
        console.log("count", rowCount);
        console.log(price_by_weight);

        $('button.show_modal').removeClass('border border-danger');
        $('button.show_modal_spc').removeClass('border border-danger');
        $('#itemtable tbody tr').removeClass('border border-danger');

        if(rowCount==1){
            swal({
                title: "Alert!",
                text: "Please add the pricing items",
                icon: "warning",
            });

            $('#item_div').addClass('border border-danger');
            // $('.price-form').addClass('was-validated');
        }else{
            // if(price_by_weight.length<rowCount-1 || price_by_SPC.length<rowCount-1){
            //     swal({
            //         title: "Alert!",
            //         text: "Please add price by plt spc and weight",
            //         icon: "warning",
            //     });

            //     $('#itemtable tbody tr').each(function (index) {
            //         row_no = $(this).find('#random_no_id').val();
            //         if(price_by_weight.filter(e=>e.row_no==row_no).length<1){
            //             $(this).find('button.show_modal').addClass('border border-danger');
            //             // $(this).addClass('border border-danger');
            //         }
            //         if(price_by_SPC.filter(e=>e.row_no==row_no).length<1){
            //             $(this).find('button.show_modal_spc').addClass('border border-danger');
            //             // $(this).addClass('border border-danger');
            //         }
            //     });
            //     return;
            // }


            if(wineId.findIndex(e=> e=='')>=0){
                swal({
                    title: "Alert!",
                    text: "Please input your required information",
                    icon: "warning",
                });
                $('.main-input').addClass("was-validated");
            }else{
                // document.getElementById('client_add_form').submit();
            }

        }



    }

//add price by weight start
$("body").on("click", ".show_modal", function() {
    var random_no = $(this).parent().parent().find('td:first-child').find('#random_no_id').val();
    var rowscollect = [];
    for (var i = 0; i < price_by_weight.length; i++) {
        if (price_by_weight.length > 0 && price_by_weight[i]['row_no'] == random_no) {
            for (var y = 0; y < price_by_weight[i]['w_from'].length; y++) {
                var pre_rows = '';
                if (y === 0) {
                    pre_rows = '                                            <tr>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_from" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
                        price_by_weight[i]['w_from'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_to" aria-label="Small" name="wto[]" value="' +
                        price_by_weight[i]['w_to'][y] + '" aria-describedby="tinputGroup-sizing-sm" min="' +
                        price_by_weight[i]['w_from'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_cost" aria-label="Small" name="wcost[]" value="' +
                        price_by_weight[i]['w_cost'][y] +
                        '" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                            </tr>';
                    rowscollect.push(pre_rows);
                } else {
                    pre_rows = '                                            <tr>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_from" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
                        price_by_weight[i]['w_from'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_to" aria-label="Small" name="wto[]" value="' +
                        price_by_weight[i]['w_to'][y] + '" aria-describedby="tinputGroup-sizing-sm" min="' +
                        price_by_weight[i]['w_from'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="w_cost" aria-label="Small" name="wcost[]" value="' +
                        price_by_weight[i]['w_cost'][y] +
                        '" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '<td><input type="button" class="btn btn-sm btn-danger item_close_btn" value="X"></td>\n' +
                        '                                            </tr>';
                    rowscollect.push(pre_rows);
                }
                last_from = price_by_weight[i]['w_to'][y];
                //$('#modal_form').prepend(pre_rows);
            }
        }
    }
    var close_button = '';
    if (rowscollect) {
        close_button = '<td><input type="button"class="btn btn-sm btn-danger item_close_btn" value="X"></td>';
    }
    var modal_table = '<div class="container-fluid border border-gray">\n' +
        '                                    <table class="table table-responsive-sm" id=\'price_by_w_table\' style="margin-top: 20px;">\n' +
        '                                        <thead class="thead-light">\n' +
        '                                        <tr>\n' +
        '                                            <th>From</th>\n' +
        '                                            <th>To</th>\n' +
        '                                            <th>Cost</th>\n' +
        '                                            <th>Remove</th>\n' +
        '                                        </tr>\n' +
        '                                        </thead>\n' +
        '                                        <tbody>\n' +
        '                                        <form id="modal_form">\n' +
        '                                            <input type="hidden" id="row_no" name="row_no" value="' +
        random_no + '">\n' +
        rowscollect +
        '                                            <tr>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="w_from" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
        last_from + '" disabled>\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                            <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="w_to" aria-label="Small" name="wto[]" aria-describedby="tinputGroup-sizing-sm" min="' +
        (last_from + 1) + '">\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                            <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="w_cost" aria-label="Small" name="wcost[]" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        close_button +
        '                                            </tr>\n' +
        '                                        </form>\n' +
        '                                        </tbody>\n' +
        '                                    </table>\n' +
        '                                </div>';
    $('#modal_body').append(modal_table);
    $('#exampleModal').modal('show');
    $("body").on("click", ".item_close_btn", function() {
        $(this).parent().parent().remove();
    });
});
$("body").on("click", ".close_modal", function() {
    var last_to_val = $('#price_by_w_table tr').last().find($("[name='wto[]']")).val();
    var cost_val = $('#price_by_w_table tr').last().find($("[name='wcost[]']")).val();
    if (last_to_val && cost_val) {
        var formdata = $(this).parent().parent().find('div#price_by_w_id');
        var row_random_no = formdata.find('#row_no').val();
        var w_from = $("input[name='wfrom[]']")
            .map(function() {
                return $(this).val();
            }).get();
        var w_to = $("input[name='wto[]']")
            .map(function() {
                return $(this).val();
            }).get();
        var w_cost = $("input[name='wcost[]']")
            .map(function() {
                return $(this).val();
            }).get();
        for (var i = 0; i < price_by_weight.length; i++) {
            if (price_by_weight.length > 0 && price_by_weight[i]['row_no'] === row_random_no) {
                price_by_weight.splice(i, i + 1);
            }
        }
        //console.log(typeof w_form);
        var w_array = {
            'row_no': row_random_no,
            'w_from': w_from,
            'w_to': w_to,
            'w_cost': w_cost,
        };
        price_by_weight.push(w_array);
        $('#modal_body').html('');
        $('#exampleModal').modal('hide');
        console.log(price_by_weight);
    } else {
        alert('Please fill out missing field');
    }
});
$("body").on("click", ".w_close_mod", function() {
    $('#modal_body').html('');
    $('#exampleModal').modal('hide');
});
//add price by weight end
///////////////////////////////////////////////
//Price by PL SPC start
var spc_last_from = 0;
$("body").on("click", ".show_modal_spc", function() {
    var random_no = $(this).parent().parent().find('td:first-child').find('#random_no_id').val();
    var rowscollect = [];
    for (var i = 0; i < price_by_SPC.length; i++) {
        if (price_by_SPC.length > 0 && price_by_SPC[i]['row_no'] == random_no) {
            for (var y = 0; y < price_by_SPC[i]['spc_form'].length; y++) {
                var pre_rows = '';
                if (y === 0) {
                    pre_rows = '<tr>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_form" aria-label="Small" name="spcfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
                        price_by_SPC[i]['spc_form'][y] + '" disabled>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_to" aria-label="Small" name="spcto[]" aria-describedby="tinputGroup-sizing-sm" min="1"  value="' +
                        price_by_SPC[i]['spc_to'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_cost" aria-label="Small" name="spccost[]" aria-describedby="cinputGroup-sizing-sm" min="1" value="' +
                        price_by_SPC[i]['spc_cost'][y] + '">\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                            </tr>';
                    rowscollect.push(pre_rows);
                } else {
                    pre_rows = '<tr>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_form" aria-label="Small" name="spcfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
                        price_by_SPC[i]['spc_form'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_to" aria-label="Small" name="spcto[]" aria-describedby="tinputGroup-sizing-sm" min="1"  value="' +
                        price_by_SPC[i]['spc_to'][y] + '" disabled>\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '                                                <td>\n' +
                        '                                                    <div class="input-group input-group-sm mb-3">\n' +
                        '                                                        <input type="number" class="form-control" id="spc_cost" aria-label="Small" name="spccost[]" aria-describedby="cinputGroup-sizing-sm" min="1" value="' +
                        price_by_SPC[i]['spc_cost'][y] + '">\n' +
                        '                                                        <div class="input-group-prepend">\n' +
                        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </div>\n' +
                        '                                                </td>\n' +
                        '<td><input type="button" class="btn btn-sm btn-danger item_close_btn" value="X"></td>\n' +
                        '                                            </tr>';
                    rowscollect.push(pre_rows);
                }
                spc_last_from = price_by_SPC[i]['spc_to'][y];
                //$('#modal_form').prepend(pre_rows);
            }
        }
    }
    var close_button = '';
    if (rowscollect) {
        close_button = '<td><input type="button"class="btn btn-sm btn-danger item_close_btn" value="X"></td>';
    }
    var modal_table = '<div class="container-fluid border border-gray">\n' +
        '                                    <table class="table table-responsive-sm" id=\'price_by_spc_table\' style="margin-top: 20px;">\n' +
        '                                        <thead class="thead-light">\n' +
        '                                        <tr>\n' +
        '                                            <th>From</th>\n' +
        '                                            <th>To</th>\n' +
        '                                            <th>Cost</th>\n' +
        '                                            <th>Remove</th>\n' +
        '                                        </tr>\n' +
        '                                        </thead>\n' +
        '                                        <tbody>\n' +
        '                                        <form id="modal_form">\n' +
        '                                            <input type="hidden" id="row_no" name="spc_row_no" value="' +
        random_no + '">\n' +
        rowscollect +
        '                                            <tr>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="spc_form" aria-label="Small" name="spcfrom[]" aria-describedby="inputGroup-sizing-sm" value="' +
        spc_last_from + '" disabled>\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="spc_to" aria-label="Small" name="spcto[]" aria-describedby="tinputGroup-sizing-sm" min="' +
        (spc_last_from + 1) + '">\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        '                                                <td>\n' +
        '                                                    <div class="input-group input-group-sm mb-3">\n' +
        '                                                        <input type="number" class="form-control" id="spc_cost" aria-label="Small" name="spccost[]" aria-describedby="cinputGroup-sizing-sm" min="1">\n' +
        '                                                        <div class="input-group-prepend">\n' +
        '                                                            <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
        '                                                        </div>\n' +
        '                                                    </div>\n' +
        '                                                </td>\n' +
        close_button +
        '                                            </tr>\n' +
        '                                        </form>\n' +
        '                                        </tbody>\n' +
        '                                    </table>\n' +
        '                                </div>';
    $('#spcmodal_body').append(modal_table);
    $('#spcexampleModal').modal('show');
    $("body").on("click", ".item_close_btn", function() {
        $(this).parent().parent().remove();
    });
});
$("body").on("click", ".spc_close_modal", function() {
    var last_to_val = $('#price_by_spc_table tr').last().find($("[name='spcto[]']")).val();
    var cost_val = $('#price_by_spc_table tr').last().find($("[name='spccost[]']")).val();
    if (last_to_val && cost_val) {
        var formdata = $(this).parent().parent().find('div#price_by_spc_id');
        var row_random_no = formdata.find('#row_no').val();
        var spc_form = $("input[name='spcfrom[]']")
            .map(function() {
                return $(this).val();
            }).get();
        var spc_to = $("input[name='spcto[]']")
            .map(function() {
                return $(this).val();
            }).get();
        var spc_cost = $("input[name='spccost[]']")
            .map(function() {
                return $(this).val();
            }).get();
        for (var i = 0; i < price_by_SPC.length; i++) {
            if (price_by_SPC.length > 0 && price_by_SPC[i]['row_no'] === row_random_no) {
                price_by_SPC.splice(i, i + 1);
            }
        }
        //console.log(typeof w_form);
        var spc_array = {
            'row_no': row_random_no,
            'spc_form': spc_form,
            'spc_to': spc_to,
            'spc_cost': spc_cost,
        };
        price_by_SPC.push(spc_array);
        $('#spcmodal_body').html('');
        $('#spcexampleModal').modal('hide');
        console.log(price_by_SPC);
    } else {
        alert('Please fill out missing field');
    }
});
$("body").on("click", ".p_close_mod", function() {
    $('#spcmodal_body').html('');
    $('#spcexampleModal').modal('hide');
});
//Price by PL SPC end
//////////////////////////////////////////

function submit_form() {

    // var row_no = $("input[name='random_no[]']").map(function() {
    //     return $(this).val();
    // }).get();
    // var item_type = $("input[name='item_type[]']").map(function() {
    //     return $(this).val();
    // }).get();
    // var from = $("input[name='from[]']").map(function() {
    //     return $(this).val();
    // }).get();
    // var to = $("input[name='to[]']").map(function() {
    //     return $(this).val();
    // }).get();
    // var discount_item = $("input[name='discount_item[]']").map(function() {
    //     return $(this).val();
    // }).get();
    // var reversal_pricing = $("input[name='reversal_pricing[]']").map(function() {
    //     return $(this).val();
    // }).get();

    // if (!$("[name='company_title']").val()) {
    //     $("[name='company_title']").addClass('border border-danger ')
    //     return;
    // } else {
    //     $("[name='company_title']").removeClass('border border-danger ')
    // }

    // if(!$("[name='percentage']").val()){
    //     $("[name='percentage']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='percentage']").removeClass('border border-danger ')
    // }

    // if(!$("[name='pickup_fee']").val()){
    //     $("[name='pickup_fee']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='pickup_fee']").removeClass('border border-danger ')
    // }

    // if(!$("[name='delivery_fee']").val()){
    //     $("[name='delivery_fee']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='delivery_fee']").removeClass('border border-danger ')
    // }

    // if(!$("[name='con_fee']").val()){
    //     $("[name='con_fee']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='con_fee']").removeClass('border border-danger ')
    // }

    // if(!$("[name='fuel_levy']").val()){
    //     $("[name='fuel_levy']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='fuel_levy']").removeClass('border border-danger ')
    // }


    // if(!$("[name='futile_pickup_fee']").val()){
    //     $("[name='futile_pickup_fee']").addClass('border border-danger ')
    //     return;
    // }else{
    //     $("[name='futile_pickup_fee']").removeClass('border border-danger ')
    // }

    var data = {
        'company_title': $("[name='company_title']").val(),
        //'percentage' : $("[name='percentage']").val(),
        'pickup_fee': $("[name='pickup_fee']").val(),
        'delivery_fee': $("[name='delivery_fee']").val(),
        'con_fee': $("[name='con_fee']").val(),
        'fuel_levy': $("[name='fuel_levy']").val(),
        'futile_pickup_fee': $("[name='futile_pickup_fee']").val(),
        'pricing_detail': {
            'row_no': row_no,
            'item_type': item_type,
            'from': from,
            'to': to,
            'discount_item': discount_item,
            'reversal_pricing': reversal_pricing,
        },
        'Add_Price_By_Weight': price_by_weight,
        'Add_Price_By_SPC': price_by_SPC
    };

    $.ajax({
        /* the route pointing to the post function */
        url: '/admin/pricing',
        //url: '/admin/pricing/store',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {
            "_token": "{{ csrf_token() }}",
            'company_title': $("[name='company_title']").val(),
            //'percentage' : $("[name='percentage']").val(),
            'pickup_fee': $("[name='pickup_fee']").val(),
            'delivery_fee': $("[name='delivery_fee']").val(),
            'con_fee': $("[name='con_fee']").val(),
            'fuel_levy': $("[name='fuel_levy']").val(),
            'futile_pickup_fee': $("[name='futile_pickup_fee']").val(),
            'p_row_no': row_no,
            'p_row_item_type': item_type,
            'p_row_from': from,
            'p_row_to': to,
            'p_row_discount_item': discount_item,
            'p_row_reversal_pricing': reversal_pricing,
            'Add_Price_By_Weight': price_by_weight,
            'Add_Price_By_SPC': price_by_SPC
        },
        /* remind that 'data' is the response of the AjaxController */
        success: function(data) {
            if (data) {
                Swal.fire({
                    icon: 'success',
                    title: data,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Refreshing the page!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        location.reload();
                    }
                });
            }
        }
    });
}
</script>
<script>
// Class definition
var KTSelect2 = function() {
    // Private functions
    var demos = function() {
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

<script>

</script>
@endsection
