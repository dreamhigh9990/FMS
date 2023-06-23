$("body").on("click",".open_invoice",function () {
    $('input[name="invoice_no"]').prop('disabled', false);
    $('#lock').removeClass('fa fa-lock').addClass('fas fa-lock-open');
    $(this).removeClass('open_invoice').addClass('close_invoice');
});

$("body").on("click",".close_invoice",function () {
    $('input[name="invoice_no"]').prop('disabled', true);
    $('#lock').removeClass('fas fa-lock-open').addClass('fa fa-lock');
    $(this).removeClass('close_invoice').addClass('open_invoice');
});

$('#datepicker').datepicker({
    rtl: KTUtil.isRTL(),
    todayHighlight: true,
    orientation: "bottom left"
});


$('#time_id').timepicker({
    rtl: KTUtil.isRTL(),
    todayHighlight: true,
    orientation: "bottom left"
});


var item_childs = [];

$("body").on("input","#item_qty",function(){
    var weight = $(this).parent().parent().parent().find("#item_weight").val();
    if(weight){
        var totalw = weight*$(this).val();
        $(this).parent().parent().parent().find("#item_tweight").val(totalw);
    }
});

$("body").on("input","#item_weight",function(){
    var weight = $(this).parent().parent().parent().find("#item_qty").val();
    if(weight){
        var totalw = weight*$(this).val();
        $(this).parent().parent().parent().find("#item_tweight").val(totalw);
    }
});

$("body").on("input","#item_length",function(){
    var item_width = $(this).parent().parent().parent().find("#item_width").val();
    var item_height = $(this).parent().parent().parent().find("#item_height").val();
    if(item_width && item_height){
        var cubicmeter = (item_width*item_height*$(this).val())/100;
        $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
    }
});

$("body").on("input","#item_width",function(){
    var item_width = $(this).parent().parent().parent().find("#item_length").val();
    var item_height = $(this).parent().parent().parent().find("#item_height").val();
    if(item_width && item_height){
        var cubicmeter = (item_width*item_height*$(this).val())/100;
        $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
    }
});

$("body").on("input","#item_height",function(){
    var item_width = $(this).parent().parent().parent().find("#item_length").val();
    var item_height = $(this).parent().parent().parent().find("#item_width").val();
    if(item_width && item_height){
        var cubicmeter = (item_width*item_height*$(this).val())/100;
        $(this).parent().parent().parent().find("#item_cubic_m3").val(cubicmeter);
    }
});

$("body").on("click",".close_item",function () {

});

$('.item_select').select2({
    placeholder: "Select a type"
});







$("body").on("click",".remove-item",function () {
    $(this).parent().parent().parent().remove();
});
$("body").on("click",".clone_item",function () {
    var selected_value = $(this).parent().parent().parent().find(":selected").val();
    var this_item = $(this).parent().parent().parent().clone();
    this_item.find('select').val(selected_value).change();
    $('#item_parent_div').append(this_item);
});


$('input[name=radios11]').change(function(){
    if($(this).val() ==='no'){
        $('#customer_id7').prop('disabled', 'disabled');
        $('#reference_id').prop('disabled', 'disabled');

    }else{
        $('#customer_id7').prop('disabled', false);
        $('#reference_id').prop('disabled', false);
    }
});

function j_pickup(){
    var branch_val = $('#customer_id3').val();
    $('#current_branch').val(branch_val).change();
    $('#job_status').val('1').change();
}

function j_received(){
    event.preventDefault();
    var branch_val = $('#customer_id3').val();
    $('#current_branch').val(branch_val).change();

    $('#job_status').val('2').change();
}



$("body").on("click",".no_onforworder",function(){
    $( "input[name='r_reference']" ).prop( "disabled", true );
    $( ".forworder_option" ).prop( "disabled", true );
});

$("body").on("click",".yes_onforworder",function(){
    $( "input[name='r_reference']" ).prop( "disabled", false );
    $( ".forworder_option" ).prop( "disabled", false );

    $('.forword_list').select2({
        placeholder: "Select an option"
    });
});

function get_customer(){
    var customer_id = $('#customer_id').val();
    let url = "{{ route('customers.edit', ':id') }}";
    url = url.replace(':id', customer_id);
    document.location.href=url;
}

function makeitsender(){
    var customer_id = $('#customer_id').val();


    $.ajax({
        type:'Post',
        url:"{{ route('get_customer') }}",
        data:{'id':customer_id},
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success:function(data) {

            if(typeof data.address['0'] !== 'undefined'){
                var address_line_1 = data.address['0']['p_address_line_1'];
            }else{
                var address_line_1 = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var address_line_2 = data.address['0']['p_address_line_2'];
            }else{
                var address_line_2 = '';
            }
            if(typeof data.address['0'] !== 'undefined'){
                var suburb = data.address['0']['p_suburb'];
            }else{
                var suburb = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var postal_code = data.address['0']['p_postal_code'];
            }else{
                var postal_code = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var state = data.address['0']['p_state'];
            }else{
                var state = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var time = data.address['0']['p_opening_time'];
            }else{
                var time = '';
            }

            if(typeof data['primary_contact'] !== 'undefined'){
                var contact = data['primary_contact']['contact_name'];
            }else{
                var contact = '';
            }

            if(typeof data['primary_contact'] !== 'undefined'){
                var phone = data['primary_contact']['mobile'];
            }else{
                var phone = '';
            }


            $('#customer_id2').val(data.id).change();


            $('#customer_id5').append($('<option>', {
                value: '',
                text: 'Select customer',
                selected:'selected'
            }));

            $('#receiver_address_line_1').val('');
            $('#receiver_address_line_2').val('');
            $('#r_suburb').val('');
            $('#r_postal_code_id').val('');
            $('#receiver_state').val('');
            $('#r_time').val('');
            $('#receiver_contact').val('');
            $('#r_phone').val('');

            $('#sender_address_line_1').val(address_line_1);
            $('#sender_address_line_2').val(address_line_2);
            $('#suburb').val(suburb);
            $('#postal_code_id').val(postal_code);
            $('#sender_state').val(state);
            $('#s_time').val(time);
            $('#sender_contact').val(contact);
            $('#s_phone').val(phone);

        }
    });
}

function makeitreceiver() {
    var customer_id = $('#customer_id').val();
    $.ajax({
        type:'Post',
        url:"{{ route('get_customer') }}",
        data:{'id':customer_id},

        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success:function(data) {
            if(typeof data.address['0'] !== 'undefined'){
                var address_line_1 = data.address['0']['p_address_line_1'];
            }else{
                var address_line_1 = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var address_line_2 = data.address['0']['p_address_line_2'];
            }else{
                var address_line_2 = '';
            }
            if(typeof data.address['0'] !== 'undefined'){
                var suburb = data.address['0']['p_suburb'];
            }else{
                var suburb = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var postal_code = data.address['0']['p_postal_code'];
            }else{
                var postal_code = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var state = data.address['0']['p_state'];
            }else{
                var state = '';
            }

            if(typeof data.address['0'] !== 'undefined'){
                var time = data.address['0']['p_opening_time'];
            }else{
                var time = '';
            }

            if(typeof data['primary_contact'] !== 'undefined'){
                var contact = data['primary_contact']['contact_name'];
            }else{
                var contact = '';
            }

            if(typeof data['primary_contact'] !== 'undefined'){
                var phone = data['primary_contact']['mobile'];
            }else{
                var phone = '';
            }


            $('#customer_id5').val(data.id).change();

            $('#customer_id2').append($('<option>', {
                value: '',
                text: 'Select customer',
                selected:'selected'
            }));
            $('#sender_address_line_1').val('');
            $('#sender_address_line_2').val('');
            $('#suburb').val('');
            $('#postal_code_id').val('');
            $('#sender_state').val('');
            $('#s_time').val('');
            $('#sender_contact').val('');
            $('#s_phone').val('');

            $('#receiver_address_line_1').val(address_line_1);
            $('#receiver_address_line_2').val(address_line_2);
            $('#r_suburb').val(suburb);
            $('#r_postal_code_id').val(postal_code);
            $('#receiver_state').val(state);
            $('#r_time').val(time);
            $('#receiver_contact').val(contact);
            $('#r_phone').val(phone);
        }
    });
}

/////////////////////////modal work start///////////////

$("body").on("click","#item_dg_detail",function () {
    var random_no = $(this).parent().parent().parent().parent().find('#random_no').val();

    if(item_childs.length > 0){
        var dg_name = '';
        var dg_no = '';
        var dg_group = '';
        var dg_class = '';
        for(var i=0; i<item_childs.length; i++){
            if(item_childs[i].o_random_no == random_no){
                dg_name = item_childs[i].o_dg_name;
                dg_no = item_childs[i].o_dg_no;
                dg_group = item_childs[i].o_dg_group;
                dg_class = item_childs[i].o_dg_class;
            }
        }
        var new_item_row = '<div class="form-row">\n' +
            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Name</label>\n' +
            '      <input type="hidden" id="random_no" name="random_no" value="'+random_no+'">\n' +
            '      <input type="text" class="form-control" id="dg_name" name="dg_name" value="'+dg_name+'">\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Un No</label>\n' +
            '      <input type="text" class="form-control" id="dg_no" name="dg_no" value="'+dg_no+'">\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Packaging Group</label>\n' +
            '      <input type="text" class="form-control" id="dg_group" name="dg_group" value="'+dg_group+'">\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Class</label>\n' +
            '<select class="custom-select" id="dg_class" name="dg_class">\n' +
            '<option selected value="'+dg_class+'">'+dg_class+'</option>\n' +
            '<option value="Class 1-Explosive">Class 1-Explosive</option>\n' +
            '<option value="Class 1.4-Explosive">Class 1.4-Explosive</option>\n' +
            '<option value="Class 1.5-Explosive">Class 1.5-Explosive</option>\n' +
            '<option value="Class 1.6-Explosive">Class 1.6-Explosive</option>\n' +
            '<option value="Class 2.1-Explosive">Class 2.1-Explosive</option>\n' +
            '<option value="Class 2.2-Explosive">Class 2.2-Explosive</option>\n' +
            '<option value="Class 2.3-Explosive">Class 2.3-Explosive</option>\n ' +
            '</select>\n' +
            '    </div>\n' +

            '    </div>';


        $('#modal_body').append(new_item_row);
        $('#exampleModal').modal('show');
    }else{
        var new_item_row2 = '<div class="form-row">\n' +
            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Name</label>\n' +
            '      <input type="hidden" id="random_no" name="random_no" value="'+random_no+'">\n' +
            '      <input type="text" class="form-control" id="dg_name" name="dg_name" >\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Un No</label>\n' +
            '      <input type="text" class="form-control" id="dg_no" name="dg_no">\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Packaging Group</label>\n' +
            '      <input type="text" class="form-control" id="dg_group" name="dg_group">\n' +
            '    </div>\n' +

            '    <div class="form-group col-md-3">\n' +
            '      <label for="inputCity">DG Class</label>\n' +
            '<select class="custom-select" id="dg_class" name="dg_class">\n' +
            '<option selected value="">Select a class</option>\n' +
            '<option value="Class 1-Explosive">Class 1-Explosive</option>\n' +
            '<option value="Class 1.4-Explosive">Class 1.4-Explosive</option>\n' +
            '<option value="Class 1.5-Explosive">Class 1.5-Explosive</option>\n' +
            '<option value="Class 1.6-Explosive">Class 1.6-Explosive</option>\n' +
            '<option value="Class 2.1-Explosive">Class 2.1-Explosive</option>\n' +
            '<option value="Class 2.2-Explosive">Class 2.2-Explosive</option>\n' +
            '<option value="Class 2.3-Explosive">Class 2.3-Explosive</option>\n ' +
            '</select>\n' +
            '    </div>\n' +

            '    </div>';


        $('#modal_body').append(new_item_row2);
        $('#exampleModal').modal('show');
    }

});

$("body").on("click",".save_mod",function () {

    var formdata = $(this).parent().parent().find('div#price_by_w_id');
    var row_random_no = formdata.find('#random_no').val();

    var row_dg_name = formdata.find('#dg_name').val();
    var row_dg_no = formdata.find('#dg_no').val();
    var row_dg_group = formdata.find('#dg_group').val();
    var row_dg_class = formdata.find('#dg_class').val();


    if(row_dg_name && row_dg_no && row_dg_group){
        if(item_childs.length > 0){
            for(var i=0; i<item_childs.length; i++){
                if(item_childs[i].o_random_no == row_random_no){
                    item_childs[i].o_dg_name = row_dg_name;
                    item_childs[i].o_dg_no = row_dg_no;
                    item_childs[i].o_dg_group = row_dg_group;
                    item_childs[i].o_dg_class = row_dg_class;

                    $('#modal_body').html('');
                    $('#exampleModal').modal('hide');
                }else{
                    var item_child_item_object = {
                        'o_random_no' : row_random_no,
                        'o_dg_name' : row_dg_name,
                        'o_dg_no' : row_dg_no,
                        'o_dg_group' : row_dg_group,
                        'o_dg_class' : row_dg_class,
                    }

                    item_childs.push(item_child_item_object);


                    $('#modal_body').html('');
                    $('#exampleModal').modal('hide');
                }
            }
        }else{
            var item_child_item_object = {
                'o_random_no' : row_random_no,
                'o_dg_name' : row_dg_name,
                'o_dg_no' : row_dg_no,
                'o_dg_group' : row_dg_group,
                'o_dg_class' : row_dg_class,
            }

            item_childs.push(item_child_item_object);

            $('#modal_body').html('');
            $('#exampleModal').modal('hide');

        }

    }else{
        alert('Please fill out missing field');
    }
});

$("body").on("click",".w_close_mod",function () {
    $('#modal_body').html('');
    $('#exampleModal').modal('hide');
});

/////////////////////////modal work end//////////////////
/////////////////////// job form submit start ///////////

$('.item_type').select2({
    placeholder: "Select an item"
});

$('.customer_id22').select2({
    placeholder: "Select a sender"
});
$('.branches').select2({
    placeholder: "Select a branch"
});

$('#customer_id').select2({
    placeholder: "Select a customer"
});
$('#customer_id2').select2({
    placeholder: "Select a sender"
});

$('#customer_id22').select2({
    placeholder: "Select a sender"
});
$('#customer_id3').select2({
    placeholder: "Select a Branch"
});
$('#customer_id4').select2({
    placeholder: "Select a name"
});

$('#customer_id5').select2({
    placeholder: "Select a name"
});

$('.customer_id55').select2({
    placeholder: "Select a name"
});

$('#customer_id6').select2({
    placeholder: "Select a name"
});

$('#customer_id7').select2({
    placeholder: "Select a name"
});

$('#item_type').select2({
    placeholder: "Select a name"
});



$('#job_status').select2({
    placeholder: "Select a job status"
});
// nested
$('#kt_select2_2').select2({
    placeholder: "Select a driver"
});

// multi select
$('#kt_select2_3').select2({
    placeholder: "Select a job type",
});

$('#customer_id').select2({
    placeholder: "Select a customer"
});




/////////////////////// job form submit end /////////////

function job_form_submit(){

    $('#item_dg_data').val(JSON.stringify(item_childs));
    var connote_no = $('input[name="connote_no"]').val();
            var m_connote_no = $('input[name="m_connote_no"]').val();
            if(m_connote_no){
                $('input[name="connote_no"]').val(m_connote_no);
            }
    var fill = 'true';
    $(".required").each(function () {
        var field_val = $(this).val();
        if(!field_val) {
            $(this).addClass('border border-danger');
            fill = "false";
            Swal.fire({
                title: 'Fill all the fields to proceed your JOb',
            })
        }

    });

    $(".srequired").each(function () {
        var field_val = $(this).val();
        if(!field_val) {
            $(this).parent().addClass('border border-danger');
            fill = "false";
            Swal.fire({
                title: 'Fill all the fields to proceed your JOb',
            })
        }

    });
    if(fill == "true"){
        document.getElementById('job_add_form').submit();
    }

}

