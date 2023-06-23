<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Items';
        return view('admin.items.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Items';
        return view('admin.items.create', compact('title'));
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

        $title = 'New Items';
        $this->validate($request, [
            'item_name' => 'required',
            'item_description' => 'required'
        ]);

        $input = $request->all();
        for ($i = 0; $i < count($input['item_name']) && $i < count($input['item_description']); $i++) {
            $item = new Items();
            $item->item_name = $input['item_name'][$i];
            $item->description = $input['item_description'][$i];
            $item->save();
        }




        //Session::flash('success_message', 'Great! Customer has been saved successfully!');
        // $pricing->save();

        //$all_plans = pricing_plans::all();
        if ($item) {
            Session::flash('success_message', 'Great! Created New Items!');
            return view('admin.items.index', ['title' => $title]);
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
        $item = Items::where('id', $id)->first();
        $title = "Edit Item details";
        return view('admin.items.edit', ['item' => $item,  'title' => $title]);
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
        $item = Items::find($id);
        $this->validate($request, [
            'item_name' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();

        $item->item_name = $input['item_name'];
        $item->description = $input['description'];


        $item->save();

        Session::flash('success_message', 'Great! Item successfully updated!');
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
        $item = Items::find($id);
        if ($item) {
            $item->delete();
            Session::flash('success_message', 'Items successfully deleted!');
        }
        return redirect()->route('items.index');
    }
    public function getItems(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'item_name',
            2 => 'action'
        );

        $totalData = Items::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $items = Items::offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Items::all()->count();
        } else {
            $search = $request->input('search.value');
            $items = Items::where([
                ['item_name', 'like', "%{$search}%"]
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =
                Items::where([
                    ['item_name', 'like', "%{$search}%"]
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }


        $data = array();

        if ($items) {
            foreach ($items as $r) {
                $edit_url = route('items.edit', $r->id);

                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['item_name'] = $r->item_name;



                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo(' . $r->id . ');" title="View Items" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Items" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                    <a title="Edit Items" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
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
    public function deleteSelectedItems(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $items = Items::find($id);
            if (isset($items)) {
                $items->delete();
            }
        }
        Session::flash('success_message', 'Items successfully deleted!');
        return redirect()->back();
    }
    public function getItem(Request $request)
    {
        $item = Items::findOrFail($request->id);


        return view('admin.items.detail', ['title' => 'Item Detail', 'item' => $item]);
    }
}
