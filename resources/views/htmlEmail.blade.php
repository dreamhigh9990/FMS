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
 <body style="width: 40%; height:110%; ">
    <header class="clearfix" style="padding: 10px 0;">
        <div id="info" class="clearfix" style="float: right; text-align: right; ">

            <div style="margin-bottom: 15px;">
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

        <div class="blocks" style=" width: 100%">

            <table style="border-collapse: collapse;border-spacing: 0; margin-right: 10px; display: inline-table; width: 6.6cm; width: 100%;">
                <thead>
                    <tr style="text-align: left; font-size: 20px; color: white;">
                        <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">SENDER/CONSIGNER</th>
                        <th bgcolor="#d9d9d9" style="background-color:#d9d9d9;border: 1px solid #808080;height: 20px;font-weight: bold; background:rgb(127,127,127);">RECEIVER/CONSIGNEE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size: 20px;">
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
        </div>
    </main>

    <footer style="position:absolute; bottom:-120px; width:100%; height:60px;">
        <span style="font-size:13px;">New job is created and and sender branch is <b>{{isset($job)?$job->job_sender_branch->branches:$jobs->sender_name}}</b> and job is marked as pickup or job status is Ready for pickup.
            On creation of job system would lookup email address of <b>{{isset($job)?$job->job_sender_branch->branches:$jobs->sender_name}}</b> branch and send email.</span>
        {{--! <span style="font-size:13px;">
            A user goes to manage freight and updates the status to Ready for Pickup. The system looks up sender branch email and sends email.
        </span> --}}
    </footer>
</body>


</html>
