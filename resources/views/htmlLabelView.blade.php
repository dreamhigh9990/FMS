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
            width: 100%;
            height: 16.4cm;
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
        table td {
            text-align: center;
        }

        .fontstyle0 {
            text-align: left;
        }

    </style>
</head>

<body>
    <header style="margin-bottom: -28px ;">
        <hr />
        <div style="display:table; margin-bottom: 10px;">
            <div style="font-size:25px; margin:0px 0px 0px 15px; font-family:New Times Roman;">Wards Transport</div>
            <div id="company" class="clearfix" style="float: right;">
                <div style="margin-bottom:40px;margin-top:1px;">
                    <img src="./images/logo.png" width="80">
                </div>
            </div>
        </div>
        <div style="display:inline-flex;">
            <div style="margin-left:20px">1300 492 737</div>
            <div style="margin-left:160px">{{ date('d-M-Y') }}</div>
            <div style="margin-left:385px">Label: 1 of 1</div>
        </div>
        {{-- <div id="info" class="clearfix" style="float: right;text-align: right;">
            <div style="font-weight: bold; margin-bottom: 20px">
                <span style="margin-left: 2cm;">{{ date('d-M-Y') }}</span>
                <span style="margin-left: 2cm;">Consignment Note {{ isset($job)?$job->connote_no :0}}</span>
            </div>

        </div> --}}

    </header>
    <main>
        <hr />
        <div>
            <div style="text-align:center; margin-left:80px;"><b>Service : {{isset($job)?$job->job_type:$jobs->job_type}}</b></div>
            <table class="ws-table-all notranslate" style="border: 1px solid #808080; width:100%">
                <tbody>
                    <tr>
                        <td style="text-align:left; padding-left:5px; width:50%;">
                            <div>{{isset($job)?$job->job_sender->sender_name:$jobs->sender_name}}</div>
                            <div>{{isset($job)?$job->job_sender->sender_address_line_1:$jobs->sender_address_line_1}}</div>
                            <div>{{isset($job)?$job->job_sender->sender_address_line_2:$jobs->sender_address_line_2}}</div>
                            <div>{{isset($job)?$job->job_sender->suburb:$jobs->suburb}} {{isset($job)?$job->job_sender->sender_state:$jobs->sender_state}} {{isset($job)?$job->job_sender->postal_code:$jobs->postal_code}}</div>
                            <div>Contact :{{isset($job)?$job->job_sender->sender_contact:$jobs->sender_contact}}</div>
                            <div>Number: {{isset($job)?$job->job_sender->s_phone:$jobs->s_phone}}</div>
                        </td>
                        <td style="text-align:left; padding-left:5px; width:50%;">
                            <div>{{isset($job)?$job->job_receiver->receiver_name:$jobs->receiver_name}}</div>
                            <div>{{isset($job)?$job->job_receiver->receiver_address_line_1:$jobs->receiver_address_line_1}}</div>
                            <div>{{isset($job)?$job->job_receiver->receiver_address_line_2:$jobs->receiver_address_line_2}}</div>
                            <div>{{isset($job)?$job->job_receiver->suburb:$jobs->r_suburb}} {{isset($job)?$job->job_receiver->receiver_state:$jobs->receiver_state}} {{isset($job)?$job->job_receiver->postal_code:$jobs->postal_code}}</div>
                            <div>Contact :{{isset($job)?$job->job_receiver->receiver_contact:$jobs->receiver_contact}}</div>
                            <div>Number: {{isset($job)?$job->job_receiver->r_phone:$jobs->r_phone}}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="font-size:8px;margin-top:-8px;">
            <p>Customer REF : {{isset($job)?$job->m_reference:$jobs->m_reference}}</p>
        </div>
        <div style="font-size:8px;margin-top:-14px;">
            <p><b>Instructions:</b></p>
            <p>
                {{isset($job)?$job->job_receiver->r_Pick_up_notes:$jobs->r_Pick_up_notes}}
            </p>
        </div>
        <hr />
        <div style="width:100%; text-align: center;">
            <h2 style="margin-top:-3px;"> {{isset($job)?$job->job_sender_branch->branches:$model_data['sender_branch'][0]['branches']}} </h2>
            <p style="font-size:10px; background-color:black; color:white; margin-top:-10px;"><b>{{isset($job)?$job->job_receiver_branch->branches:$model_data['receiver_branch'][0]['branches']}}</b></p>
            <h4 style="margin-top:-10px;">Cannote # {{isset($job)?$job->connote_no:$jobs->connote_no}}</h4>
        </div>
        @foreach (isset($job)?$job->job_items:$jobs->item_reference as $i)
        <hr />
        <table class="ws-table-all notranslate table_notranslate" style="width:100%; margin-top:20px;">
            <tbody>

                <tr>
                    <td style="text-align:left; width:50%;">
                        <div style="margin:-38px 0px 0px -3px; ">
                            <p>ITEM: {{isset($job)?$i->item->item_name:$model_data['item_type'][$loop->index] }}</p>
                            <p style="font-size:10px;">Delivery Note:{{isset($job)?$i->item_description:$jobs->item_description[$loop->index]}}</p>
                        </div>
                    </td>
                    <td style="text-align:left; width:50%;">
                        <div style="margin:-18px 0px 0px -3px;">
                            <p>ITEM: <b>{{ $loop->index  + 1 }}</b> Of <b>{{isset($job)?count($job->job_items):count($jobs->item_reference)}}</b> QTY</p>
                            <p style="font-size:10px;">Weight: <b>{{isset($job)?$i->item_tweight:$jobs->item_tweight[$loop->index]}}</b></p>
                            <p style="font-size:10px;">Dimensions:{{isset($job)?$i->item_length:$jobs->item_length[$loop->index]}} x {{isset($job)?$i->item_width:$jobs->item_width[$loop->index]}} x {{isset($job)?$i->item_height:$jobs->item_height[$loop->index]}}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        @endforeach
        <hr />

        <!-- <div class="row">
            <div class="col-sm-6">
                <p>ITEM: Jiffy Bag</p>
                <p>Delivery Note:</p>
            </div>
            <div class="col-sm-6">
                <p>ITEM: 1 Of 1 QTY</p>
                <p>Weight: 1</p>
                <p>Dimensions:25 x 20 x 5</p>
            </div>
        </div> -->
        {{-- <div class="cart">
            <table
                style="border-collapse: collapse;border-spacing: 0;margin-bottom: 10px;margin-right: 10px;display: inline-table;width: 100%;">

                <thead>
                    <tr>
                        <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">SENDER
                            REFERENCE</td>
                        <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">QTY</td>
                        <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">ITEM TYPE</td>
                        <td rowspan="2" style="border: 1px solid #808080;height: 25px;font-weight: bold;">DESCRIPTION
                        </td>
                        <td colspan="3" style="border: 1px solid #808080;height: 30px;font-weight: bold;"> DIMENSIONS
                            (CM)</td>
                        <td rowspan="2" width="40" style="border: 1px solid #808080;height: 15px;font-weight: bold;">
                            WEIGHT<br>(Kg)</td>
                        <td rowspan="2" width="40" style="border: 1px solid #808080;height: 15px;font-weight: bold;">M3
                        </td>
                        <td rowspan="2" width="40" style="border: 1px solid #808080;height: 15px;font-weight: bold;">PLT
                            SPC</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">L</td>
                        <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">W</td>
                        <td style="border: 1px solid #808080;height: 15px;font-weight: bold;">H</td>
                    </tr>
                </thead>

                <tbody>

                    @foreach (isset($job)?$job->job_items as $i)
                    <tr style="font-size: 12px;text-align:center;">
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_reference}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_qty}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item->item_name}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_description}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_length}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_width}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_height}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_tweight}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_cubic_m3}}
                        </td>
                        <td style="border: 1px solid #808080;height: 5px;">
                            {{$i->item_plt_spc}}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div> --}}

    </main>

</body>


</html>
