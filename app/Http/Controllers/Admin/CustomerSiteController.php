<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerSites;
use Illuminate\Http\Request;

class CustomerSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cSites = CustomerSites::where('customer_id',112)->get();
        echo json_encode($cSites);
    }

    public function getSites(Request $request)
    {
        //
        $cSites = CustomerSites::where('customer_id',$request->input('customer_id'))->get();
        echo json_encode($cSites);
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

        $cSite = new CustomerSites();
        $cSite ->customer_id = $data['customer_id'];
        $cSite->site_name = $data['site_name'];
        $cSite->address_line_1 = $data['address_line_1'];
        $cSite->address_line_2 = $data['address_line_2'];
        $cSite->suburb = $data['suburb'];
        $cSite->postal_code = $data['postal_code'];
        $cSite->state = $data['state'];
        $cSite->operating_hours = $data['operating_hours'];
        $cSite->site_contact = $data['site_contact'];
        $cSite -> save();

        echo json_encode($cSite);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerSites  $customerSites
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerSites $customerSites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerSites  $customerSites
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerSites $customerSites)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerSites  $customerSites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSites $customerSites)
    {
    }

    public function updateSite(Request $request)
    {
        //
        $data = $request->all();

        $cSite = CustomerSites::find($data['id']);
        // $cSite ->customer_id = $data['customer_id'];
        $cSite->site_name = $data['site_name'];
        $cSite->address_line_1 = $data['address_line_1'];
        $cSite->address_line_2 = $data['address_line_2'];
        $cSite->suburb = $data['suburb'];
        $cSite->postal_code = $data['postal_code'];
        $cSite->state = $data['state'];
        $cSite->operating_hours = $data['operating_hours'];
        $cSite->site_contact = $data['site_contact'];
        $cSite -> save();

        echo json_encode($cSite);
    }

    public function deleteSite(Request $request)
    {
        $cSite = CustomerSites::find($request['id']);
        $res = $cSite->delete();
        echo $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerSites  $customerSites
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
