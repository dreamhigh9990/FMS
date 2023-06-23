<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\add_price_by_spc;
use App\Models\add_price_by_weight;
use App\Models\Branches;
use App\Models\Items;
use App\Models\price_detail;
use Illuminate\Http\Request;
use App\Models\Pricing;
use Illuminate\Support\Facades\Session;

class PricingController extends Controller
{

    public function index()
    {
        //
        $title = 'Pricing';

        return view('admin.pricing.index', compact('title'));
    }

    public function create()
    {
        // $all_branches = Branches::orderBy('branches', 'ASC')->get();
        // $all_items = Items::orderBy('item_name', 'ASC')->get();
        // $title = 'Add New Pricing';
        // return view('admin.pricing.create', ['title' => $title, 'branches' => $all_branches,'items'=>$all_items]);

        $all_branches = Branches::orderBy('branches', 'ASC')->get();
        $all_items = Items::orderBy('item_name', 'ASC')->get();
        $title = "Add new pricing";
        //return $pricing;
        return view('admin.pricing.edit', ['id' => 0,  'title' => $title,'branches'=>$all_branches,'items'=>$all_items]);
    }

    public function get_all()
    {
        // orderBy('title', 'ASC')->
        $all_prices = Pricing::get();
        return $all_prices;
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $pricing =json_decode($input['pricing']);

            $new_price = Pricing::where('id', $pricing->{'id'})->with('price_detail')->first();

            if(!$new_price){
                $new_price = new Pricing();
                $new_price->id = $pricing->{'id'};
            }
            $new_price->title = $pricing->{'title'};
            $new_price->discount = $pricing->{'discount'};
            $new_price->con_fee = $pricing->{'con_fee'};
            $new_price->delivery_fee = $pricing->{'delivery_fee'};
            $new_price->fuel_levy = $pricing->{'fuel_levy'};
            $new_price->futile_pickup_fee = $pricing->{'futile_pickup_fee'};
            $new_price->pickup_fee = $pricing->{'pickup_fee'};
            $new_price->save();

            foreach ($new_price['price_detail'] as $key => $pDetail){
                $old_detail = price_detail::find($pDetail['id']);
                if ($old_detail) {
                    $old_detail->delete();
                }
            }

            if ($new_price) {
                foreach ((array)$pricing->{'price_detail'} as $key => $pDetail) {
                    $new_detail = price_detail::where('id', $pDetail->{'id'})->first();
                    if(!$new_detail){
                        $new_detail = new price_detail();
                        $new_detail->id = $pDetail->{'id'};
                    }
                    $new_detail->price_id = $new_price->id;
                    $new_detail->item_type_id = $pDetail->{'item_type_id'};
                    $new_detail->from_address = $pDetail->{'from_address'};
                    $new_detail->to_address = $pDetail->{'to_address'};
                    $new_detail->discount_for_item = $pDetail->{'discount_for_item'};
                    $new_detail->reversal_pricing = $pDetail->{'reversal_pricing'};
                    $new_detail->price_by_weight = $pDetail->{'price_by_weight'};
                    $new_detail->price_by_spc = $pDetail->{'price_by_spc'};
                    $new_detail->save();
                }
            }

            return response()->json(['status' => true, 'message'=>'Successfully updated'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message'=>$e->getMessage()], 200);
        }


        // return view('admin.pricing.index', compact('title'));
    }

    public function show($id)
    {
        //
        $all_branches = Branches::all();
        $pricing = Pricing::where('id', $id)->with('price_detail')->first();
        $title = "View pricing details";
        return view('admin.pricing.detail', ['pricing' => $pricing,  'title' => $title, 'branches' => $all_branches]);
    }

    public function edit($id)
    {

        $all_branches = Branches::orderBy('branches', 'ASC')->get();
        $all_items = Items::orderBy('item_name', 'ASC')->get();
        $title = "Edit pricing details";
        //return $pricing;
        return view('admin.pricing.edit', ['id' => $id,  'title' => $title,'branches'=>$all_branches,'items'=>$all_items]);
    }

    public function get_price_detail($id){
        $pricing = Pricing::where('id', $id)->with('price_detail')->first();
        $all_branches = Branches::orderBy('branches', 'ASC')->get();
        $all_items = Items::orderBy('item_name', 'ASC')->get();

        return response()->json(['status' => false, 'Pricing' => $pricing, 'branches'=>$all_branches,'items'=>$all_items ], 200);
    }

    public function get_price_by_weight(Request $request){
        $all_price_by_weight = add_price_by_weight::where('row_no',$request->random_no)->get();

        return $all_price_by_weight;
    }
    public function get_price_by_spc(Request $request)
    {
        $all_price_by_spc = add_price_by_spc::where('row_no', $request->random_no)->get();
        return $all_price_by_spc;
    }

    public function update(Request $request)
    {


        $price_detail = price_detail::where('price_id',$request->price_id)->get();
        foreach ($price_detail as $detail){
            $detail->delete();
        }
        $pricing = Pricing::where('id', $request->price_id)->with('price_detail')->first();
        $pricing->title = $request->company_title;
        $pricing->discount =$request->percentage;
        $pricing->con_fee = $request->con_fee;
        $pricing->delivery_fee = $request->delivery_fee;
        $pricing->fuel_levy = $request->fuel_levy;
        $pricing->futile_pickup_fee = $request->futile_pickup_fee;
        $pricing->pickup_fee = $request->pickup_fee;
        $pricing->save();


        if($pricing){
            $price_id = $pricing->id;

            if(isset($request->p_row_no)){
                for($i = 0; $i<count($request->p_row_no); $i++){

                    $new_price_detail = new price_detail();
                    $new_price_detail->price_id = $price_id;
                    $new_price_detail->row_no = $request->p_row_no[$i];
                    $new_price_detail->item_type_id = $request->p_row_item_type[$i];
                    $new_price_detail->from_address = $request->p_row_from[$i];
                    $new_price_detail->to_address = $request->p_row_to[$i];
                    $new_price_detail->discount_for_item = $request->p_row_discount_item[$i];
                    $new_price_detail->reversal_pricing = $request->p_row_reversal_pricing[$i];
                    $new_price_detail->save();

                }
            }



            if (isset($request->Add_Price_By_Weight)){
                for ($j = 0; $j<count($request->Add_Price_By_Weight); $j++){
                    $price_detail_row_no = price_detail::where('row_no',$request->Add_Price_By_Weight[$j]['row_no'])->value('id');
                    if($price_detail_row_no){

                        if(isset($request->Add_Price_By_Weight[$j]['w_from'])){
                            for ($h = 0; $h<count($request->Add_Price_By_Weight[$j]['w_from']); $h++){
                                $new_price_by_weight = new add_price_by_weight();
                                $new_price_by_weight->pricing_detail_id = $price_detail_row_no;
                                $new_price_by_weight->row_no = $request->Add_Price_By_Weight[$j]['row_no'];
                                $new_price_by_weight->w_from = $request->Add_Price_By_Weight[$j]['w_from'][$h];
                                $new_price_by_weight->w_to = $request->Add_Price_By_Weight[$j]['w_to'][$h];
                                $new_price_by_weight->w_cost = $request->Add_Price_By_Weight[$j]['w_cost'][$h];
                                //return $request->Add_Price_By_Weight[$j];
                                $new_price_by_weight->save();
                            }
                        }
                    }
                }
            }


            if (isset($request->Add_Price_By_SPC)){
                for ($k = 0; $k<count($request->Add_Price_By_SPC); $k++){
                    $price_detail_row_no = price_detail::where('row_no',$request->Add_Price_By_SPC[$k]['row_no'])->value('id');
                    if($price_detail_row_no){
                        if(isset($request->Add_Price_By_SPC[$k]['spc_form'])){
                            for($g =0; $g<count($request->Add_Price_By_SPC[$k]['spc_form']); $g++){
                                //return $request->Add_Price_By_SPC;
                                $new_price_by_spc = new add_price_by_spc();
                                $new_price_by_spc->pricing_detail_id = $price_detail_row_no;
                                $new_price_by_spc->row_no = $request->Add_Price_By_SPC[$k]['row_no'];
                                $new_price_by_spc->spc_form = $request->Add_Price_By_SPC[$k]['spc_form'][$g];
                                $new_price_by_spc->spc_to = $request->Add_Price_By_SPC[$k]['spc_to'][$g];
                                $new_price_by_spc->spc_cost = $request->Add_Price_By_SPC[$k]['spc_cost'][$g];

                                $new_price_by_spc->save();
                            }
                        }

                    }


                }
            }

        }

        return 'data updated successfully';
    }

    public function destroy($id)
    {
        //
        $pricing = Pricing::find($id);
        if ($pricing) {
            $pricing->delete();
            Session::flash('success_message', 'Pricing successfully deleted!');
        }
        return redirect()->route('pricing.index');
    }

    public function getPricings(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'discount',
            3 => 'created_at',
            4 => 'action'
        );

        $totalData = Pricing::all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $pricings = Pricing::offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = Pricing::all()->count();
        } else {
            $search = $request->input('search.value');
            $pricings = Pricing::where([
                ['title', 'like', "%{$search}%"]
            ])->orwhere([
                ['discount', 'like', "%{$search}%"],
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered =
                Pricing::where([
                    ['title', 'like', "%{$search}%"]
                ])->orwhere([
                    ['discount', 'like', "%{$search}%"],
                ])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }


        $data = array();

        if ($pricings) {
            foreach ($pricings as $r) {
                $edit_url = route('pricing.edit', $r->id);
                $show_url = route('pricing.show', $r->id);

                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['title'] = $r->title;
                $nestedData['discount'] = $r->discount;


                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon"  title="View pricing" href="' . $show_url . '">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit pricing" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete pricing" href="javascript:void(0)">
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

    public function deleteSelectedPricing(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $pricing = Pricing::find($id);
            if (isset($pricing)) {
                $pricing->delete();
            }
        }
        Session::flash('success_message', 'Pricing successfully deleted!');
        return redirect()->back();
    }

    public function getPricing(Request $request)
    {
        $pricing = Pricing::findOrFail($request->id);


        return view('admin.pricing.detail', ['title' => 'Pricing Detail', 'pricing' => $pricing]);
    }
}
