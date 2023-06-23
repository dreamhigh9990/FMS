<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $title = 'Manage Employees';
        return view('admin.employee.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Employees';
        $all_branches = Branches::all();
        return view('admin.employee.create', ['title'=>$title,'all_branches'=>$all_branches]);
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

        $title = 'Created New Employee';
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'mobile' => ['required', 'numeric'],
            // 'employee_id' => ['required', 'max:15'],
            // 'branch_id' => 'nullable|max:8',
            // 'password' => 'required|confirmed|max:8',
            // 'new_pin' => 'required|max:6'
        ]);

        $input = $request->all();


        $employee = new Employee();
        $employee->first_name = $input['first_name'];
        $employee->last_name = $input['last_name'];
        $employee->mobile = $input['mobile'];
        $employee->employee_id = $input['employee_id'];
        $employee->branch_id = $input['branch'];
        $employee->can_login = (array_key_exists('can_login', $input)) ? 1 : 0;
        $employee->new_password = Hash::make($input['password']);
        $employee->can_use_app = (array_key_exists('can_use_app', $input)) ? 1 : 0;
        $employee->new_pin = Hash::make($input['new_pin']);

        //dd($manifest->arrival_date, $input['arrival_date']);
        $employee->save();


        // $manifest->save();

        //$all_plans = pricing_plans::all();
        if ($employee) {
            Session::flash('success_message', 'Great! Employee has been saved successfully!');
            return redirect()->back();
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
        $employee = Employee::where('id', $id)->first();
        $all_branches = Branches::all();
        $title = "Edit Employee details";
        return view('admin.employee.edit', ['employee' => $employee,  'title' => $title,'all_branches'=>$all_branches]);
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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'employee_id' => 'required',
            // 'branch' => 'max:25',
            'password' => 'confirmed|max:8'
            // 'new_pin' => 'max:6'
        ]);
        //dd('here');
        $employee = Employee::find($id);

        $input  = $request->all();
        $employee->first_name = $input['first_name'];
        $employee->last_name = $input['last_name'];
        $employee->mobile = $input['mobile'];
        $employee->employee_id = $input['employee_id'];
        $employee->branch_id = $input['branch'];
        $employee->new_password = isset($input['password']) ? Hash::make($input['password']) : $employee->new_password;
        $employee->new_pin = isset($input['new_pin']) ? Hash::make($input['new_pin']) : $employee->new_pin;
        $employee->can_login = (array_key_exists('can_login', $input)) ? 1 : 0;
        $employee->can_use_app = (array_key_exists('can_use_app', $input)) ? 1 : 0;

        $employee->save();
        if ($employee) {
            Session::flash('success_message', 'Great! Employee successfully updated!');
            return redirect()->back();
        }
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
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
            Session::flash('success_message', 'Employee successfully deleted!');
        }
        return redirect()->route('employee.index');
    }
    public function getEmployees(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'first_name',
            2 => 'created_date',
            3 => 'action'
        );

        $totalData = Employee::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $employees = Employee::offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Employee::all()->count();
        } else {
            $search = $request->input('search.value');
            $employees = Employee::where([
                ['first_name', 'like', "%{$search}%"]
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =
                Employee::where([
                    ['first_name', 'like', "%{$search}%"]
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }


        $data = array();

        if ($employees) {
            foreach ($employees as $r) {
                $edit_url = route('employee.edit', $r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['first_name'] = $r->first_name;
                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                     <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo(' . $r->id . ');" title="View Employee" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Items" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Employee" href="javascript:void(0)">
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
    public function deleteSelectedEmployee(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $employee = Employee::find($id);
            if (isset($employee)) {
                $employee->delete();
            }
        }
        Session::flash('success_message', 'Employees successfully deleted!');
        return redirect()->back();
    }
    public function getEmployee(Request $request)
    {
        $employee = Employee::findOrFail($request->id);


        return view('admin.employee.detail', ['title' => 'Employee Detail', 'employee' => $employee]);
    }
}
