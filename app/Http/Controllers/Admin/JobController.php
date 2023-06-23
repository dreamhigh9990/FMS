<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Items;
use App\Models\Job;
use App\Models\job_item_dg_detail;
use App\Models\Job_items;
use App\Models\Job_load_restraints;
use App\Models\Job_pallet_control;
use App\Models\Job_receiver;
use App\Models\Job_sender;
use App\Models\Job_total_price;
use App\Models\JobStatus;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mail;

use Exception;

use DateTime;
use LangleyFoxall\XeroLaravel\OAuth2;
use League\OAuth2\Client\Token\AccessToken;

class JobController extends Controller
{

    public function index()
    {
        $title = "Manage Freight";

        $all_statuses = JobStatus::orderBy('job_status', 'ASC')->get();
        $all_branches = Branches::orderBy('branches', 'ASC')->get();
        $all_drivers = User::where('is_admin', 2)->get();

        return view('admin.jobs.index', [
            'title' => $title,
            'all_statuses' => $all_statuses,
            'all_branches' => $all_branches,
            'all_drivers' => $all_drivers
        ]);
    }

    public function create()
    {
        $title = 'create new job';
        $customer = User::where('is_admin', 0)->get();
        $all_status = JobStatus::all();
        $all_branches = Branches::orderBy('branches')->get();
        $all_items = Items::all();
        $all_drivers = User::where('is_admin', 2)->get();
        $job_no = rand(1000, 10000);
        $connote_no = 'WT-0' . $job_no;
        return view(
            'admin.jobs.create',
            [
                'title' => $title,
                'customers' => $customer,
                'all_status' => $all_status,
                'all_branches' => $all_branches,
                'all_items' => $all_items,
                'job_no' => $job_no,
                'connote_no' => $connote_no,
                'all_drivers' => $all_drivers
            ]
        );
    }
    public function edit($id)
    {
        $job = Job::where('id', $id)
            ->with('driver')
            ->with('manifest')
            ->with('job_notes')
            ->with('job_photos')
            ->with('job_sender_branch')
            ->with('job_current_branch')
            ->with('job_receiver_branch')
            ->with('job_status_data')
            ->with('job_total_price')
            ->with('job_sender')
            ->with('job_receiver')
            ->with('job_pallet_control')
            ->with('job_load_restraints')
            ->with('job_items')->first();

        $title = "Edit Freight details";

        $customer = User::where('is_admin', 0)->get();
        $all_status = JobStatus::all();
        $all_branches = Branches::orderBy('branches')->get();
        $all_items = Items::all();
        $all_drivers = User::where('is_admin', 2)->get();
        $job_no = rand(1000, 10000);
        $connote_no = 'WT-0' . $job_no;

        // var_dump($job);
        // die;
        return view('admin.jobs.create', [
            'job' => $job,
            'title' => $title,
            'customers' => $customer,
            'all_status' => $all_status,
            'all_branches' => $all_branches,
            'all_items' => $all_items,
            'job_no' => $job_no,
            'connote_no' => $connote_no,
            'all_drivers' => $all_drivers
        ]);
    }
    public function getFreight(Request $request)
    {

        $columns = array(
            0 => 'id',
            1 => 'connote_no',
            2 => 'm_connote_no',
            3 => 'job_status',
            4 => 'sender_name',
            5 => 'sender_branch',
            6 => 'receiver_branch',
            7 => 'current_branch',
            8 => 'jobs.created_at'
        );

        $colSearch = array();
        $colSearch_chk = false;

        for ($i = 0; $i <= 8; $i++) {
            $req = $request->input("columns.${i}.search.value");
            $colSearch[$i] = "%${req}%";
            if (!empty($req)) {
                $colSearch_chk = true;
            }
        }


        // var_dump($colSearch);
        // die;
        // var_dump(empty($request->input('search.value')),$colSearch_chk, $colSearch);
        // die;
        $totalData = Job::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($request->input('search.value')) && !$colSearch_chk) {

            $jobs = Job::Join('job_senders', 'jobs.id', '=', 'job_senders.job_id')->offset($start)->limit($limit)->orderBy($order, $dir)->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch', 'job_current_branch'])
                ->whereHas('job_status_data', function ($query) use ($colSearch) {
                    $query->where('job_status', 'not like', '%Complete%')
                        ->where('job_status', 'not like', '%Delivered%')
                        ->where('job_status', 'not like', '%closed%');
                })
                ->get();
            $totalFiltered = Job::Join('job_senders', 'jobs.id', '=', 'job_senders.job_id')->offset($start)->limit($limit)->orderBy($order, $dir)->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch', 'job_current_branch'])
                ->whereHas('job_status_data', function ($query) use ($colSearch) {
                    $query->where('job_status', 'not like', '%Complete%')
                        ->where('job_status', 'not like', '%Delivered%')
                        ->where('job_status', 'not like', '%closed%');
                })->count();
            //return $jobs;
        } else {
            $jobs = Job::Join('job_senders', 'jobs.id', '=', 'job_senders.job_id')
                ->where(function ($q) use ($colSearch) {
                    $q->where('connote_no', 'like', $colSearch[1])
                        ->where(function ($query) use ($colSearch) {
                            if ($colSearch[2] !== "%%") {
                                $query->where('m_connote_no', 'like', $colSearch[2]);
                            }
                        })
                        ->where('sender_name', 'like', $colSearch[4])
                        ->whereHas('job_status_data', function ($query) use ($colSearch) {
                            if ($colSearch[0] != "%1%") {
                                $query->where('job_status', 'not like', '%complete%')
                                    ->where('job_status', 'not like', '%Delivered%')
                                    ->where('job_status', 'not like', '%closed%')
                                    ->where('job_status', 'like', $colSearch[3]);
                            } else {
                                $query->where('job_status', 'like', $colSearch[3]);
                            }
                        })
                        ->whereHas('job_sender_branch', function ($query) use ($colSearch) {
                            $query->where('branches', 'like', $colSearch[5]);
                        })
                        ->whereHas('job_receiver_branch', function ($query) use ($colSearch) {
                            $query->where('branches', 'like', $colSearch[6]);
                        })
                        ->where(function ($query) use ($colSearch) {
                            if ($colSearch[7] !== "%%") {
                                $query->whereHas('job_current_branch', function ($query1) use ($colSearch) {
                                    $query1->where('branches', 'like', $colSearch[7]);
                                });
                            }
                        })
                        // ->where(function($query) use ($colSearch){
                        //     if($colSearch[0]!="%1%"){
                        //         $query->whereHas('job_status_data', function ($query1) use ($colSearch) {
                        //             $query1->where('job_status', 'not like', '%Complete%')
                        //             ->where('job_status', 'not like', '%Delivered%')
                        //             ->where('job_status', 'not like', '%closed%');
                        //         });
                        //     }
                        // })
                        ->where([
                            [DB::raw("DATE_FORMAT(date_add(date(CONVERT_TZ(jobs.created_at, '+00:00','+10:00')), interval 1 day),'%d-%m-%Y')"), 'like', $colSearch[8]],
                        ]);
                })
                ->where(function ($q) use ($search) {
                    $q->where('connote_no', 'like', "%{$search}%")
                        ->orwhere('sender_name', 'like', "%{$search}%")
                        ->orwhere('m_connote_no', 'like', "%{$search}%")
                        ->orWhereHas('job_status_data', function ($query) use ($search) {
                            $query->where('job_status', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_sender_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_receiver_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_current_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orwhere([
                            [DB::raw("DATE_FORMAT(date_add(date(CONVERT_TZ(jobs.created_at, '+00:00','+10:00')), interval 1 day),'%d-%m-%Y')"), 'like', "%{$search}%"],
                        ]);
                })
                ->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();


            $totalFiltered =
                Job::Join('job_senders', 'jobs.id', '=', 'job_senders.job_id')
                ->where(function ($q) use ($colSearch) {
                    $q->where('connote_no', 'like', $colSearch[1])
                        ->where(function ($query) use ($colSearch) {
                            if ($colSearch[2] != "%%") {
                                $query->where('m_connote_no', 'like', $colSearch[2]);
                            }
                        })
                        ->where('sender_name', 'like', $colSearch[4])
                        ->whereHas('job_status_data', function ($query) use ($colSearch) {
                            if ($colSearch[0] != "%1%") {
                                $query->where('job_status', 'not like', '%complete%')
                                    ->where('job_status', 'not like', '%Delivered%')
                                    ->where('job_status', 'not like', '%closed%')
                                    ->where('job_status', 'like', $colSearch[3]);
                            } else {
                                $query->where('job_status', 'like', $colSearch[3]);
                            }
                        })
                        ->whereHas('job_sender_branch', function ($query) use ($colSearch) {
                            $query->where('branches', 'like', $colSearch[5]);
                        })
                        ->whereHas('job_receiver_branch', function ($query) use ($colSearch) {
                            $query->where('branches', 'like', $colSearch[6]);
                        })
                        ->where(function ($query) use ($colSearch) {
                            if ($colSearch[7] !== "%%") {
                                $query->whereHas('job_current_branch', function ($query1) use ($colSearch) {
                                    $query1->where('branches', 'like', $colSearch[7]);
                                });
                            }
                        })
                        // ->where(function($query) use ($colSearch){
                        //     if($colSearch[0]!="%1%"){
                        //         $query->whereHas('job_status_data', function ($query1) use ($colSearch) {
                        //             $query1->where('job_status', 'not like', '%complete%')
                        //             ->where('job_status', 'not like', '%Delivered%')
                        //             ->where('job_status', 'not like', '%closed%');
                        //         });
                        //     }
                        // })
                        ->where([
                            [DB::raw("DATE_FORMAT(date_add(date(CONVERT_TZ(jobs.created_at, '+00:00','+10:00')), interval 1 day),'%d-%m-%Y')"), 'like', $colSearch[8]],
                        ]);
                })
                ->where(function ($q) use ($search) {
                    $q->where('connote_no', 'like', "%{$search}%")
                        ->orwhere('sender_name', 'like', "%{$search}%")
                        ->orwhere('m_connote_no', 'like', "%{$search}%")
                        ->orWhereHas('job_status_data', function ($query) use ($search) {
                            $query->where('job_status', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_sender_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_receiver_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('job_current_branch', function ($query) use ($search) {
                            $query->where('branches', 'like', '%' . $search . '%');
                        })
                        ->orwhere([
                            [DB::raw("DATE_FORMAT(date_add(date(CONVERT_TZ(jobs.created_at, '+00:00','+10:00')), interval 1 day),'%d-%m-%Y')"), 'like', "%{$search}%"],
                        ]);
                })
                ->orderBy($order, $dir)
                ->count();
        }

        $data = array();

        if ($jobs) {
            foreach ($jobs as $r) {
                $edit_url = route('jobs.edit', $r->job_id);
                $print_connote = route('export_pdf', $r->job_id);
                $print_label = route('export_label_pdf', $r->job_id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->job_id . '"><span></span></label></td>';
                $nestedData['connote_no'] = isset($r->connote_no) ? $r->connote_no : "";
                $nestedData['e_connote'] = isset($r->m_connote_no) ? $r->m_connote_no : "";
                // $nestedData['customer'] = isset($r->job_sender['sender_name'])?$r->job_sender['sender_name']:"";
                $nestedData['customer'] = $r->sender_name;
                $nestedData['sender_branch'] = $r->job_sender_branch['branches'];
                $nestedData['receiver_branch'] = $r->job_receiver_branch['branches'];
                $nestedData['current_branch'] = isset($r->job_current_branch) ? $r->job_current_branch['branches'] : "";;
                $nestedData['job_status'] = "<div class='row'><div class='col-6'><b>" . $r->job_status_data['job_status'] . "</b></div><div style=\"width: 15px;height: 15px; background-color: " . $r->job_status_data['status_color'] . ";margin-left: 20px\"></div></div>";

                //$nestedData['created_at'] = gettype($r->created_at);

                $date1 = date_create_from_format('Y-m-d', date('Y-m-d', strtotime($r->created_at->setTimezone(new \DateTimeZone('Australia/Sydney')) . ' +1 day')));
                $date2 = date_create_from_format('Y-m-d', date('Y-m-d'));
                $diff = (array) date_diff($date1, $date2);
                if ($diff['days'] >= 2) {
                    $edt_color = "<div style=\"width: 15px;height: 15px; background-color: red;margin-left: 20px\"></div>";
                } else if ($diff['days'] >= 1) {
                    $edt_color = "<div style=\"width: 15px;height: 15px; background-color: yellow;margin-left: 20px\"></div>";
                } else {
                    $edt_color = "";
                }

                $nestedData['created_at'] = "<div class='row mx-2'><div class='mr-2'> <b>" . date('d-m-Y', strtotime($r->created_at->setTimezone(new \DateTimeZone('Australia/Sydney')) . ' +1 day')) . "</b></div>${edt_color} </div>";

                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a title="Print Connote" class="btn btn-sm btn-clean btn-icon" target="_blank"
                                       href="' . $print_connote . '">
                                       <i class="icon-1x text-dark-50 flaticon-download-1"></i>
                                    </a>
                                    <a title="Print Label" class="btn btn-sm btn-clean btn-icon" target="_blank"
                                       href="' . $print_label . '">
                                       <i class="icon-1x text-dark-50 flaticon-price-tag"></i>
                                    </a>
                                    <a title="Edit Freight" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->job_id . ');" title="Delete Jobs" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                </td>
                                </div>';
                $data[] = $nestedData;
            }
        }

        //<a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Job" href="javascript:void(0)">
        //<i class="icon-1x text-dark-50 flaticon-delete"></i>
        //</a>
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function deleteSelectedFreights(Request $request)
    {
        $input = $request->all();
        var_dump($input);
        // die;
        $this->validate($request, [
            'clients' => 'required',

        ]);
        var_dump($this);

        foreach ($input['clients'] as $index => $id) {
            $job = Job::find($id);
            if ($job) {
                $job->delete();
            }
        }
        Session::flash('success_message', 'customer successfully deleted!');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        //store job




        // $request->validate([
        //     'm_file' => 'mimes:txt,pdf,jpeg,jpg,docx,doc,ppt,pptx,xls,xlsx',
        //     'job_type' => 'required',
        //     'job_status' => 'required',
        //     'sender_name' => 'required',
        //     'sender_address_line_1' => 'required',
        //     'sender_address_line_2' => 'required',
        //     'sender_state' => 'required',
        //     'sender_contact' => 'required',
        //     'sender_branch' => 'required',
        //     'receiver_name' => 'required',
        //     'receiver_address_line_1' => 'required',
        //     'receiver_address_line_2' => 'required',
        //     'receiver_state' => 'required',
        //     'receiver_contact' => 'required',
        //     'receiver_branch' => 'required',
        //     'item_qty' => 'required',
        //     'item_type' => 'required',
        //     'item_length' => ['required', 'numeric'],
        //     'item_width' => ['required', 'numeric'],
        //     'item_height' => ['required', 'numeric'],
        //     'item_weight' => ['required', 'numeric'],
        // ]);

        $file = $request->file('m_file');
        $fileName = null;
        if ($file != null) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $fileName);
        }


        $item_dg_data = json_decode($request->item_dg_data);

        $job = new Job();
        if ($request->jid != '') {
            $job = Job::find($request->jid);
        }

        $job->job_no = $request->job_no;
        $job->m_file = $fileName;
        $job->connote_no = $request->connote_no;
        $job->m_reference = $request->m_reference;
        $job->quote_no = $request->quote_no;
        $job->m_connote_no = $request->m_connote_no;
        $job->job_type = $request->job_type;
        $job->assigned_driver = $request->assigned_driver;
        $job->job_status = $request->job_status;
        $job->sender_branch = $request->sender_branch;
        $job->receiver_branch = $request->receiver_branch;
        $job->save();
        if ($job) {
            $job_id = $job->id;
            $sender_detail = new Job_sender();
            if ($request->jsender != '') {
                $sender_detail = Job_sender::find($request->jsender);
            }
            $sender_detail->job_id = $job_id;
            $sender_detail->sender_name = $request->sender_name;
            $sender_detail->sender_address_line_1 = $request->sender_address_line_1;
            $sender_detail->sender_address_line_2 = $request->sender_address_line_2;
            $sender_detail->suburb = $request->suburb;
            $sender_detail->postal_code = $request->postal_code;
            $sender_detail->sender_state = $request->sender_state;
            $sender_detail->s_time = $request->s_time;
            $sender_detail->sender_contact = $request->sender_contact;
            $sender_detail->s_phone = $request->s_phone;
            $sender_detail->charge_collector_name = $request->charge_collector_name;
            $sender_detail->charge_collector_cost = $request->charge_collector_cost;
            $sender_detail->ready_date = $request->ready_date;
            $sender_detail->ready_time = $request->ready_time;
            $sender_detail->Pick_up_notes = $request->Pick_up_notes;
            $sender_detail->save();

            $receiver_detail = new Job_receiver();
            if ($request->jreceiver != '') {
                $receiver_detail = Job_receiver::find($request->jreceiver);
            }
            $receiver_detail->job_id = $job_id;
            $receiver_detail->receiver_name = $request->receiver_name;
            $receiver_detail->receiver_address_line_1 = $request->receiver_address_line_1;
            $receiver_detail->receiver_address_line_2 = $request->receiver_address_line_2;
            $receiver_detail->r_suburb = $request->r_suburb;
            $receiver_detail->r_postal_code = $request->r_postal_code;
            $receiver_detail->receiver_state = $request->receiver_state;
            $receiver_detail->r_time = $request->r_time;
            $receiver_detail->receiver_contact = $request->receiver_contact;
            $receiver_detail->r_phone = $request->r_phone;
            $receiver_detail->onforworder = $request->onforworder;
            $receiver_detail->r_Pick_up_notes = $request->r_Pick_up_notes;
            $receiver_detail->save();

            for ($i = 0; $i < count($request->random_no); $i++) {
                $job_item = new Job_items();
                if (isset($request->jitem[$i]) && $request->jitem[$i] != '') {
                    $job_item = Job_items::find($request->jitem[$i]);
                }
                $job_item->job_id = $job_id;
                if (isset($request->item_stackable[$i])) {
                    $job_item->item_stackable = $request->item_stackable[$i];
                } else {
                    $job_item->item_stackable = 'off';
                }
                $job_item->random_no = $request->random_no[$i];
                $job_item->item_reference = $request->item_reference[$i];
                $job_item->item_qty = $request->item_qty[$i];
                $job_item->item_type = $request->item_type[$i];
                $job_item->item_description = $request->item_description[$i];
                $job_item->item_length = $request->item_length[$i];
                $job_item->item_width = $request->item_width[$i];
                $job_item->item_height = $request->item_height[$i];
                $job_item->item_weight = $request->item_weight[$i];
                $job_item->item_tweight = $request->item_tweight[$i];
                $job_item->item_plt_spc = $request->item_plt_spc[$i];
                $job_item->item_cubic_m3 = $request->item_cubic_m3[$i];
                $job_item->item_cost = $request->item_cost[$i];
                $job_item->item_comments = $request->item_comments[$i];
                $job_item->item_detail = $request->item_detail[$i];
                $job_item->save();
            }

            // for($j=0; $j < count($item_dg_data); $j++){
            //     $job_item_dg_detail = new job_item_dg_detail();
            //     $item_id = Job_items::where('random_no',$item_dg_data[$j]->o_random_no)->value('id');
            //     $job_item_dg_detail->item_id = $item_id;
            //     $job_item_dg_detail->o_random_no = $item_dg_data[$j]->o_random_no;
            //     $job_item_dg_detail->o_dg_name = $item_dg_data[$j]->o_dg_name;
            //     $job_item_dg_detail->o_dg_no = $item_dg_data[$j]->o_dg_no;
            //     $job_item_dg_detail->o_dg_group = $item_dg_data[$j]->o_dg_group;
            //     $job_item_dg_detail->o_dg_class = $item_dg_data[$j]->o_dg_class;

            //     $job_item_dg_detail->save();
            // }



            $job_load_restraints = new Job_load_restraints();
            if ($request->jload_restraints != '') {
                $job_load_restraints = Job_load_restraints::find($request->jload_restraints);
            }
            $job_load_restraints->job_id = $job_id;

            if (isset($request->bolsters)) {
                $job_load_restraints->bolsters = $request->bolsters;
            } else {
                $job_load_restraints->bolsters = 'off';
            }

            if (isset($request->chains)) {
                $job_load_restraints->chains = $request->chains;
            } else {
                $job_load_restraints->chains = 'off';
            }

            if (isset($request->dogs)) {
                $job_load_restraints->dogs = $request->dogs;
            } else {
                $job_load_restraints->dogs = 'off';
            }

            if (isset($request->gates)) {
                $job_load_restraints->gates = $request->gates;
            } else {
                $job_load_restraints->gates = 'off';
            }

            if (isset($request->rt)) {
                $job_load_restraints->rt = $request->rt;
            } else {
                $job_load_restraints->rt = 'off';
            }

            if (isset($request->straps)) {
                $job_load_restraints->straps = $request->straps;
            } else {
                $job_load_restraints->straps = 'off';
            }

            if (isset($request->timber)) {
                $job_load_restraints->timber = $request->timber;
            } else {
                $job_load_restraints->timber = 'off';
            }

            if (isset($request->trap)) {
                $job_load_restraints->trap = $request->trap;
            } else {
                $job_load_restraints->trap = 'off';
            }

            $job_load_restraints->save();

            //-------- Pallet control--------------
            $job_pallet_controls = new Job_pallet_control();
            if ($request->jpallet_control != '') {
                $job_pallet_controls = Job_pallet_control::find($request->jpallet_control);
            }
            $job_pallet_controls->job_id = $job_id;
            $job_pallet_controls->type = $request->consignee_check;
            $job_pallet_controls->transfer_out_no = $request->transfer_out_no;
            $job_pallet_controls->transfer_in_no = $request->transfer_in_no;
            if ($request->consignee_check == 'transfer') {
                $job_pallet_controls->in_chep = $request->transfer_in_chep;
                $job_pallet_controls->out_chep = $request->transfer_out_chep;
                $job_pallet_controls->in_loscam = $request->transfer_in_loscam;
                $job_pallet_controls->out_loscam = $request->transfer_out_loscam;
            } else if ($request->consignee_check == 'exchange') {
                $job_pallet_controls->in_chep = $request->exchange_in_chep;
                $job_pallet_controls->out_chep = $request->exchange_out_chep;
                $job_pallet_controls->in_loscam = $request->exchange_in_loscam;
                $job_pallet_controls->out_loscam = $request->exchange_out_loscam;
            } else {
            }
            $job_pallet_controls->save();
            //----------

            $job_total_price = new Job_total_price();
            if ($request->jtotal_price != '') {
                $job_total_price = Job_total_price::find($request->jtotal_price);
            }
            $job_total_price->job_id = $job_id;
            $job_total_price->job_total_price = $request->job_total_price;
            $job_total_price->job_handling_fee = $request->job_handling_fee;
            $job_total_price->job_unload_fee = $request->job_unload_fee;

            if (isset($request->job_delivery_fee)) {
                $job_total_price->job_delivery_fee = $request->job_delivery_fee;
            } else {
                $job_total_price->job_delivery_fee = 'off';
            }

            if (isset($request->job_pick_up_fee)) {
                $job_total_price->job_pick_up_fee = $request->job_pick_up_fee;
            } else {
                $job_total_price->job_pick_up_fee = 'off';
            }

            $job_total_price->save();

            $response = [];
            // $response = $this->send_SMS($job_id);

            $xero_res = $this->updateXeroInvoice($job_id);

            // $this->send_Mail(1);
            if (isset($response['response'])) {
                return response()->json([
                    'status' => true,
                    'xero' => $xero_res,
                    // 'pdf_url'=> url($urlPath),
                    'res' => $request->jid,
                    'message' => ($request->jid ? 'Job updated successfully.<br/>' : 'Job created successfully.<br/>') . ($response['response'] && $response['response']->getStatusCode() == 200 ? ' Sent SMS to assigned driver.<br/>' . $response['message'] : '')
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'xero' => $xero_res,
                    // 'pdf_url'=> url($urlPath),
                    'res' => $request->jid,
                    'message' => ($request->jid ? 'Job updated successfully.<br/>' : 'Job created successfully.<br/>')
                ], 200);
            }
            // return redirect()->back()->with('message', 'Job create successfully!');
        }
    }

    public function create_job_status()
    {
        $title = 'Change job status';
        $all_statuses = JobStatus::orderBy('job_status', 'ASC')->get();
        $all_branches = Branches::orderBy('branches', 'ASC')->get();
        $all_connotes = Job::orderBy('connote_no', 'ASC')->get();
        $all_drivers = User::where('is_admin', 2)->get();
        // var_dump($all_connotes);

        return view(
            'admin.jobs.status_update',
            [
                'title' => $title, 'all_statuses' => $all_statuses, 'all_branches' => $all_branches,
                'all_connotes' => $all_connotes,
                'all_drivers' => $all_drivers
            ]
        );
    }

    public function send_Mail($jobId)
    {
        $to_name = '‘RECEIVER_NAME’';
        $to_email = 'vladtarasov20203@gmail.com';
        $data = array('name' => "Vladislav Tarasov(sender_name)", "body" => "A test mail for FMS");
        Mail::send('mail-template', $data, function ($message) use ($to_name, $to_email) {
            $message->from('vladtarasov20203@gmail.com', 'Test mail');
            $message->to($to_email, $to_name)->subject('Laravel test mail');
        });
    }

    public function updateXeroInvoice($jobId)
    {
        $id = $jobId;
        $job = Job::where('id', $id)->with(['driver', 'job_status_data', 'job_current_branch', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();

        $user = auth()->user();
        $accessToken = new AccessToken((array)json_decode($user->xero_access_token));
        try {
            $xero1 = new \XeroPHP\Application($accessToken, $user->tenant_id);

            $contacts = $xero1->load(\XeroPHP\Models\Accounting\Contact::class)
                ->where('EmailAddress', 'vladtarasov20203@gmail.com')
                ->execute();
            $invoice = new \XeroPHP\Models\Accounting\Invoice($xero1);
            if(is_null($job['xero_data'])){
                $invoices = $xero1->load(\XeroPHP\Models\Accounting\Invoice::class)
                    ->where('InvoiceID', json_decode($job['xero_data'])->{'InvoiceID'} )
                    ->execute();
                if(count($invoices)){
                    $invoice = $invoices[0];
                }
            }

            // $accounts = $xero1->load(\XeroPHP\Models\Accounting\Account::class)->execute();



            $invoice->setReference($job['m_reference'])
                ->setDueDate(new DateTime($job['updated_at']))
                ->setContact($contacts[0])
                ->setStatus(\XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_AUTHORISED)
                ->setType(\XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCREC)
                ->setLineAmountType(\XeroAPI\XeroPHP\Models\Accounting\LineAmountTypes::EXCLUSIVE);

            $jobType = '200';
            switch ($job['job_type']) {
                case 'general':
                    $jobType = '200';
                    break;
                case 'express':
                    $jobType = '201';
                    break;
                case 'hotshot':
                    $jobType = '202';
                    break;
                case 'special':
                    $jobType = '203';
                    break;
            }

            foreach ($job->job_items as $key => $item) {
                $lineItem = new \XeroPHP\Models\Accounting\LineItem();
                $lineItem->setDescription($item->{'item_description'})
                    ->setQuantity($item->{'item_qty'})
                    ->setAccountCode($jobType)
                    ->setUnitAmount($item->{'item_cost'});
                $invoice->addLineItem($lineItem);
            }

            if(is_null($job['xero_data'])){
                $invoice->save();
            }

        } catch (Exception $e) {
            return false;
        }

        $job['xero_data'] = json_encode($invoice);
        $job->save();
        return true;
    }

    public function send_SMS($jobId)
    {
        // generate base64 key from API key and API secret key:secret
        // api_key    = enmVOQAlfaoRiSeOiKY1
        // api_secret = i6XhkG2uLl1p5LSOvXOltw816KEALb
        // base64 ZW5tVk9RQWxmYW9SaVNlT2lLWTE6aTZYaGtHMnVMbDFwNUxTT3ZYT2x0dzgxNktFQUxi
        $id = $jobId;
        $job = Job::where('id', $id)->with(['driver', 'job_status_data', 'job_current_branch', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();
        $item_qty = Job_items::where('job_id', $id)->sum('item_qty');
        $item_description = Job_items::where('job_id', $id)->sum('item_description');
        $item_length = Job_items::where('job_id', $id)->sum('item_length');
        $item_width = Job_items::where('job_id', $id)->sum('item_width');
        $item_height = Job_items::where('job_id', $id)->sum('item_height');
        $item_tweight = Job_items::where('job_id', $id)->sum('item_tweight');
        $item_cubic_m3 = Job_items::where('job_id', $id)->sum('item_cubic_m3');
        $item_plt_spc = Job_items::where('job_id', $id)->sum('item_plt_spc');
        //phone number

        if ($job['driver']['phone_no']) {
            // var_dump($job['driver']['phone_no']);
        } else {
            return null;
        }

        $message_str = "";
        $message_str .= "Sender Name: " . $job['job_sender']['sender_name'] . "\r\n";
        $message_str .= "Sender Address: " . $job['job_sender']['sender_address_line_1'] . "\r\n" . "\r\n";
        $message_str .= "Receiver Name: " . $job['job_receiver']['receiver_name'] . "\r\n" . "\r\n";
        $message_str .= "Total Item Qty: " . $item_qty . "\r\n";
        $message_str .= "Total Item Weight: " . $item_tweight . "\r\n";

        //PDF link not login

        $pdf = $this->_makePdf($id);
        $filePath = 'public/pdf/' . uniqid() . '.pdf';
        Storage::put($filePath, $pdf->output());
        $urlPath = Storage::url($filePath);

        $message_str .= "PDF: " . url($urlPath) . "";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ZW5tVk9RQWxmYW9SaVNlT2lLWTE6aTZYaGtHMnVMbDFwNUxTT3ZYT2x0dzgxNktFQUxi',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://app.wholesalesms.com.au/api/v2/send-sms.json', [
            'message' => $message_str,
            'to' => $job['driver']['phone_no'],
            'from' => 'Ward_Transport'
        ]);
        // $response = Http::withToken('Basic ZW5tVk9RQWxmYW9SaVNlT2lLWTE6aTZYaGtHMnVMbDFwNUxTT3ZYT2x0dzgxNktFQUxi')->asForm()->post('https://app.wholesalesms.com.au/api/v2/send-sms.json', [
        //     'message' => $message_str,
        //     'to' => $job['driver']['phone_no'],
        //     'from' => 'Ward_Transport'
        // ]);
        return ['message' => $message_str, 'response' => $response];
    }

    public function update_job_status_bulk(Request $request)
    {
        $input = $request->all();
        $updateArray = [];

        if ($input['job_status']) {
            $updateArray['job_status'] = $input['job_status'];
        }
        if ($input['current_branch']) {
            $updateArray['current_branch'] = $input['current_branch'];
        }
        if ($input['job_type']) {
            $updateArray['job_type'] = $input['job_type'];
        }
        if ($input['assigned_driver']) {
            $updateArray['assigned_driver'] = $input['assigned_driver'];
        }
        if ($input['ready_date']) {
            $updateArray['created_at'] = date("Y-m-d h:m:s", strtotime($input['ready_date']));
        }
        if ($input['arrival_date']) {
            // $updateArray['created_at'] = strtotime($input['arrival_date']);
            $updateArray['created_at'] = date("Y-m-d h:m:s", strtotime($input['arrival_date']));
        }

        $ids = [];
        if (isset($input['connote_nums'])) {
            $ids =  explode(',', $input['connote_nums']);
        }

        // var_dump($updateArray);
        $res = 0;
        if (isset($input['clients'])) {
            foreach ($input['clients'] as $index => $id) {
                $job = Job::find($id);
                if ($job) {
                    $res += Job::where('id', $id)->update($updateArray);
                }
                $res--;
            }
            return response()->json(['status' => true, 'res' => $res, 'message' => 'Job status updated successfully'], 200);
        } else {
            if (!isset($input['connote_nums'])) {
                return response()->json(['status' => false, 'message' => 'Please select job.'], 200);
            }
        }

        if (isset($input['connote_nums'])) {
            $updateJob = Job::whereIn('connote_no', $ids)
                ->update($updateArray);
            if ($updateJob) {
                return response()->json(['status' => true, 'res' => $updateJob, 'message' => $updateJob . ' Job status updated successfully'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Update failed.'], 200);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Please select job.'], 200);
        }
        // var_dump($input);

        // die;
    }

    public function update_job_status(Request $request)
    {
        $title = 'Change job status';
        $this->validate($request, [
            'job_status' => 'required|exists:jobs',
            'dispatch_branch' => 'required',
            'arrival_date' => 'required',
            'connote_no' => 'required|exists:jobs',
            'connote_no.*' => 'required',
        ]);

        $input = $request->all();

        for ($i = 0; $i < count($request->connote_no); $i++) {
            $connote_no = str_replace(' ', '', $input['connote_no'][$i]);
            $connote = Job::where('connote_no', $connote_no)->where('receiver_branch', $input['dispatch_branch'])->first();
            if ($connote) {
                $connote->job_status = $input['job_status'];
                $connote->save();
            }
        }
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function _makePdf($id)
    {
        $job = Job::where('id', $id)->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();
        $item_qty = Job_items::where('job_id', $id)->sum('item_qty');
        $item_length = Job_items::where('job_id', $id)->sum('item_length');
        $item_width = Job_items::where('job_id', $id)->sum('item_width');
        $item_height = Job_items::where('job_id', $id)->sum('item_height');
        $item_tweight = Job_items::where('job_id', $id)->sum('item_tweight');
        $item_cubic_m3 = Job_items::where('job_id', $id)->sum('item_cubic_m3');
        $item_plt_spc = Job_items::where('job_id', $id)->sum('item_plt_spc');
        // var_dump($job->job_items);
        $qrcode =  base64_encode(QrCode::size(92)->generate($job->connote_no));
        // return view('htmlView111', ['qrcode' => $qrcode, 'job' => $job, 'item_qty' => $item_qty, 'item_length' => $item_length, 'item_width' => $item_width, 'item_height' => $item_height, 'item_tweight' => $item_tweight, 'item_cubic_m3' => $item_cubic_m3, 'item_plt_spc' => $item_plt_spc]);
        $pdf = PDF::loadView('htmlView111', ['qrcode' => $qrcode, 'job' => $job, 'item_qty' => $item_qty, 'item_length' => $item_length, 'item_width' => $item_width, 'item_height' => $item_height, 'item_tweight' => $item_tweight, 'item_cubic_m3' => $item_cubic_m3, 'item_plt_spc' => $item_plt_spc])->setPaper('a4', 'portrait'); // <--- load your view into theDOM wrapper;
        return $pdf;
    }

    public function exportPdf($id)
    {
        $pdf = $this->_makePdf($id);
        // $filePath = 'public/pdf/'.uniqid().'.pdf';
        // Storage::put($filePath, $pdf->output());
        // var_dump(Storage::url($filePath));
        return $pdf->stream('connote' . $id . '.pdf');
    }

    public function exportJobsEmail($id)
    {
        $id = 14;
        $job = Job::where('id', $id)->with(['job_status_data', 'job_current_branch', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();
        $item_qty = Job_items::where('job_id', $id)->sum('item_qty');
        $item_length = Job_items::where('job_id', $id)->sum('item_length');
        $item_width = Job_items::where('job_id', $id)->sum('item_width');
        $item_height = Job_items::where('job_id', $id)->sum('item_height');
        $item_tweight = Job_items::where('job_id', $id)->sum('item_tweight');
        $item_cubic_m3 = Job_items::where('job_id', $id)->sum('item_cubic_m3');
        $item_plt_spc = Job_items::where('job_id', $id)->sum('item_plt_spc');


        // $sender_branch = Job::where('id', $id)->with([ 'job_current_branch'])->first();
        // var_dump($sender_branch);

        // $pdf = PDF::loadView('htmlLabelView', ['jobs' => $jobs, 'model_data'=>$model_data])->setPaper('a5', 'portrait'); // <--- load your view into theDOM wrapper;
        // return $pdf->stream('result.pdf');
        return view('htmlEmail', ['job' => $job, 'item_qty' => $item_qty, 'item_length' => $item_length, 'item_width' => $item_width, 'item_height' => $item_height, 'item_tweight' => $item_tweight, 'item_cubic_m3' => $item_cubic_m3, 'item_plt_spc' => $item_plt_spc]);
    }

    public function exportPdfPost(Request $request)
    {
        $input = $request->all();
        $jobs = (object) $input;

        $qrcode =  base64_encode(QrCode::size(92)->generate($jobs->connote_no));
        $model_data = [];
        $model_data['item_qty'] = 0;
        $model_data['item_tweight'] = 0;
        $model_data['item_cubic_m3'] = 0;
        $model_data['item_plt_spc'] = 0;
        foreach ($jobs->item_type as $key => $item_type) {
            $model_data['item_qty'] += $jobs->item_qty[$key];
            $model_data['item_tweight'] += $jobs->item_tweight[$key];
            $model_data['item_cubic_m3'] += $jobs->item_cubic_m3[$key];
            $model_data['item_plt_spc'] += $jobs->item_plt_spc[$key];

            $val = Items::where('id', $item_type)->get();
            $model_data['item_type'][$key] = $val[0]['item_name'];
        }
        // var_dump($jobs);

        // return view('htmlView111', ['jobs' => $jobs, 'qrcode' => $qrcode, 'model_data'=>$model_data]);
        $pdf = PDF::loadView('htmlView111', ['jobs' => $jobs, 'qrcode' => $qrcode, 'model_data' => $model_data])->setPaper('a4', 'portrait'); // <--- load your view into theDOM wrapper;
        return $pdf->stream('result.pdf');
    }

    public function exportLabelPdf($id)
    {
        $job = Job::where('id', $id)->with(['job_status_data', 'job_sender_branch', 'job_receiver_branch', 'job_total_price', 'job_sender', 'job_receiver', 'job_pallet_control', 'job_load_restraints', 'job_items'])->first();

        // var_dump($job);
        // return view('htmlLabelView', ['job' => $job]);
        $pdf = PDF::loadView('htmlLabelView', ['job' => $job])->setPaper('a5', 'portrait'); // <--- load your view into theDOM wrapper;
        return $pdf->stream('result.pdf');
    }
    public function exportLabelPdfPost(Request $request)
    {
        $input = $request->all();

        $jobs = (object) $input;

        $model_data = [];
        $model_data['receiver_branch']  = Branches::where('id', $jobs->receiver_branch)->get();
        $model_data['sender_branch'] = Branches::where('id', $jobs->sender_branch)->get();

        foreach ($jobs->item_type as $key => $item_type) {
            $val = Items::where('id', $item_type)->get();
            $model_data['item_type'][$key] = $val[0]['item_name'];
        }

        // return view('htmlLabelView', ['jobs' => $jobs, 'model_data'=>$model_data]);
        $pdf = PDF::loadView('htmlLabelView', ['jobs' => $jobs, 'model_data' => $model_data])->setPaper('a5', 'portrait'); // <--- load your view into theDOM wrapper;
        return $pdf->stream('result.pdf');
    }



    public function destroy($id)
    {

        $job = Job::find($id);
        if ($job) {
            $job->delete();
            Session::flash('success_message', 'Job successfully deleted!');
        }
        return redirect()->route('jobs.index');
    }
}
