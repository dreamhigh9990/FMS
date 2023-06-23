<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DriverController extends Controller
{

    public function index(){

        $title = 'drivers list';
        return view('admin.drivers.index',['title'=>$title]);
    }

    public function get_drivers(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'phone_no',
            3 => 'active',
            4 => 'action'
        );

        $totalData = User::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $drivers = User::where('is_admin',2)->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = User::where('is_admin',2)->count();
        } else {
            $search = $request->input('search.value');
            $drivers = User::Where([
                ['name', 'like', "%{$search}%"],['is_admin',2]
            ])->orWhere([
                ['phone_no', 'like', "%{$search}%"],['is_admin',2]
            ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::Where([
                    ['name', 'like', "%{$search}%"],['is_admin',2]
                ])->orWhere([
                    ['phone_no', 'like', "%{$search}%"],['is_admin',2]
                ])
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->count();
        }
        //return $manifests;

        $data = array();

        if ($drivers) {
            foreach ($drivers as $r) {
                $edit_url = route('driver.edit', $r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['name'] = $r->name;
                $nestedData['phone_no'] = $r->phone_no;
                if($r->active){
                    $nestedData['active'] = '<span class="label label-success label-inline mr-2">Active</span>';
                }else{
                    $nestedData['active'] = '<span class="label label-danger label-inline mr-2">Inactive</span>';
                }

                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo(' . $r->id . ');" title="View Driver" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
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

    public function get_driver(Request $request){

        $driver = User::findOrFail($request->id);
        return view('admin.drivers.detail', ['title' => 'Driver Detail', 'driver' => $driver]);

    }

    public function create_driver(){


        $title = "create new driver";
        return view('admin.drivers.create',['title'=>$title]);
    }


    public function store_driver(Request $request){
        $this->validate($request, [
            'name' => 'required',
            // 'phone_no' => 'required|unique:users',
            // 'password' => 'required|confirmed|min:8'
        ]);
        $data = $request->all();
        $driver = new User();
        $driver->name = $data['name'];
        $driver->phone_no = $data['phone_no'];
        if(!isset($data['active'])){
            $driver->active = 0;
        }else{
            $driver->active = $data['active'];
        }
        $driver->is_admin = 2;
        $driver->password = Hash::make($data['password']);
        $driver->save();

        if($driver){
            return redirect()->back()->with('success','Driver created successfully');
        }
    }


    public function edit_driver($id){
        $driver = User::where('id', $id)->first();
        $title = "Edit driver details";
        return view('admin.drivers.edit', ['driver' => $driver,  'title' => $title]);
    }

    public function update_driver(Request $request,$id){

        $driver = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            // 'phone_no' => 'required|unique:users',
            // 'password' => 'confirmed'
        ]);
        $data = $request->all();
        $driver->name = $data['name'];
        $driver->phone_no = $data['phone_no'];
        if(!isset($data['active'])){
            $driver->active = 0;
        }else{
            $driver->active = $data['active'];
        }

        $driver->is_admin = 2;
        if($data['password']){
            $driver->password = Hash::make($data['password']);
        }

        $driver->save();

        if($driver){
            return redirect()->back()->with('success','Driver updated successfully');
        }
    }

    public function destroy($id){
        $driver = User::find($id);
        if ($driver) {
            $driver->delete();
            Session::flash('success_message', 'driver successfully deleted!');
        }
        return redirect()->route('driver.index');
    }

    public function deleteSelectedDrivers(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $driver = User::find($id);
            if (isset($driver)) {
                $driver->delete();
            }
        }
        Session::flash('success_message', 'Drivers successfully deleted!');
        return redirect()->back();
    }


}
