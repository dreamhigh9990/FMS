<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class JobController extends Controller
{

    use ApiResponser;

    public function get_jobs(){

        $user_id =  auth()->user()->id;
        $jobs = Job::where('assigned_driver',$user_id)->orderBy('job_status', 'ASC')->with(['job_status_data','job_sender_branch','job_receiver_branch','job_total_price','job_sender','job_receiver','job_pallet_control','job_load_restraints','job_items'])->get();
        return $this->showAll($jobs, 200);
    }


    public function get_single_job(Request $request){

        $job_id = $request->job_id;
        $job = Job::where('id',$job_id)->with(['job_status_data','job_sender_branch','job_receiver_branch','job_total_price','job_sender','job_receiver','job_pallet_control','job_load_restraints','job_items'])->first();
        return $this->showAll($job, 200);
    }

    public function update_job_status(Request $request){
        $input = $request->all();
        $connote_no = str_replace(' ', '', $input['connote_no']);

        //get connote with connote_no
        $connote = Job::where('connote_no',$connote_no)->where('receiver_branch',$input['dispatch_branch'])->first();
        if($connote){
            $connote->job_status = $input['status'];
            $connote->save();

            return response()->json(['status'=>true,'message' => 'Job status updated successfully'], 200);
        }
    }
}
