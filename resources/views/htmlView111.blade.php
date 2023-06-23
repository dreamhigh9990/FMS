<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Consignment Note {{isset($job)?$job->connote_no:$jobs->connote_no}}</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        body {
            position: relative;
            width: 28cm;
            height: 21cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 10px;
            font-family: 'Calibri', Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }
        input[type="text"] {
            width: 100%;
        }
        table th,

    </style>
</head>
<body style="width: 99%; height:110%; ">
    <header class="clearfix" style="padding: 10px 0;">
        <div id="company" class="clearfix" style="float: left;">
            <div style="margin-bottom:20px;margin-top:20px">
                <img src="./images/logo.png" width="170">
            </div>
            <div>A.B.N. 97 105 025 189</div>
            <div>75 Duke St South,<br>
            Roma, QLD, 4455</div>
            <a href="#"><div style="color:blue;">www.wardstransport.com.au</div></a>
            <div><span>1300 4</span><span> Wards <span style="font-size: 97%;">(1300 492 737)</span></span></div>
        </div>
        <div id="info" class="clearfix" style="float: right; text-align: right; ">

            <div style="margin-bottom: 15px;">
                <img src="data:image/png;base64, {{$qrcode}}">
            </div> 
            <div style="margin-right:50px;">
                <div class="info_ends" style="float: left; background-color:#d3d7d7; margin-top:-2px; padding:2px; height: 60px; width:80px;">
                    <div><b>Consignment #</b></div>
                    <div><b>Date</b></div>
                    <div><b>Service Type</b></div>
                    <div><b>Reference</b></div>
                    <div><b>Customer #</b></div>
                </div>
                <div class="info_ends" style="text-align: left; float:left; margin-left:90px;">
                    <div>{{isset($job)?$job->connote_no:$jobs->connote_no}}</div>
                    <div>{{date('d-M-Y')}}</div>
                    <div> <span style="font-weight: bold;">{{isset($job)?$job->job_type:$jobs->job_type}}</span></div>
                    <div>{{isset($job)?$job->job_type:$jobs->job_type}}</div>
                    <div>{{isset($job)?$job->m_reference:$jobs->m_reference}}</div>
                </div>
            </div>
        </div>

    </header>
    <main>

        <p style="background-color: #d9d9d9; text-align: center; font-size: 15px"><b>Shipment Details</b></p>
        <div class="blocks" style=" width: 100%">

            <table style="border-collapse: collapse;border-spacing: 0; margin-right: 10px; display: inline-table; width: 6.6cm; width: 100%;">
                <thead>
                <tr style="text-align: left; font-size: 12px; color: white;">
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">SENDER/CONSIGNER</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">RECEIVER/CONSIGNEE</th>
                </tr>
                </thead>
                <tbody>
                <tr style="font-size: 12px;">
                    <td style="border: 1px solid #808080; height: 40px;width:50%;">
                        <div>{{isset($job)?$job->job_sender->sender_name:$jobs->sender_name}}</div>
                        <div>{{isset($job)?$job->job_sender->sender_address_line_1:$jobs->sender_address_line_1}}</div>
                        <div>{{isset($job)?$job->job_sender->sender_address_line_2:$jobs->sender_address_line_2}}</div>
                        <div>{{isset($job)?$job->job_sender->suburb:$jobs->suburb}} {{isset($job)?$job->job_sender->sender_state:$jobs->sender_state}} {{isset($job)?$job->job_sender->postal_code:$jobs->postal_code}}</div>
                        <div>Contact :{{isset($job)?$job->job_sender->sender_contact:$jobs->sender_contact}}</div>
                        <div>Number: {{isset($job)?$job->job_sender->s_phone:$jobs->s_phone}}</div>
                    </td>
                    <td style="border: 1px solid #808080;height: 40px;">
                        <div>{{isset($job)?$job->job_receiver->receiver_name:$jobs->receiver_name}}</div>
                        <div>{{isset($job)?$job->job_receiver->receiver_address_line_1:$jobs->receiver_address_line_1}}</div>
                        <div>{{isset($job)?$job->job_receiver->receiver_address_line_2:$jobs->receiver_address_line_2}}</div>
                        <div>{{isset($job)?$job->job_receiver->suburb:$jobs->suburb}} {{isset($job)?$job->job_receiver->receiver_state:$jobs->receiver_state}} {{isset($job)?$job->job_receiver->postal_code:$jobs->postal_code}}</div>
                        <div>Contact :{{isset($job)?$job->job_receiver->receiver_contact:$jobs->receiver_contact}}</div>
                        <div>Number: {{isset($job)?$job->job_receiver->r_phone:$jobs->r_phone}}</div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:10px; display: inline-table;width: 6.6cm; width: 100%;">
                <thead>
                <tr style="text-align: left; font-size: 12px; color: white;">
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Pickup Instructions</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Delivery Instructions</th>
                </tr>
                </thead>
                <tbody>
                <tr style="font-size: 12px;">
                    <td style="border: 1px solid #808080;height: 20px; width: 50%">
                        {{isset($job)?$job->job_sender->pick_up_notes:$jobs->Pick_up_notes}}
                    </td>
                    <td style="border: 1px solid #808080;height: 20px;">
                    <div>{{isset($job)?$job->job_receiver->r_Pick_up_notes:$jobs->r_Pick_up_notes}}</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="cart">

            <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:10px; display: inline-table;width: 6.6cm; width: 100%;">
                <thead>
                <tr style="text-align: left; font-size: 12px; color: white;">
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Sender Ref</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">QTY</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Item</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Description</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">L<sub>cm</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">W<sub>cm</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">H<sub>cm</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Total<sub>KG</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Volume</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">PLT SPC</th>
                </tr>
                </thead>
                <tbody>
                        @foreach (isset($job)?$job->job_items:$jobs->item_qty as $i)
                        <tr style="font-size: 12px;text-align:center;">
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_reference:$jobs->item_reference[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_qty:$jobs->item_qty[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item->item_name:$model_data['item_type'][$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_description:$jobs->item_description[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_length:$jobs->item_length[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_width:$jobs->item_width[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_height:$jobs->item_height[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_tweight:$jobs->item_tweight[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_cubic_m3:$jobs->item_cubic_m3[$loop->index]}}
                            </td>
                            <td style="border: 1px solid #808080;height: 5px;">
                                {{isset($job)?$i->item_plt_spc:$jobs->item_plt_spc[$loop->index]}}
                            </td>
                        </tr>
                        @endforeach
                <tr style="font-size: 12px; text-align:center;">
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);">
                    Totals
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);">
                        {{isset($job)?$item_qty:$model_data['item_qty']}}
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgb(127,127,127);">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgb(127,127,127);">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgb(127,127,127);">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgb(127,127,127);">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgb(127,127,127);">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);">
                        {{isset($job)?$item_tweight:$model_data['item_tweight']}}
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);">
                        {{isset($job)?$item_cubic_m3:$model_data['item_cubic_m3']}}    
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);">
                        {{isset($job)?$item_plt_spc:$model_data['item_plt_spc']}}
                    </td>
                </tr>
                </tbody>
            </table>

            <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:10px; display: inline-table;width: 6.6cm; width: 100%">
                <thead>
                <tr style="text-align: left; font-size: 12px; color: white;">
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127); width:50%;" colspan="3">Sender</th>
                    <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127); width:50%;" colspan="3">Receiver</th>
                </tr>
                </thead>
                <tbody style="font-size: 12px">
                    <tr style="text-align: left;">
                        <td style="border: 1px solid #808080;height: 10px; width: 12%;text-align:left; background-color: rgb(241,241,241); font-size: 11px;" rowspan="3" >
                            By signing this consignment<br>
                            note, you acknowledge that<br>
                            you have read, understood,<br>
                            and agreed to the conditions<br>
                            of carriage
                        </td>
                        <td style="border: 1px solid #808080;height: 5px; width: 5%; text-align:right;">
                        <b>Name:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px; width: 11%;">
                        </td>
                        <td style="border: 1px solid #808080;height: 10px; width: 11%; text-align:left; background-color: rgb(241,241,241);font-size: 11px;" rowspan="3">
                        I/We hereby agree that<br>
                        these goods were received<br>
                        in total and in good<br>
                        condition.
                        </td>
                        <td style="border: 1px solid #808080;height: 5px; width: 5%;">
                        <b>Name:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px; width: 12%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #808080;height: 5px; text-align:right;">
                        <b>Date:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        <b>Date:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #808080;height: 5px;">
                        <b>Signature:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        <b>Signature:</b>
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;width: 5%;">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; display: inline-table;width: 6.6cm; width: 100%;">
                <thead>
                <tr style="text-align: left; font-size: 12px; text-align:center;">
                    <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(241,241,241); width:15%;">Driver Info</td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: width:4%;">Fleet#</td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: bold; width:18%;"></td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: width:4%;">Name</td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: bold; width:18.4%;"></td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: width:4%;">Signature</td>
                    <td style="border: 1px solid #808080;height: 20px;font-weight: bold; width:21%;"></td>
                </tr>
                </thead>
            </table>

            <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:10px; display: inline-table;width: 6.6cm; width: 100%">
                <tbody style="font-size: 13px; text-align: center;">
                    <tr >
                        <th bgcolor="#d9d9d9" style="background-color: rgb(241,241,241); border: 1px solid #808080;height: 10px;font-weight: bold; " rowspan="4">Pallets</th>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" rowspan="2">
                        Sender
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        NA
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Exchange
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Transfer
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241); text-align:left;" >
                        Transfer#
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Chep
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Loscam
                    </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #808080;height: 5px;">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px;">
                    </td>
                    <td style="border: 1px solid #808080;height: 5px;">
                        X
                    </td>
                    <td style="border: 1px solid #808080;height: 5px;">

                    </td>
                    <td style="border: 1px solid #808080;height: 5px;">

                    </td>
                    <td style="border: 1px solid #808080;height: 5px;">

                    </td>
                    </tr>
                    <tr >

                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" rowspan="2">
                        Receiver
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        NA
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background:rgba(127,127,127,0.7);" >
                        Exchange
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Transfer
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241); text-align:left;" >
                        Transfer#
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Chep
                    </td>
                    <td style="border: 1px solid #808080;height: 5px; background-color: rgb(241,241,241);" >
                        Loscam
                    </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #808080;height: 5px;">
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        X
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">

                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">

                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">

                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- <table style="border-collapse: collapse;border-spacing: 0;margin-bottom: 10px;margin-right: 10px;display: inline-table;width: 100%;">

                <thead>
                <tr>
                    <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">SENDER REFERENCE</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">QTY</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">ITEM TYPE</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">DESCRIPTION</td>
                    <td colspan="3" style="border: 1px solid #808080;height: 30px;font-weight: bold;"> DIMENSIONS (CM)</td>
                    <td rowspan="2" width="55" style="border: 1px solid #808080;height: 15px;font-weight: bold;">WEIGHT<br>(Kg)</td>
                    <td rowspan="2" width="55" style="border: 1px solid #808080;height: 15px;font-weight: bold;">M3</td>
                    <td rowspan="2" width="55" style="border: 1px solid #808080;height: 15px;font-weight: bold;">PLT SPC</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">L</td>
                    <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">W</td>
                    <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">H</td>
                </tr>
                </thead>

                <tbody>

                {{--
                    @foreach($job->job_items as $i)
                    <tr>
                        <td scope="row" style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_reference}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_qty}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item->item_name}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_description}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_length}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_width}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_height}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 15px;">{{$i->item_tweight}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 20px;">{{$i->item_cubic_m3}}</td>
                        <td style="border: 1px solid #b3b3b3;height: 15px;">{{$i->item_plt_spc}}</td>
                    </tr>
    
                    @endforeach
                    
                    <tr>
                        <td scope="row"  bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">Total</td>
                        <td  bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_qty}}</td>
                        <td></td>
                        <td></td>
                        <td bgcolor="#d9d9d9"  style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_length}}</td>
                        <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_width}}</td>
                        <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_height}}</td>
                        <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_tweight}}</td>
                        <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_cubic_m3}}</td>
                        <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$item_plt_spc}}</td>
                        </tr>
                        
                --}}

                </tbody>
            </table> -->

        </div>

    <!--    <div class="signatures">
            <table style="border-collapse: collapse;border-spacing: 0;margin-bottom: 20px;margin-right: 10px;display: table;table-layout: fixed;width: 100%;">

                <thead>
                <tr>
                    <td colspan="2" style="border: 1px solid #808080;height: 30px;font-weight: bold;">Senders Signature</td>
                    <td colspan="2" style="border: 1px solid #808080;height: 30px;font-weight: bold;">Pickup Driver Signature</td>
                    <td colspan="2" style="border: 1px solid #808080;height: 30px;font-weight: bold;">Receivers signature</td>
                    <td colspan="2" style="border: 1px solid #808080;height: 30px;font-weight: bold;">Delivery Driver Signature</td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td colspan="2" style="border: 1px solid #808080;text-align: left; padding: 5px;"><span style="font-weight: bold;">T&C</span> - By signing this consignment note, you acknowledge that you have read, understood and agreed to the conditions of carriage.</td>
                    <td colspan="2" style="border: 1px solid #808080;text-align: left;">FLEET #</td>
                    <td colspan="2" style="border: 1px solid #808080;text-align: left; padding: 5px;">I/We hereby agree that these goods were received in total and in good condition.</td>
                    <td colspan="2" style="border: 1px solid #808080;text-align: left;">FLEET #</td>
                </tr>
                <tr>
                    <td rowspan="2" style="border: 1px solid #808080;height: 30px;text-align: left;vertical-align: top;">Signature</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Name</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 30px;text-align: left;vertical-align: top;">Signature</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Name</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 30px;text-align: left;vertical-align: top;">Signature</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Name</td>
                    <td rowspan="2" style="border: 1px solid #808080;height: 30px;text-align: left;vertical-align: top;">Signature</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Name</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Date</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Date</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Date</td>
                    <td style="border: 1px solid #808080;height: 35px;text-align: left;">Date</td>
                </tr>

                </tbody>
            </table>
        </div> -->

        <footer style="position:absolute; bottom:80px; width:100%; height:60px;">
            <p style="font-size: 9.4px;text-align: left;margin-bottom: 5px; color:red;">You should take out your own insurance cover over the goods. If you are operating a business; the goods are at your sole risk and our services are priced on this basis; and we will not accept liability for any loss of or damage to the goods, or any other losses you suffer, regardless of the cause.</p>
            <p style="margin-top:-5px">Wards Transport is not a common carrier, all transport is done under our company Terms and Conditions of Carriage. Which is available on request or at <b>www.wardstransport.com.au/legal/conditions</b></p>
        </footer>

    </main>

</body>


</html>
