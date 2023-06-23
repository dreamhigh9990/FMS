<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Consignment Note WT-06206</title>
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
        table td {
            text-align: center;
        }
    </style>
</head>
<body>
<header class="clearfix" style="padding: 10px 0;margin-bottom: 10px;">
    <div id="company" class="clearfix" style="float: left;">
        <div style="margin-bottom: 15px;">
            <img src="./images/logo.png" width="170">
        </div>
        <div style="margin-bottom: 10px;">Manifest Type : <span style="font-weight: bold;">#{{$manifest->type}}</span></div>
        <div style="margin-bottom: 10px;">Dispatch Branch : <span style="font-weight: bold;">{{$manifest->dispatch_branch}}</span></div>
        <div style="margin-bottom: 10px;">Dispatched Date : <span style="font-weight: bold;">{{$manifest->arrival_date}}</div>
    </div>



    <div id="info" class="clearfix" style="float: right;text-align: right;">
        <div style="font-weight: bold;">MANIFEST : #{{$manifest->id}}</div>
    </div>
    <div id="company" style="float: right;margin-top: 100px;">

        <div style="margin-bottom: 10px;">Manifest Type : <span style="font-weight: bold;">#{{$manifest->type}}</span></div>
        <div style="margin-bottom: 10px;">Dispatch Branch : <span style="font-weight: bold;">{{$manifest->dispatch_branch}}</span></div>
        <div style="margin-bottom: 10px;">Dispatched Date : <span style="font-weight: bold;">{{$manifest->arrival_date}}</div>
    </div>
</header>
<main>
    <table style="border-collapse: collapse;border-spacing: 0;margin-bottom: 20px;margin-right: 10px;display: inline-table;width: 100%;">
        <thead>
        <tr>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Connote #</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Receiver</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Origin Branch</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Destination Branch</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Item</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Qty</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Description</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Weight</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Cubic</td>
            <td style="border: 1px solid #808080;height: 30px;font-weight: bold;">Arrived</td>
        </tr>
        </thead>
        <tbody>

        @foreach($job_items as $jitem)
            <tr>
                <td scope="row" style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->job->connote_no}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->job->job_receiver['receiver_name']}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->job->job_sender_branch['branches']}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->job->job_receiver_branch['branches']}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->item->item_name}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->item_qty}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->item_description}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->item_tweight}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;">{{$jitem->item_cubic_m3}}</td>
                <td style="border: 1px solid #b3b3b3;height: 20px;"></td>
            </tr>
        @endforeach

        <tr>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
            <td style="height: 10px;"></td>
        </tr>
        <tr>
            <td scope="row"  style="border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{count($job_items)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td bgcolor="#d9d9d9"  style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">Total</td>
            <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$t_q}}</td>
            <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;"></td>
            <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$t_w}}</td>
            <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;">{{$t_m3}}</td>
            <td bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #b3b3b3;height: 20px;font-weight: bold;"></td>
        </tr>

        </tbody>
    </table>

</main>
</body>
</html>
