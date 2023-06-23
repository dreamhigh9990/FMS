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
                                <a href="" class="text-muted">Edit Pricing</a>
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
                            <h3 class="card-label">Pricing Edit Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small></h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('pricing.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a  onclick="onSave();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Save</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                    @include('admin.partials._messages')
                    <!--begin::Form-->

                        <form class="form "  id="client_add_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row validate-form">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-10">
                                    <div>
                                        <h3 class="text-dark font-weight-bold mb-10">Pricing Info: </h3>

                                        <div class="form-group row  main-input">
                                            <div class="col-lg-6">
                                                <label><strong>Title </strong><span style="color: red;font-size: 15px;">*</span>:</label>
                                                <input type="text" name="company_title" id="company_title" class="form-control" placeholder="Enter company title" value="" required/>
                                            </div>

                                            <div class="col-lg-6"><label></label>
                                                <div class="input-group" style="margin-top: 6px;">
                                                    <input type="text" class="form-control" name="percentage" id="percentage" aria-describedby="button-addon2" value="">
                                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Update all price by (%)</button>
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
                                                <tbody id="priceDetails">

                                                </tbody>
                                            </table>
                                        </div>
                                        {{--item-table-end--}}

                                        <div style="border: solid lightgray 1px; padding: 20px;border-radius: 5px; margin-top: 20px;">

                                            <div class="price-form form-group row">
                                                <div class="col-lg-4">
                                                    <label>Item Type:<span style="color: red;font-size: 15px;">*</span></label>
                                                    <select class="form-control select2_1" id="item_type" required>
                                                        <option value="">Select a Item</option>
                                                        @foreach($items as $item)
                                                            <option value="{{$item->id}}">{{$item->item_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback" >Please select this field.</div>
                                                </div>
                                                <div class="col-lg-4" >
                                                    <label>From:<span style="color: red;font-size: 15px;">*</span></label>
                                                    <select class="form-control select2_2" id="from" onChange="myNewFunction(this);" required>
                                                        <option value="">Select a Branch</option>
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->branches}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback" >Please select this field.</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>To:<span style="color: red;font-size: 15px;">*</span></label>
                                                    <select class="form-control select2_3" id="to" onChange="toFunction(this);" required>
                                                        <option value="">Select a Branch</option>
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
                                                    <input type="number" class="form-control"
                                                           id="discount_item" min="1"/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Reversal Price Applied:</label>
                                                    <div class="col-3">
                                                        <span class="switch switch-icon">
                                                            <label>
                                                            <input type="checkbox"
                                                                class="form-control" id="reversal_pricing"/>
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


                                        <hr style="height:2px;border-width:0;color:lightgray;background-color:lightgray;margin-top: 20px;">
                                        <h4 style="margin-top: 20px;margin-bottom: 20px;">Pricing Fee:</h4>
                                        <div class="form-group row  main-input ">
                                            <label class="col-2">Pickup fee</label>
                                            <div class="col-4">
                                                {{ Form::number('pickup_fee', '', ['class' => 'form-control form-control-solid','id'=>'pickup_fee','placeholder'=>'Enter pickup fee here','name'=>'pickup_fee','step'=>'0','required'=>'true']) }}

                                            </div>
                                            <label class="col-2">Delivery Fee</label>
                                            <div class="col-4">
                                                {{ Form::number('delivery_fee', '', ['class' => 'form-control form-control-solid','id'=>'delivery_fee','placeholder'=>'Enter Delivery fee here','required'=>'true','step'=>'0','name'=>'delivery_fee']) }}

                                            </div>
                                        </div>
                                        <div class="form-group row  main-input ">

                                            <label class="col-2">Con Fee</label>
                                            <div class="col-4">
                                                {{ Form::number('con_fee', '', ['class' => 'form-control form-control-solid','id'=>'con_fee','placeholder'=>'Enter Con fee here','required'=>'true','step'=>'0','name'=>'con_fee']) }}

                                            </div>
                                            <label class="col-2">Fuel Levy</label>
                                            <div class="col-4">
                                                {{ Form::number('fuel_levy', '', ['class' => 'form-control form-control-solid','id'=>'fuel_levy','placeholder'=>'Enter Fuel Levy here','required'=>'true','step'=>'0','name'=>'fuel_levy']) }}

                                            </div>

                                        </div>
                                        <div class="form-group row  main-input ">

                                            <label class="col-2">Futile Pickup Fee</label>
                                            <div class="col-4">
                                                {{ Form::number('futile_pickup_fee', '', ['class' => 'form-control form-control-solid','id'=>'futile_pickup_fee','placeholder'=>'Enter futile pickup fee here','required'=>'true','step'=>'0','name'=>'futile_pickup_fee']) }}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-1"></div>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>
                </div>

                <div data-backdrop="static" data-keyboard="true" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                    <div class="container-fluid border border-gray">
                                        <table class="table table-responsive-sm" id='price_by_w_table' style="margin-top: 20px;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Cost</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <button class="form-control btn btn-sm btn-primary" onclick="javascript:void(0);add_w_modal_item();">Add another Item</Button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary close_modal"onclick="javascript:void(0);">Save & Close</button>
                                <button type="button" class="btn btn-primary w_close_mod"onclick="javascript:void(0);">Close</button>
                            </div>

                        </div>

                    </div>
                </div>

                {{--                Price by PL SPC modal--}}
                <div data-backdrop="static" data-keyboard="true" class="modal fade bd-example-modal-lg" id="spcexampleModal" tabindex="-1" role="dialog" aria-labelledby="spcexampleModalLabel" aria-hidden="true">
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
                                    <div class="container-fluid border border-gray">
                                        <table class="table table-responsive-sm" id='price_by_spc_table' style="margin-top: 20px;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Cost</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button class="form-control btn btn-sm btn-primary" onclick="javascript:void(0);add_spc_modal_item();">Add another Item</Button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary spc_close_modal"onclick="javascript:void(0);">Save & Close</button>
                                <button type="button" class="btn btn-primary p_close_mod"onclick="javascript:void(0);">Close</button>
                            </div>

                        </div>

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

        function myNewFunction(sel) {
            from_text = sel.options[sel.selectedIndex].text;
        }

        function toFunction(sel) {
            to_text = sel.options[sel.selectedIndex].text;
        }

        $(function () {

            var parentTable = [];
            // Add new price detail.
            $('#itemUpdate').on('click', function () {
                event.preventDefault();
                if ($("#item_type").val() != '' && $("#from").val() != '' && $("#to").val() != '') {

                    var reverse_price_val =  '';
                    if( $('#reversal_pricing').prop('checked')){
                        reverse_price_val = "Yes";
                    }else{
                        reverse_price_val = "No";
                    }
                    item_row_no = Math.random();

                    var item_type_val = $("#item_type").val();
                    var from_val = $("#from").val();
                    var to_val = $("#to").val();
                    var discount_val = $("#discount_item").val();

                    pricing.price_detail.push({
                        discount_for_item: discount_val,
                        from_address: from_val,
                        to_address: to_val,
                        id: Math.floor(Math.random()*100000000),
                        item_type_id: item_type_val,
                        price_by_spc: '[]',
                        price_by_weight: '[]',
                        price_id: priceId,
                        reversal_pricing: reverse_price_val
                    });

                    showDetails();

                    if ($("#itemtable tbody").length == 0) {
                        $("#itemtable").append("<tbody></tbody>");
                    }

                    // Clear form fields
                    formClear();

                    // Focus to product name field
                    $("#item_type").focus();



                    $('.price-form').removeClass('was-validated');
                    $('#item_div').removeClass('border border-danger');
                    $('#item_div').addClass('border border-grey');

                }else{
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


        function onSave(){
            event.preventDefault();
            let arr=["company_title", "pickup_fee", "delivery_fee", "con_fee","fuel_levy","futile_pickup_fee"];
            var wineId=[];
            let allArr = arr.map(function(element){
                wineId.push($('input[name="'+element+'"]').val());
            })

            var rowCount = $('#itemtable tr').length;

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

                if(wineId.findIndex(e=> e=='')>=0){
                    swal({
                        title: "Alert!",
                        text: "Please input your required information",
                        icon: "warning",
                    });
                    $('.main-input').addClass("was-validated");
                }else{
                    pricing.title = $('#company_title').val();
                    pricing.discount = $('#percentage').val();
                    pricing.pickup_fee = $('#pickup_fee').val();
                    pricing.delivery_fee = $('#delivery_fee').val();
                    pricing.con_fee = $('#con_fee').val();
                    pricing.fuel_levy = $('#fuel_levy').val();
                    pricing.futile_pickup_fee = $('#futile_pickup_fee').val();

                    $.ajax({
                        url: `{{route('pricing.store')}}`,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "pricing": JSON.stringify(pricing)
                        },
                        success: function (data) {
                            if (data) {
                                Swal.fire({
                                    icon: data.status?'success':'warning',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                })
                            }
                        }
                    });
                }

            }
        }

        function updateWeights(){
            curWeights.sort((a,b)=>a.from-b.from);

            $("#price_by_w_table tbody").html("");


            curWeights.map(weight=>{
                $("#price_by_w_table tbody").append('  <tr>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_from" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="'+weight.from+'"disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_to" aria-label="Small" name="wto[]" value="'+weight.to+'" aria-describedby="tinputGroup-sizing-sm" min="1" disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_cost" aria-label="Small" name="wcost[]" value="'+weight.cost+'" aria-describedby="cinputGroup-sizing-sm" min="1" disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td><input type="button" class="btn btn-sm btn-danger witem_close_btn" value="X"></td>\n'+
                            ' </tr>');
            });


            $("#price_by_w_table tbody").append('  <tr id="curWeightCell">\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_from" aria-label="Small" name="wfrom[]" aria-describedby="inputGroup-sizing-sm" value="'+ (curWeights.length?(curWeights[curWeights.length-1].to+1):0)+'">\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_to" aria-label="Small" name="wto[]" value="" aria-describedby="tinputGroup-sizing-sm" min="1" >\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="w_cost" aria-label="Small" name="wcost[]" value="" aria-describedby="cinputGroup-sizing-sm" min="1" >\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            ' </tr>');

        }

        function updateSpcs(){
            curSpcs.sort((a,b)=>a.from-b.from);
            $("#price_by_spc_table tbody").html("");
            curSpcs.map(spc=>{
                $("#price_by_spc_table tbody").append('  <tr>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_from" aria-label="Small" aria-describedby="inputGroup-sizing-sm" value="'+spc.from+'"disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="inputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_to" aria-label="Small"  value="'+spc.to+'" aria-describedby="tinputGroup-sizing-sm" min="1" disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="tinputGroup-sizing-sm">KG</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_cost" aria-label="Small" value="'+spc.cost+'" aria-describedby="cinputGroup-sizing-sm" min="1" disabled>\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td><input type="button" class="btn btn-sm btn-danger sitem_close_btn" value="X"></td>\n'+
                            ' </tr>');
            });


            $("#price_by_spc_table tbody").append('  <tr id="curSpcCell">\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_from" aria-label="Small"  aria-describedby="inputGroup-sizing-sm" value="'+ (curSpcs.length?(curSpcs[curSpcs.length-1].to+1):0)+'">\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="inputGroup-sizing-sm">Spc</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_to" aria-label="Small" value="" aria-describedby="tinputGroup-sizing-sm" min="1" >\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="tinputGroup-sizing-sm">Spc</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            '   <td>\n' +
                            '       <div class="input-group input-group-sm mb-3">\n' +
                            '           <input type="number" class="form-control" id="spc_cost" aria-label="Small" value="" aria-describedby="cinputGroup-sizing-sm" min="1" >\n' +
                            '           <div class="input-group-prepend">\n' +
                            '               <span class="input-group-text" id="cinputGroup-sizing-sm">$</span>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '   </td>\n' +
                            ' </tr>');

        }





        function add_w_modal_item(){
            if($('#curWeightCell #w_from').val()!='' && $('#curWeightCell #w_to').val()!='' && $('#curWeightCell #w_cost').val()!='' &&
            parseInt($('#curWeightCell #w_from').val()) <parseInt($('#curWeightCell #w_to').val())
            ){
                curWeights.push({
                    from: parseInt($('#curWeightCell #w_from').val()),
                    to: parseInt($('#curWeightCell #w_to').val()),
                    cost: parseFloat($('#curWeightCell #w_cost').val())
                });
                updateWeights();

            }else{
                swal({
                    title: "Alert!",
                    text: "Please input valid values!",
                    icon: "warning",
                });
            }
        }




        function add_spc_modal_item(){
            if($('#curSpcCell #spc_from').val()!='' && $('#curSpcCell #spc_to').val()!='' && $('#curSpcCell #spc_cost').val()!='' &&
            parseInt($('#curSpcCell #spc_from').val()) <parseInt($('#curSpcCell #spc_to').val())
            ){
                curSpcs.push({
                    from: parseInt($('#curSpcCell #spc_from').val()),
                    to: parseInt($('#curSpcCell #spc_to').val()),
                    cost: parseFloat($('#curSpcCell #spc_cost').val())
                });
                updateSpcs();

            }else{
                swal({
                    title: "Alert!",
                    text: "Please input valid values!",
                    icon: "warning",
                });
            }
        }

        //show weight modal
        $("body").on("click",".show_modal",function () {
            curDetailId = $(this).parent().parent().find(".item_no").val();
            curWeights = JSON.parse(pricing.price_detail.filter(e=>e.id==curDetailId)[0].price_by_weight);
            updateWeights();

            $('#exampleModal').modal('show');
        });


        // save and close weight modal
        $("body").on("click",".close_modal",function () {
            pricing.price_detail = pricing.price_detail.map(detail=>{
                if(detail.id == curDetailId){
                    detail.price_by_weight = JSON.stringify(curWeights);
                }
                return detail;
            });
            $('#exampleModal').modal('hide');
        });

        // remove weight item
        $("body").on("click",".witem_close_btn",function () {
            curWeights = curWeights.filter(e=> !(e.from==$(this).parent().parent().find("#w_from").val()
            && e.to==$(this).parent().parent().find("#w_to").val()
            && e.cost==$(this).parent().parent().find("#w_cost").val())
            )
            updateWeights();
        });


        // close weight modal
        $("body").on("click",".w_close_mod",function () {
            $('#exampleModal').modal('hide');
        });

        // show spc modal
        $("body").on("click",".show_modal_spc",function () {

            curDetailId = $(this).parent().parent().find(".item_no").val();
            curSpcs = JSON.parse(pricing.price_detail.filter(e=>e.id==curDetailId)[0].price_by_spc);
            updateSpcs();

            $('#spcexampleModal').modal('show');
        });

        //save and close spc modal
        $("body").on("click",".spc_close_modal",function () {

            pricing.price_detail = pricing.price_detail.map(detail=>{
                if(detail.id == curDetailId){
                    detail.price_by_spc = JSON.stringify(curSpcs);
                }
                return detail;
            });
            $('#spcexampleModal').modal('hide');
        });

        // remove weight item
        $("body").on("click",".sitem_close_btn",function () {
            curSpcs = curSpcs.filter(e=> !(e.from==$(this).parent().parent().find("#spc_from").val()
            && e.to==$(this).parent().parent().find("#spc_to").val()
            && e.cost==$(this).parent().parent().find("#spc_cost").val())
            )
            updateSpcs();
        });

        // close spc modal
        $("body").on("click",".p_close_mod",function () {
            $('#spcexampleModal').modal('hide');
        });

        $("body").on("click",".remove_price_detail",function () {

            Swal.fire({
                icon: 'warning',
                title: 'Are you Sure',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon:'success',
                        title: 'Removing price detail!',
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    let pId = $(this).parent().parent().find(".item_no").val();
                    pricing.price_detail = pricing.price_detail.filter(e=>e.id!=pId);
                    showDetails();
                }
            });
        });



        //Price by PL SPC end
        //////////////////////////////////////////


    </script>
    <script>
        var pricing={};
        var branches=[];
        var items=[];
        var curWeights=[];
        var curSpcs=[];
        var curDetailId=0;
        var priceId=parseInt(`{{$id}}`);

        var showDetails = ()=>{
            $("#priceDetails").html("");
            if(pricing && pricing['price_detail']){

                pricing['price_detail'].map(detail=>{
                    let item_no = "<input type='hidden' class='item_no' value='"+ detail.id +"'>";
                    $("#itemtable tbody").append("<tr>" +
                        "<td>" + item_no +  items.filter(e=>e.id==detail.item_type_id)[0].item_name+ "</td>" +
                        "<td>" + branches.filter(e=>e.id==detail.from_address)[0].branches+ "</td>" +
                        "<td>" + branches.filter(e=>e.id==detail.to_address)[0].branches + "</td>" +
                        "<td>" + detail.discount_for_item +"%</td>" +
                        "<td>" + detail.reversal_pricing + "</td>" +
                        "<td style='width: 250px;'>" +
                        "<button class='btn btn-primary btn-xs show_modal' onclick='event.preventDefault();'>by weight</button>"+
                        "<button style='margin-left: 10px' class='btn btn-primary btn-xs show_modal_spc' onclick='event.preventDefault();'>by plt spc</button>"+ "</td>"+
                        "<td>" +
                        "<a class='btn btn-sm btn-clean btn-icon remove_price_detail' title='Delete Item' href='javascript:void(0)'><i class='icon-1x text-dark-50 flaticon-delete'></i> </a> " +
                        "</td>"+
                        "</tr>");
                })


            }

        }

        // Class definition
        var KTSelect2 = function () {
            var loadData = ()=>{
                $.ajax({
                    url: `{{route('admin.get_price_detail',$id)}}`,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        if (data) {
                            if (priceId){
                                pricing = data.Pricing;
                            }else{
                                priceId = Math.floor(Math.random()*100000000),
                                pricing = {
                                    id : priceId,
                                    con_fee: "",
                                    delivery_fee: "",
                                    discount: "",
                                    fuel_levy: "",
                                    futile_pickup_fee: "",
                                    pickup_fee: "",
                                    price_detail: [],
                                    title: "",
                                }
                            }

                            branches = data.branches;
                            items = data.items;

                            $('#company_title').val(pricing.title);
                            $('#percentage').val(pricing.discount);
                            $('#pickup_fee').val(pricing.pickup_fee);
                            $('#delivery_fee').val(pricing.delivery_fee);
                            $('#con_fee').val(pricing.con_fee);
                            $('#fuel_levy').val(pricing.fuel_levy);
                            $('#futile_pickup_fee').val(pricing.futile_pickup_fee);

                            showDetails();
                        }
                    }
                });
            }
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
                    loadData();
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

