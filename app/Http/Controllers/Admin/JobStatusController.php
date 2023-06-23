<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobStatus;
use Illuminate\Support\Facades\Session;

class JobStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Job Status';
        return view('admin.jobstatus.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Job Status';
        return view('admin.jobstatus.create', compact('title'));
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
        $title = 'New Job Status';
        $this->validate($request, [
            'job_status' => 'required',
            'status_color' => 'required',
        ]);

        $input = $request->all();

        $jobstatus = new JobStatus();
        $jobstatus->job_status = $input['job_status'];
        $jobstatus->status_color = $input['status_color'];

        $jobstatus->save();

        //Session::flash('success_message', 'Great! Customer has been saved successfully!');
        // $pricing->save();

        //$all_plans = pricing_plans::all();
        if ($jobstatus) {
            Session::flash('success_message', 'Great! Created New Pricing!');
            return view('admin.jobstatus.index', ['title' => $title]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = JobStatus::where('id', $id)->first();
        $title = "Edit Status details";
        var_dump($status);
        return view('admin.jobstatus.edit', ['status' => $status,  'title' => $title]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = JobStatus::find($id);
        $this->validate($request, [
            'job_status' => 'required',
            'status_color' => 'required',
        ]);
        $input = $request->all();

        $status->job_status = $input['job_status'];
        $status->status_color = $input['status_color'];

        $status->save();

        Session::flash('success_message', 'Great! Status successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $jobstatus = JobStatus::find($id);
        if ($jobstatus) {
            $jobstatus->delete();
            Session::flash('success_message', 'Job Status successfully deleted!');
        }
        return redirect()->route('jobstatus.index');
    }
    public function getJobsStatus(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'job_status',
            2 => 'action'
        );

        $totalData = JobStatus::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $jobs_status = JobStatus::offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = JobStatus::all()->count();
        } else {
            $search = $request->input('search.value');
            $jobs_status = JobStatus::where([
                ['job_status', 'like', "%{$search}%"]
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =
                JobStatus::where([
                    ['job_status', 'like', "%{$search}%"]
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }


        $data = array();

        if ($jobs_status) {
            foreach ($jobs_status as $r) {
                $edit_url = route('jobstatus.edit', $r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                if (!$r->status_color){
                    $r->status_color = "grey";
                }
                $nestedData['job_status'] = "
                <td> <div class='mr-2' style='width: 12px;height: 12px; display: inline-table; background-color: ".$r->status_color." !important'></div>".$r->job_status."</td>";
                
                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                <a title="Edit Items" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Manifest" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                </td>
                                </div>
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    public function deleteSelectedStatus(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $pricing = JobStatus::find($id);
            if (isset($pricing)) {
                $pricing->delete();
            }
        }
        Session::flash('success_message', 'Selected Job Status have been successfully deleted!');
        return redirect()->back();
    }
}
