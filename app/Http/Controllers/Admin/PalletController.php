<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job_pallet_control;
use App\Models\Job_sender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PalletController extends Controller
{

    public function index()
    {
        //
        $title = 'Pallet Control';

        return view('admin.pallet.index', compact('title'));
    }

    public function getOutstanding(Request $request)
    {
        //
        $outstanding = Job_pallet_control::orderBy('job_id','DESC')->with(['job','job_sender'])->get();
        // $job = Job::where('id', $id)->with(['job_status_data', 'job_current_branch', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();
        echo json_encode($outstanding);
    }
    public function getTransaction(Request $request)
    {
        //
        $outstanding = Job_pallet_control::orderBy('job_id','DESC')->with(['job','job_sender'])->get();
        echo json_encode($outstanding);
    }
}
