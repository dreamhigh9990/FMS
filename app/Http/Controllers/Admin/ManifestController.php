<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Models\Branches;
use App\Models\Job;
use App\Models\Job_items;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\Manifest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ManifestController extends Controller
{

    public function index()
    {
        //
        $title = 'Manifests';

        return view('admin.manifests.index', compact('title'));
    }

    public function create()
    {
        $title = 'Add New Manifest';
        $all_branches = Branches::all();
        $all_drivers = User::where('is_admin',2)->get();
        return view('admin.manifests.create', ['title'=>$title,'branches'=>$all_branches,'all_drivers'=>$all_drivers]);
    }

    public function store(Request $request)
    {
        $title = 'Created New Manifest';
        $this->validate($request, [
            'driver' => 'required',
            'dispatch_branch' => 'required',
            'receiving_branch' => 'required',
            'type' => 'required',
            'trailer_name'=>'required',
            'arrival_date' => 'required'
        ]);

        $input = $request->all();



        $manifest = new Manifest();
        $manifest->driver = $input['driver'];
        $manifest->dispatch_branch = $input['dispatch_branch'];
        $manifest->receiving_branch = $input['receiving_branch'];
        $manifest->type = $input['type'];
        $manifest->trailer = $input['trailer_name'];
        $manifest->arrival_date = $input['arrival_date'];
        $manifest->save();
        if ($manifest) {
            $title = 'manifest jobs';
            $all_branches = Branches::all();
            $all_drivers = User::where('is_admin',2)->get();

            $driver_jobs = Job::where('manifest_id',null)->with(['job_sender','job_receiver','job_current_branch'])->get();
            $manifest_jobs = Job::where('assigned_driver',$manifest->driver)->where('manifest_id',$manifest->id)->with(['job_sender','job_receiver','job_current_branch'])->get();


            return view('admin.manifests.manifest_job',['title'=>$title,
                'manifest'=>$manifest,
                'all_branches'=>$all_branches,
                'all_drivers'=>$all_drivers,
                'driver_jobs'=>$driver_jobs,
                'manifest_jobs'=>$manifest_jobs]);
        }
    }

    private function sqlDate($date)
    {
        $date = explode('/', $date);
        //month
        $month = $date[0];
        //day
        $day = $date[1];
        //year
        $year = $date[2];
        return $year . '-' . $month . '-' . $day;
    }

    public function edit($id)
    {
        $manifest = Manifest::where('id', $id)->first();

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
            'manifest_jobs' => $manifest_jobs]);  }

    public function update(Request $request, $id)
    {
        //
        $manifest = Manifest::find($id);
        $this->validate($request, [
            'driver' => 'required',
            'dispatch_branch' => 'required',
            'receiving_branch' => 'required',
            'type' => 'required',
            'trailer_name'=>'required',
            'arrival_date' => 'required'
        ]);
        $input = $request->all();


        $manifest->driver = $input['driver'];
        $manifest->dispatch_branch = $input['dispatch_branch'];
        $manifest->receiving_branch = $input['receiving_branch'];
        $manifest->type = $input['type'];
        $manifest->arrival_date = $input['arrival_date'];
        $manifest->trailer = $input['trailer_name'];

        $manifest->save();

        Session::flash('success_message', 'Great! Manifest successfully updated!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $manifest = Manifest::find($id);
        if ($manifest) {
            $manifest->delete();
            Session::flash('success_message', 'Manifest successfully deleted!');
        }
        return redirect()->route('manifest.index');
    }

    public function getManifests(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'id',
            2 => 'driver',
            3 => 'dispatch_branch',
            4 => 'receiving_branch',
            5 => 'type',
            6 => 'arrival_date',
            7 => 'action'
        );

        $colSearch = array();
        $colSearch_chk = false;

        for ($i = 0; $i <= 6; $i++) {
            $req = $request->input("columns.${i}.search.value");
            $colSearch[$i] = "%${req}%";
            if(!empty($req)){
                $colSearch_chk = true;
            }
        }

        $totalData = Manifest::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))  && !$colSearch_chk ) {
            $manifests = Manifest::offset($start)->limit($limit)->orderBy($order, $dir)->with('driver_name')->with('from_manifest')->with('to_manifest')->get();
            $totalFiltered = Manifest::all()->count();

        } else {
            $search = $request->input('search.value');
            $manifests = Manifest::where(function($q) use ($colSearch){
                    $q->WhereHas('from_manifest', function ($query) use ($colSearch) {
                        $query->where('branches', 'like', $colSearch[3]);
                    })->WhereHas('to_manifest', function ($query) use ($colSearch) {
                        $query->where('branches', 'like', $colSearch[4]);
                    })->WhereHas('driver_name', function ($query) use ($colSearch) {
                        $query->where('name', 'like', $colSearch[2]);
                    })->Where([
                        ['type', 'like', $colSearch[5]]
                    ])->Where([
                        ['arrival_date', 'like', $colSearch[6]]
                    ]);
                })
                ->where(function($q) use ($search){
                    $q->WhereHas('from_manifest', function ($query) use ($search) {
                        $query->where('branches', 'like', '%'.$search.'%');
                    })->orWhereHas('to_manifest', function ($query) use ($search) {
                        $query->where('branches', 'like', '%'.$search.'%');
                    })->orWhereHas('driver_name', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    })->orWhere([
                        ['type', 'like', "%{$search}%"]
                    ])->orWhere([
                        ['arrival_date', 'like', "%{$search}%"]
                    ]);
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered =
            Manifest::where(function($q) use ($colSearch){
                    $q->WhereHas('from_manifest', function ($query) use ($colSearch) {
                        $query->where('branches', 'like', $colSearch[3]);
                    })->WhereHas('to_manifest', function ($query) use ($colSearch) {
                        $query->where('branches', 'like', $colSearch[4]);
                    })->WhereHas('driver_name', function ($query) use ($colSearch) {
                        $query->where('name', 'like', $colSearch[2]);
                    })->Where([
                        ['type', 'like', $colSearch[5]]
                    ])->Where([
                        ['arrival_date', 'like', $colSearch[6]]
                    ]);
                })
                ->where(function($q) use ($search){
                    $q->WhereHas('from_manifest', function ($query) use ($search) {
                        $query->where('branches', 'like', '%'.$search.'%');
                    })->orWhereHas('to_manifest', function ($query) use ($search) {
                        $query->where('branches', 'like', '%'.$search.'%');
                    })->orWhereHas('driver_name', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    })->orWhere([
                        ['type', 'like', "%{$search}%"]
                    ])->orWhere([
                        ['arrival_date', 'like', "%{$search}%"]
                    ]);
                })
                ->orderBy($order, $dir)
                ->count();
        }
        $data = array();

        if ($manifests) {
            foreach ($manifests as $r) {
                $edit_url = route('manifest.edit', $r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['manifest_no'] = 'MT-'.$r->id;
                $nestedData['driver'] = $r->driver_name->name;
                $nestedData['dispatch_branch'] = $r->from_manifest['branches'];
                $nestedData['receiving_branch'] = $r->to_manifest['branches'];
                $nestedData['type'] = $r->type;
                $nestedData['arrival_date'] = $r->arrival_date;


                $nestedData['created_at'] = date('Y-m-d', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a href="'.route('print_manifest',$r->id).'" class="btn btn-sm btn-clean btn-icon" title="print Manifest">
                                        <i class="icon-1x text-dark-50 flaticon-download-1"></i>
                                    </a>
                                    <a title="Edit Manifest" class="btn btn-sm btn-clean btn-icon"
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

    public function deleteSelectedManifests(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $manifests = Manifest::find($id);
            if (isset($manifests)) {
                $manifests->delete();
            }
        }
        Session::flash('success_message', 'Manifest successfully deleted!');
        return redirect()->back();
    }

    public function getManifest(Request $request)
    {
        $manifest = Manifest::findOrFail($request->id);
        return view('admin.manifests.detail', ['title' => 'Manifest Detail', 'manifest' => $manifest]);
    }

    public function print_manifest($id){

        $all_jobs = Job::where('manifest_id',$id)->select('id','connote_no')->with('job_items')->get();

        $jobs_id = [];
        foreach ($all_jobs as $job){
            array_push($jobs_id,$job->id);
        }

        $job_items = Job_items::whereIn('job_id',$jobs_id)->with('item')->with('job')->get();
        $job_items_t_q = Job_items::whereIn('job_id',$jobs_id)->sum('item_qty');
        $job_items_t_w = Job_items::whereIn('job_id',$jobs_id)->sum('item_tweight');
        $job_items_t_m3 = Job_items::whereIn('job_id',$jobs_id)->sum('item_cubic_m3');
        $manifest = Manifest::where('id',$id)->first();

        $pdf = PDF::loadView('manifest_print',['job_items'=>$job_items,'manifest'=>$manifest,'t_q'=>$job_items_t_q,'t_w'=>$job_items_t_w,'t_m3'=>$job_items_t_m3])->setPaper('a4', 'landscape');
        return $pdf->stream('manifest_result.pdf');
        //return view('manifest_print');
    }
}
