<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Job;
use App\Models\Manifest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpseclib3\File\ASN1\Maps\RelativeDistinguishedName;

class JobManifestController extends Controller
{
    public function add_job_to_manifest(Request $request)
    {
        $manifest_id = $request->manifest_id;
        $manifest = Manifest::where('id', $manifest_id)->first();

        if ($request->jobs != null) {
            foreach ($request->jobs as $job) {
                $job = Job::where('id', '=', $job)->first();
                $job->manifest_id = $manifest_id;
                $job->assigned_driver = $manifest->driver;
                $job->save();
            }



            $title = 'manifest jobs';
            $all_branches = Branches::all();
            $all_drivers = User::where('is_admin', 2)->get();
            $driver_jobs = Job::where('manifest_id', null)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();
            $manifest_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', $manifest->id)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();

            return view('admin.manifests.manifest_job', ['title' => $title,
                'manifest' => $manifest,
                'all_branches' => $all_branches,
                'all_drivers' => $all_drivers,
                'driver_jobs' => $driver_jobs,
                'manifest_jobs' => $manifest_jobs]);
        }else{

            $manifest = Manifest::where('id', $manifest_id)->first();

            $title = 'manifest jobs';
            $all_branches = Branches::all();
            $all_drivers = User::where('is_admin', 2)->get();
            $driver_jobs = Job::where('manifest_id', null)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();
            $manifest_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', $manifest->id)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();

            //return $driver_jobs;
            return view('admin.manifests.manifest_job', ['title' => $title,
                'manifest' => $manifest,
                'all_branches' => $all_branches,
                'all_drivers' => $all_drivers,
                'driver_jobs' => $driver_jobs,
                'manifest_jobs' => $manifest_jobs]);
        }


    }

    public function remove_jobs_from_manifest(Request $request)
    {
        $manifest_id = $request->manifest_id;
        if ($request->jobs != null) {
            foreach ($request->jobs as $job) {
                $job = Job::where('id', '=', $job)->first();
                $job->manifest_id = null;
                $job->save();
            }

            $manifest = Manifest::where('id', $manifest_id)->first();

            $title = 'manifest jobs';
            $all_branches = Branches::all();
            $all_drivers = User::where('is_admin', 2)->get();
            $driver_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', null)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();
            $manifest_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', $manifest->id)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();

            //return $driver_jobs;
            return view('admin.manifests.manifest_job', ['title' => $title,
                'manifest' => $manifest,
                'all_branches' => $all_branches,
                'all_drivers' => $all_drivers,
                'driver_jobs' => $driver_jobs,
                'manifest_jobs' => $manifest_jobs]);


        } else {
            $manifest = Manifest::where('id', $manifest_id)->first();

            $title = 'manifest jobs';
            $all_branches = Branches::all();
            $all_drivers = User::where('is_admin', 2)->get();
            $driver_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', null)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();
            $manifest_jobs = Job::where('assigned_driver', $manifest->driver)->where('manifest_id', $manifest->id)->with(['job_sender', 'job_receiver', 'job_current_branch'])->get();

            //return $driver_jobs;
            return view('admin.manifests.manifest_job', ['title' => $title,
                'manifest' => $manifest,
                'all_branches' => $all_branches,
                'all_drivers' => $all_drivers,
                'driver_jobs' => $driver_jobs,
                'manifest_jobs' => $manifest_jobs]);
        }

    }

    public function update_manifest(Request $request){
        $title = 'Update Manifest';
        $this->validate($request, [
            'driver' => 'required',
            'dispatch_branch' => 'required',
            'receiving_branch' => 'required',
            'type' => 'required',
            'trailer_name'=>'required',
            'arrival_date' => 'required'
        ]);

        $input = $request->all();

        $manifest = Manifest::where('id',$input['manifest_id'])->first();
        $manifest->driver = $input['driver'];
        $manifest->dispatch_branch = $input['dispatch_branch'];
        $manifest->receiving_branch = $input['receiving_branch'];
        $manifest->type = $input['type'];
        $manifest->trailer = $input['trailer_name'];
        $manifest->arrival_date = $input['arrival_date'];
        $manifest->save();

        Session::flash('success_message', 'Great! manifest has been update successfully!');
        return redirect()->route('manifest.index');
    }

}
