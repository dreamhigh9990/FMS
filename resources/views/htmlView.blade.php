
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Consignment Note {{$job->connote_no}}</title>
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
            font-family: Arial;
        }
        input[type="text"] {
            width: 100%;
        }
        table th,
        
    </style>
</head>
<body style="width: 90%;">
<header class="clearfix" style="padding: 10px 0;margin-bottom: 20px;">
    <div id="company" class="clearfix" style="float: left;">
        <div style="margin-bottom:20px;margin-top:20px">
            <img src="./images/logo.png" width="170">
        </div>
        <div>A.B.N. 97 105 025 189</div>
        <div>75 Duke St South, Roma, QLD, 4455</div>
        <div>www.wardstransport.com.au</div>
        <div>PH : <span style="color: #0070c0;">1300 4</span><span style="color: #17365d;"> Wards <span style="font-size: 80%;">(1300 492 737)</span></span></div>
    </div>
    <div id="info" class="clearfix" style="float: right;text-align: right;">
        <div style="font-weight: bold; margin-bottom: 20px">
            <span style="margin-left: 2cm;">{{date('d-M-Y')}}</span>
            <span style="margin-left: 2cm;">Consignment Note {{$job->connote_no}}</span>
        </div>
        <div style="margin-bottom: 15px;">
            <img src="data:image/png;base64, {{ $qrcode }}">
        </div>
        <div class="info_end">
            <span style="margin-left: 1cm;">Job ID : <span style="font-weight: bold;">{{$job->id}}</span></span>
            <span style="margin-left: 1cm;">Service Type : <span style="font-weight: bold;">{{$job->job_type}}</span></span>
            <span style="margin-left: 1cm;">Service level : {{$job->job_type}}</span>
            <span style="margin-left: 1cm;">Customer Reference : {{$job->m_reference}}</span>
        </div>
    </div>

</header>
<main>

    <div class="blocks" style="display: table;margin-bottom: 10px; width: 100%">
        <p style="background-color: #d9d9d9; text-align: center; font-size: 15px"><b>Shipment Details</b></p>

        <table style="border-collapse: collapse;border-spacing: 0; margin-right: 10px; display: inline-table; width: 6.6cm; width: 100%; font-family: Times New Roman;">
            <thead>
            <tr style="text-align: left; font-size: 12px; color: white;">
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">SENDER/CONSIGNER</th>
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">RECEIVER/CONSIGNEE</th>
            </tr>
            </thead>
            <tbody>
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px;">
                  <div>Bery/Ward</div>
                  <div>75 Duke St</div>
                  <p></p>
                  <div>ROMA QLD 4455</div>
                  <div>Contact :Bery| Ward</div>
                  <div>Number: 07 46204 500</div>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  <div>ACME Enterprises</div>
                  <div>Unit 1</div>
                  <div>123 Brisbane St</div>
                  <div>ARCHERFEILD QLD 4001</div>
                  <div>Contact : Brian Caims</div>
                  <div>Number : 0427 123 456</div>
                </td>
            </tr>
            </tbody>
        </table>
        <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:15px; display: inline-table;width: 6.6cm; width: 100%; font-family: Times New Roman;">
            <thead>
            <tr style="text-align: left; font-size: 12px; color: white;">
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Pickup Instructions</th>
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">Delivery Instructions</th>
            </tr>
            </thead>
            <tbody>
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px; width: 50%">
                  Items ready for pickup at front door. Knock on before<br> collection
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  <div>Leave at reception</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="cart">

        <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:15px; display: inline-table;width: 6.6cm; width: 100%; font-family: Times New Roman;">
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
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px;">
                  1234
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  5
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Pallet
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Pot plants
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  120
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  120
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  120
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  500
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  8.64
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  5
                </td>
            </tr>
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px;">
                  87451214S
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  100
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Carton
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Packing clips for pot<br>
                  plants
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  10
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  10
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  10
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  200
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  1
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  2
                </td>
            </tr>
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px;">
                  G433FGH
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  100
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Pallet-<br>Chiller
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Frozen Goods<br>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  1200
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  100
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  120
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  1000
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  14.4
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  100
                </td>
            </tr>
            <tr style="font-size: 12px;">
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);">
                  Totals
                </td>
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);">
                  205
                </td>
                <td style="border: 1px solid #808080;height: 40px; background:rgb(127,127,127);">
                </td>
                <td style="border: 1px solid #808080;height: 40px; background:rgb(127,127,127);">
                </td>
                <td style="border: 1px solid #808080;height: 40px; background:rgb(127,127,127);">
                </td>
                <td style="border: 1px solid #808080;height: 40px; background:rgb(127,127,127);">
                </td>
                <td style="border: 1px solid #808080;height: 40px; background:rgb(127,127,127);">
                </td>
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);">
                    1700
                </td>
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);">
                    23.14
                </td>
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);">
                    107
                </td>
            </tr>
            </tbody>
        </table>

        <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:15px; display: inline-table;width: 6.6cm; width: 100%">
            <thead>
            <tr style="text-align: left; font-size: 12px; color: white;">
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);" colspan="3">Sender</th>
                <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);" colspan="4">Receiver</th>
            </tr>
            </thead>
            <tbody style="font-size: 12px">
            <tr style="font-size: 12px; text-align: left;">
                <th style="border: 1px solid #808080;height: 40px; width: 16%; background-color: rgb(241,241,241);" rowspan="3" >
                    By signing this consignment<br>
                    note, you acknowledge that<br>
                    you have read, understood,<br>
                    and agreed to the conditions<br>
                    of carriage
                </th>
                <td style="border: 1px solid #808080;height: 40px; width: 5%">
                  <b>Name:</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px; width: 30%">
                </td>
                <th style="border: 1px solid #808080;height: 40px; width: 15%; background-color: rgb(241,241,241);" rowspan="3">
                  I/We hereby agree that<br>
                  these goods were received<br>
                  in total and in good<br>
                  condition.
                </th>
                <td style="border: 1px solid #808080;height: 40px; width: 5%">
                  <b>Name:</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px; width: 15%">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #808080;height: 40px;">
                  <b>Date:</b>
                </td>
                 <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  <b>Date:</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #808080;height: 40px;">
                  <b>Signature:</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  <b>Signature:</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241); text-align: center;">
                  <b>Driver Info</b>
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                    Fleet#
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                  Name
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                    Signature
                </td>
                <td style="border: 1px solid #808080;height: 40px;">
                </td>
            </tr>

            </tbody>
        </table>

        <table style="border-collapse: collapse;border-spacing: 0;margin-right: 10px; margin-top:15px; display: inline-table;width: 6.6cm; width: 100%">
            <tbody style="font-size: 13px; font-family: Times New Roman; text-align: center;">
                <tr >
                    <th bgcolor="#d9d9d9" style="background-color: rgb(241,241,241); border: 1px solid #808080;height: 20px;font-weight: bold; " rowspan="4">Pallets</th>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" rowspan="2">
                      Sender
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      NA
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Exchange
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Transfer
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Transfer#
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Chep
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Loscam
                   </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #808080;height: 40px;">
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    *
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    1234ABC
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    5
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    100
                   </td>
                </tr>
                <tr >
                    
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" rowspan="2">
                      Receiver
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      NA
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background:rgba(127,127,127,0.7);" >
                      Exchange
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Transfer
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Transfer#
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Chep
                   </td>
                   <td style="border: 1px solid #808080;height: 40px; background-color: rgb(241,241,241);" >
                      Loscam
                   </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #808080;height: 40px;">
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    *
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    1234ABC
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    5
                   </td>
                   <td style="border: 1px solid #808080;height: 40px;">
                    100
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

    <footer>
        
        <div style="font-size: 8px;text-align: center;margin-bottom: 5px;">You should take out your own insurance cover over the goods. If you are operating a business; the goods are at your sole risk and our services are priced on this basis; and we will not accept liability for any loss of or damage to the goods, or any other losses you suffer, regardless of the cause</div>
        <div style="font-size: 8px;text-align: center;margin-bottom: 5px;">Wards Transport is not a common carrier, all transport is done under our company Terms and Conditions of Carriage. Which is available on request or at www.wardstransport.com.au/legal/conditions</div>
        <h2 style="font-size: 15px;font-weight: bold;margin: 5px 0 0;text-align: center;">Wards Transport PTY LTD</h2>

    </footer>

</main>

</body>


</html>
