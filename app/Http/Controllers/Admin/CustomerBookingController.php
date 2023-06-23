<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerBookings;
use App\Models\User;
use App\Models\Job;
use Illuminate\Http\Request;

class CustomerBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cBookings = CustomerBookings::where('customer_id', 112)->get();
        echo json_encode($cBookings);
    }

    public function getBookings(Request $request)
    {
        //
        // $cBookings = CustomerBookings::where('customer_id', $request->input('customer_id'))->get();
        $customer = User::find($request->input('customer_id'));

        $jobs = Job::Join('job_senders', 'jobs.id', '=', 'job_senders.job_id')->where('sender_name', $customer['name'])
        ->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])
        ->get();

        // var_dump($customer['name'], $jobs);
        echo json_encode($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $cBooking = new CustomerBookings();
        $cBooking->customer_id = $data['customer_id'];
        $cBooking->statusv = $data['statusv'];
        $cBooking->consignment = $data['consignment'];
        $cBooking->item_qty = $data['item_qty'];
        $cBooking->sender = $data['sender'];
        $cBooking->receiver = $data['receiver'];
        $cBooking->delivery_date = $data['delivery_date'];
        $cBooking->amount = $data['amount'];
        $cBooking->save();
        echo json_encode($cBooking);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerBookings  $customerBookings
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerBookings $customerBookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerBookings  $customerBookings
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerBookings $customerBookings)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerBookings  $customerBookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerBookings $customerBookings)
    {
    }

    public function updateBooking(Request $request)
    {
        //
        $data = $request->all();

        $cBooking = CustomerBookings::find($data['id']);
        // $cBooking ->customer_id = $data['customer_id'];
        $cBooking->statusv = $data['statusv'];
        $cBooking->consignment = $data['consignment'];
        $cBooking->item_qty = $data['item_qty'];
        $cBooking->sender = $data['sender'];
        $cBooking->receiver = $data['receiver'];
        $cBooking->delivery_date = $data['delivery_date'];
        $cBooking->amount = $data['amount'];
        $cBooking->save();

        echo json_encode($cBooking);
    }

    public function deleteBooking(Request $request)
    {
        $cBooking = CustomerBookings::find($request['id']);
        $res = $cBooking->delete();
        echo $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerBookings  $customerBookings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
