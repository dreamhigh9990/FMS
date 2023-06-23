<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerContacts;
use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cContacts = CustomerContacts::where('customer_id',112)->get();
        echo json_encode($cContacts);
    }

    public function getContacts(Request $request)
    {
        //
        $cContacts = CustomerContacts::where('customer_id',$request->input('customer_id'))->get();
        echo json_encode($cContacts);
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

        $cContact = new CustomerContacts();
        $cContact ->customer_id = $data['customer_id'];
        $cContact->contact_name = $data['contact_name'];
        $cContact->position = $data['position'];
        $cContact->mobile_phone = $data['mobile_phone'];
        $cContact->office_phone = $data['office_phone'];
        $cContact->email = $data['email'];
        $cContact->alerts = $data['alerts'];
        $cContact -> save();
        echo json_encode($cContact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerContacts  $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerContacts $customerContacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerContacts  $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerContacts $customerContacts)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerContacts  $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerContacts $customerContacts)
    {
    }

    public function updateContact(Request $request)
    {
        //
        $data = $request->all();

        $cContact = CustomerContacts::find($data['id']);
        // $cContact ->customer_id = $data['customer_id'];
        $cContact->contact_name = $data['contact_name'];
        $cContact->position = $data['position'];
        $cContact->mobile_phone = $data['mobile_phone'];
        $cContact->office_phone = $data['office_phone'];
        $cContact->email = $data['email'];
        $cContact->alerts = $data['alerts'];
        $cContact -> save();

        echo json_encode($cContact);
    }

    public function deleteContact(Request $request)
    {
        $cContact = CustomerContacts::find($request['id']);
        $res = $cContact->delete();
        echo $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerContacts  $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
