<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerInvoices;
use Illuminate\Http\Request;

class CustomerInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cInvoices = CustomerInvoices::where('customer_id',112)->get();
        echo json_encode($cInvoices);
    }

    public function getInvoices(Request $request)
    {
        //
        $cInvoices = CustomerInvoices::where('customer_id',$request->input('customer_id'))->get();
        echo json_encode($cInvoices);
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

        $cInvoice = new CustomerInvoices();
        $cInvoice ->customer_id = $data['customer_id'];
        $cInvoice->invoice_no = $data['invoice_no'];
        $cInvoice->consignment = $data['consignment'];
        $cInvoice->sender = $data['sender'];
        $cInvoice->receiver = $data['receiver'];
        $cInvoice->delivery_date = $data['delivery_date'];
        $cInvoice->amount = $data['amount'];
        $cInvoice -> save();
        echo json_encode($cInvoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerInvoices  $customerInvoices
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerInvoices $customerInvoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerInvoices  $customerInvoices
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerInvoices $customerInvoices)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerInvoices  $customerInvoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerInvoices $customerInvoices)
    {
    }

    public function updateInvoice(Request $request)
    {
        //
        $data = $request->all();

        $cInvoice = CustomerInvoices::find($data['id']);
        // $cInvoice ->customer_id = $data['customer_id'];
        $cInvoice->invoice_no = $data['invoice_no'];
        $cInvoice->consignment = $data['consignment'];
        $cInvoice->sender = $data['sender'];
        $cInvoice->receiver = $data['receiver'];
        $cInvoice->delivery_date = $data['delivery_date'];
        $cInvoice->amount = $data['amount'];
        $cInvoice -> save();

        echo json_encode($cInvoice);
    }

    public function deleteInvoice(Request $request)
    {
        $cInvoice = CustomerInvoices::find($request['id']);
        $res = $cInvoice->delete();
        echo $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerInvoices  $customerInvoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
