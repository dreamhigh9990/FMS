<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branches;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Branches';
        return view('admin.branches.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Branches';
        return view('admin.branches.create', compact('title'));
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
        $title = 'New Branch';
        $this->validate($request, [
            'branches' => 'required',
            'branches_email' => 'required',

        ]);

        $input = $request->all();
        for ($i = 0; $i < count($input['branches']); $i++) {
            $branch = new Branches();
            $branch->branches = $input['branches'][$i];
            $branch->branches_email = $input['branches_email'][$i];
            $branch->save();
        }
        //Session::flash('success_message', 'Great! Customer has been saved successfully!');
        // $pricing->save();

        //$all_plans = pricing_plans::all();
        if ($branch) {
            Session::flash('success_message', 'Great! Created New branch!');
            return view('admin.branches.index', ['title' => $title]);
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
        //
        $branch = Branches::where('id', $id)->first();
        $title = "Edit Branch details";
        return view('admin.branches.edit', ['branch' => $branch,  'title' => $title]);
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
        //
        $branch = Branches::find($id);
        $this->validate($request, [
            'branches' => 'required',
            'branches_email' => 'required',

        ]);
        $input = $request->all();

        $branch->branches = $input['branches'];
        $branch->branches_email = $input['branches_email'];


        $branch->save();

        Session::flash('success_message', 'Great! Branch successfully updated!');
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
        $branch = Branches::find($id);
        if ($branch) {
            $branch->delete();
            Session::flash('success_message', 'Branches successfully deleted!');
        }
        return redirect()->route('branches.index');
    }
    public function getBranches(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'branches',
            2 => 'branches_email',
            3 => 'action'
        );

        $totalData = Branches::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $branches = Branches::offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Branches::all()->count();
        } else {
            $search = $request->input('search.value');
            $branches = Branches::where([
                ['branches', 'like', "%{$search}%"]
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =
                Branches::where([
                    ['branches', 'like', "%{$search}%"]
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }


        $data = array();

        if ($branches) {
            foreach ($branches as $r) {
                $edit_url = route('branches.edit', $r->id);

                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['branches'] = $r->branches;
                $nestedData['branches_email'] = $r->branches_email;


                $nestedData['created_at'] = $r->created_at->diffForHumans();
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
    public function deleteSelectedBranches(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $branches = Branches::find($id);
            if (isset($branches)) {
                $branches->delete();
            }
        }
        Session::flash('success_message', 'branches successfully deleted!');
        return redirect()->back();
    }
}
