<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\account_detail;
use App\Models\attachments;
use App\Models\customer_address;
use App\Models\notes;
use App\Models\other_contact;
use App\Models\Pricing;
use App\Models\primary_contact;
use App\Models\CustomerSites;
use App\Models\CustomerContacts;
use App\Models\CustomerBookings;
use App\Models\CustomerInvoices;
use App\Models\secondary_contact;
use App\Models\sites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Exception;

use DateTime;
use LangleyFoxall\XeroLaravel\OAuth2;
use League\OAuth2\Client\Token\AccessToken;

class CustomerController extends Controller
{

    public function index()
    {
        $title = 'Customers';
        return view('admin.customers.index', compact('title'));
    }

    public function getCustomers(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'plan',
            3 => 'active',
            4 => 'payment_terms',
            5 => 'p_suburb',
            6 => 'gen_invoice_chk',
            7 => 'xero_link_chk',
            8 => 'invoice_export',
            9 => 'created_at',
            10 => 'action'
        );

        $colSearch = array();
        $colSearch_chk = false;

        for ($i = 0; $i <= 8; $i++) {
            $req = $request->input("columns.${i}.search.value");
            $colSearch[$i] = "%${req}%";
            if(!empty($req)){
                $colSearch_chk = true;
            }
        }

        $totalData = User::where('is_admin', 0)->where('is_show', 1)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))  && !$colSearch_chk ) {
            $users = User::where('is_admin', 0)->where('is_show', 1)->offset($start)
                ->limit($limit)
                // ->with('account_detail')
                // ->with('address')
                ->leftJoin('customer_account_details', 'customer_account_details.customer_id', '=', 'users.id')
                ->leftJoin('customer_address', 'customer_address.customer_id', '=', 'users.id')
                ->orderBy($order, $dir)
                ->select('users.*', 'payment_terms', 'gen_invoice_chk', 'xero_link_chk', 'invoice_export', 'p_suburb')
                ->get();
            // var_dump($users);
            // die;
            $totalFiltered = User::where('is_admin', 0)->where('is_show', 1)->count();
        } else {
            $search = $request->input('search.value');

            $users = User::where(function($q) use ($colSearch){
                    $q->where([
                        ['name', 'like', $colSearch[1]]
                    ])->where([
                        ['plan', 'like', $colSearch[2]]
                    ])->where([
                        ['payment_terms', 'like', $colSearch[4]]
                    ])->where([
                        ['gen_invoice_chk', 'like', $colSearch[6]]
                    ])->where([
                        ['xero_link_chk', 'like', $colSearch[7]]
                    ])->where([
                        ['invoice_export', 'like', $colSearch[8]]
                    ])->where([
                        ['p_suburb', 'like', $colSearch[5]]
                    ]);
                    // ->WhereHas('account_detail', function ($query) use ($colSearch) {
                    //     $query->where('payment_terms', 'like', $colSearch[4] );
                    // })
                    // ->WhereHas('account_detail', function ($query) use ($colSearch) {
                    //     $query->where('gen_invoice_chk', 'like', $colSearch[6] );
                    // })
                    // ->WhereHas('account_detail', function ($query) use ($colSearch) {
                    //     $query->where('xero_link_chk', 'like', $colSearch[7] );
                    // })->WhereHas('account_detail', function ($query) use ($colSearch) {
                    //     $query->where('invoice_export', 'like', $colSearch[8] );
                    // })->WhereHas('address', function ($query) use ($colSearch) {
                    //     $query->where('p_suburb', 'like', $colSearch[5] );
                    // });
                })
                ->where(function($q) use ($search){
                    $q->where([
                        ['is_admin', 0],
                        ['is_show', 1],
                        ['name', 'like', "%{$search}%"]
                    ])->orwhere([
                        ['is_admin', 0],
                        ['is_show', 1],
                        ['plan', 'like', "%{$search}%"],
                    ])->orwhere([
                        ['is_admin', 0],
                        ['is_show', 1],
                        // ['created_at', 'like', "%{$search}%"],
                    ])->orWhereHas('account_detail', function ($query) use ($search) {
                        $query->where('payment_terms', 'like', '%' . $search . '%');
                    })->orWhereHas('address', function ($query) use ($search) {
                        $query->where('p_suburb', 'like', '%' . $search . '%');
                    });
                })
                ->offset($start)
                ->limit($limit)
                ->leftJoin('customer_account_details', 'customer_account_details.customer_id', '=', 'users.id')
                ->leftJoin('customer_address', 'customer_address.customer_id', '=', 'users.id')
                ->select('users.*', 'payment_terms', 'gen_invoice_chk', 'xero_link_chk', 'invoice_export', 'p_suburb')
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $users->count();
        }


        $data = array();

        if ($users) {
            foreach ($users as $r) {
                $edit_url = route('customers.edit', $r->id);
                $nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="clients[]" value="' . $r->id . '"><span></span></label></td>';
                $nestedData['name'] = '
                    <td>
                        <a href="' . $edit_url . '">
                            ' . $r->name . '
                        </a>
                    </td>

                ';
                // $nestedData['name'] = $r->name ;
                $nestedData['plan'] = $r->plan;
                // if (count($r->account_detail) > 0) {
                    // $nestedData['payment_term'] = $r->account_detail['payment_terms'];
                    $nestedData['payment_term'] = $r['payment_terms'];
                // } else {
                //     $nestedData['payment_term'] = '-';
                // }

                // if (count($r->address) > 0) {
                    $nestedData['suburb'] = $r['p_suburb'];
                // } else {
                //     $nestedData['suburb'] = '-';
                // }

                if ($r->active) {
                    $nestedData['active'] = '<span class="label label-success label-inline mr-2">Active</span>';
                } else {
                    $nestedData['active'] = '<span class="label label-danger label-inline mr-2">Inactive</span>';
                }
                $nestedData['gen_invoice_chk'] = $r->gen_invoice_chk;
                $nestedData['xero_link_chk'] =  $r->xero_link_chk;
                $nestedData['invoice_export'] = $r->invoice_export;

                $nestedData['created_at'] = date('d-m-Y', strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo(' . $r->id . ');" title="View Customer" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit customer" class="btn btn-sm btn-clean btn-icon"
                                       href="' . $edit_url . '">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del(' . $r->id . ');" title="Delete Customer" href="javascript:void(0)">
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

    public function create()
    {
        $title = 'Add New Customer';
        $all_plans = Pricing::all();
        $invoice_exports = ['Daily', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Last Day of Month'];
        return view('admin.customers.edit', ['title' => $title, 'plans' => $all_plans, 'invoice_exports' => $invoice_exports, 'contacts' => [], 'sites' => []]);
    }

    public function store(Request $request)
    {
        $title = 'Edit customer';
        $this->validate($request, [
            'name' => 'required|max:255',
            'plan' => 'required|max:255'
        ]);

        $input = $request->all();
        $user = new User();
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;
        }

        $user->name = $input['name'];
        $user->plan = $input['plan'];
        $user->save();

        //Session::flash('success_message', 'Great! Customer has been saved successfully!');
        $user->save();

        $all_plans = Pricing::all();

        if ($user) {
            return view('admin.customers.edit', ['user' => $user, 'plans' => $all_plans, 'title' => $title]);
        }
    }

    public function getXeroContacts(){
        try{
            $user = auth()->user();
            $accessToken = new AccessToken((array)json_decode($user->xero_access_token));
            $xero1 = new \XeroPHP\Application($accessToken, $user->tenant_id);

            $contacts = $xero1->load(\XeroPHP\Models\Accounting\Contact::class)
            ->where('IsCustomer	', true)
            ->execute();

            $customers = User::where('is_admin', 0)->where('is_show', 1)
                ->leftJoin('customer_account_details', 'customer_account_details.customer_id', '=', 'users.id')
                ->select('users.id', 'xero_data')
                ->get();

            return response()->json(['status' => true, 'contacts' => (array)$contacts, 'customers'=>$customers ], 200);
        }catch(Exception $e) {
            return response()->json(['status' => false, 'message'=>$e->getMessage()], 200);
        }

    }

    public function syncXeroContacts(Request $request){
        try{
            $input = $request->all();
            $contacts =json_decode($input['contacts']);

            foreach ($contacts as $key => $contact) {
                $user = new User();
                if(isset($contact->dbID)){
                    $user = User::find($contact->{'dbID'});
                }
                $user->name = $contact->{'Name'};
                $user->email = $contact->{'EmailAddress'};
                // $user->phone = count($contact->{'Phones'});
                $user->is_admin = 0;
                $user->active = 1;
                $user->is_show = 1;
                $user->save();
                if ($user) {
                    //------------ Customer Site -------------

                    $cSite = new CustomerSites();
                    if(isset($contact->dbID)){
                        $cSite = CustomerSites::where('customer_id', $contact->{'dbID'})->first();
                    }
                    $cSite->customer_id = $user->id;
                    $cSite->site_name = 'MUST CHANGE';
                    $cSite->address_line_1 = isset($contact->{'Addresses'}[1]->{'AddressLine1'})?$contact->{'Addresses'}[1]->{'AddressLine1'}:'';
                    $cSite->address_line_2 = isset($contact->{'Addresses'}[1]->{'AddressLine2'})?$contact->{'Addresses'}[1]->{'AddressLine2'}:'';
                    $cSite->address_line_3 = isset($contact->{'Addresses'}[1]->{'AddressLine3'})?$contact->{'Addresses'}[1]->{'AddressLine3'}:'';
                    $cSite->address_line_4 = isset($contact->{'Addresses'}[1]->{'AddressLine4'})?$contact->{'Addresses'}[1]->{'AddressLine4'}:'';
                    $cSite->suburb = isset($contact->{'Addresses'}[1]->{'City'})?$contact->{'Addresses'}[1]->{'City'}:'';
                    $cSite->postal_code = isset($contact->{'Addresses'}[1]->{'PostalCode'})?$contact->{'Addresses'}[1]->{'PostalCode'}:'';
                    $cSite->state = isset($contact->{'Addresses'}[1]->{'Region'})?$contact->{'Addresses'}[1]->{'Region'}:'';
                    $cSite->operating_hours =
                        (isset($contact->{'PaymentTerms'}->{'Sales'}->{'Day'})?$contact->{'PaymentTerms'}->{'Sales'}->{'Day'}:'')
                        .'-'.
                        (isset($contact->{'PaymentTerms'}->{'Sales'}->{'Type'})?$contact->{'PaymentTerms'}->{'Sales'}->{'Type'}:'');
                    // $cSite->site_contact = $val->{'site_contact'};
                    $cSite->save();


                    //------------ Customer Contact -------------
                    $cContact = new CustomerContacts();
                    if(isset($contact->dbID)){
                        $cContact = CustomerContacts::where('customer_id', $contact->{'dbID'})->first();
                    }
                    $cContact->customer_id = $user->id;
                    $cContact->contact_name =  $contact->{'FirstName'}.' '. $contact->{'LastName'};
                    $cContact->position = 'Customer';
                    foreach ($contact->{'Phones'} as $key => $value) {
                        switch($value->{'PhoneType'}){
                            case 'MOBILE':
                                $cContact->mobile_phone = isset($value->{'PhoneNumber'})?$value->{'PhoneNumber'}:'';
                                break;
                            case 'DEFAULT':
                                $cContact->office_phone = isset($value->{'PhoneNumber'})?$value->{'PhoneNumber'}:'';
                                break;
                            // case 'FAX':
                            //     $cContact->office_phone = $value->{'PhoneNumber'};
                            //     break;
                        }
                    }
                    $cContact->email = $contact->{'EmailAddress'};
                    $cContact->alerts = 0;
                    $cContact->save();

                    //////////////////////////
                    $account_detail = new account_detail();
                    if(isset($contact->dbID)){
                        $account_detail = account_detail::where('customer_id', $contact->{'dbID'})->first();
                    }
                    $account_detail->customer_id = $user->id;
                    $account_detail->business_name = $contact->{'FirstName'}.' '. $contact->{'LastName'};
                    // $account_detail->trading_name = $request['trading_name'];
                    // $account_detail->account_manager = $request['account_manager'];
                    // $account_detail->account_status = $request['account_status'];
                    $account_detail->account_code = isset($contact->{'AccountNumber'})?$contact->{'AccountNumber'}:'';
                    // $account_detail->industry = $request['industry'];
                    // $account_detail->ABN = $request['abn'];
                    // $account_detail->ACN = $request['acn'];
                    $account_detail->payment_terms = 'cod';
                    // $account_detail->credit_limit = $request['credit_limit'];
                    // $account_detail->billing_method = $request['billing_method'];
                    // $account_detail->review_date = $request['Review_date'];
                    $account_detail->gen_invoice_chk = 'Yes';
                    $account_detail->xero_link_chk = 'Yes';
                    $account_detail->invoice_export = (isset($contact->{'PaymentTerms'}->{'Sales'}->{'Day'})?$contact->{'PaymentTerms'}->{'Sales'}->{'Day'}:'')
                        .'-'.
                        (isset($contact->{'PaymentTerms'}->{'Sales'}->{'Type'})?$contact->{'PaymentTerms'}->{'Sales'}->{'Type'}:'');
                    $account_detail->xero_data = json_encode($contact);
                    $account_detail->save();
                }
            }
            return response()->json(['status' => true ,'message'=>$contacts], 200);
        }catch(Exception $e) {
            return response()->json(['status' => false, 'message'=>$e->getMessage()], 200);
        }

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.customers.single', ['title' => 'Customer detail', 'user' => $user]);
    }

    public function customerDetail(Request $request)
    {

        $user = User::findOrFail($request->id);


        return view('admin.customers.detail', ['title' => 'Customer Detail', 'user' => $user]);
    }

    public function getSingleCustomer(Request $request)
    {
        $id = $request->id;
        //return $id;
        $user = User::where('id', $id)
            ->with('price_plan')
            ->with('attachments')
            ->with('notes')
            ->with('sites')
            ->with('secondary_contact')
            ->with('primary_contact')
            ->with('other_contact')
            ->with('address')
            ->with('account_detail')->first();

        return $user;
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
            ->with('attachments')
            ->with('notes')
            ->with('sites')
            // ->with('secondary_contact')
            // ->with('primary_contact')
            ->with('other_contact')
            ->with('address')
            ->with('account_detail')->first();
        // var_dump($user);
        $all_plans = Pricing::all();
        $title = "Edit customer details";

        $cContacts = CustomerContacts::where('customer_id', $id)->get();
        $cSites = CustomerSites::where('customer_id', $id)->get();

        $invoice_exports = ['Daily', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Last Day of Month'];

        return view('admin.customers.edit', [
            'user' => $user, 'plans' => $all_plans, 'title' => $title,
            'invoice_exports' => $invoice_exports, 'contacts' => $cContacts, 'sites' => $cSites
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $user->id,
        ]);
        $input = $request->all();

        $user->name = $input['name'];
        $user->email = $input['email'];
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;
        }
        if (!empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        $user->save();

        Session::flash('success_message', 'Great! customer successfully updated!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->is_admin == 0) {
            $user->delete();
            Session::flash('success_message', 'User successfully deleted!');
        }
        return redirect()->route('customers.index');
    }

    public function deleteSelectedCustomers(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'clients' => 'required',

        ]);
        foreach ($input['clients'] as $index => $id) {

            $user = User::find($id);
            if ($user->is_admin == 0) {
                $user->delete();
            }
        }
        Session::flash('success_message', 'customer successfully deleted!');
        return redirect()->back();
    }



    //store customer
    public function store_customer(Request $request)
    {
        $request->validate([
            'file' => 'max:2048',
        ]);
        //return $request->all();
        $user = new User();
        $user->name = $request['c_name'];
        $user->plan = $request['c_plan'];
        $user->active = $request['c_active'];
        $user->primary_contact = $request['primary_contact'];
        $user->primary_site = $request['primary_site'];
        $user->save();
        if ($user) {
            //------------ Customer Site -------------
            $siteData = json_decode($request['siteData']);
            foreach ($siteData as $key => $val) {
                $cSite = new CustomerSites();
                $cSite->customer_id = $user->id;
                $cSite->site_name = $val->{'site_name'};
                $cSite->address_line_1 = $val->{'address_line_1'};
                $cSite->address_line_2 = $val->{'address_line_2'};
                $cSite->suburb = $val->{'suburb'};
                $cSite->postal_code = $val->{'postal_code'};
                $cSite->state = $val->{'state'};
                $cSite->operating_hours = $val->{'operating_hours'};
                // $cSite->site_contact = $val->{'site_contact'};
                $cSite->save();
            }

            //------------ Customer Contact -------------
            $contactData = json_decode($request['contactData']);
            foreach ($contactData as $key => $val) {
                $cContact = new CustomerContacts();
                $cContact->customer_id = $user->id;
                $cContact->contact_name = $val->{'contact_name'};
                $cContact->position = $val->{'position'};
                $cContact->mobile_phone = $val->{'mobile_phone'};
                $cContact->office_phone = $val->{'office_phone'};
                $cContact->email = $val->{'email'};
                $cContact->alerts = $val->{'alerts'};
                $cContact->save();
            }

            //------------ Customer Booking -------------
            $bookingData = json_decode($request['bookingData']);
            foreach ($bookingData as $key => $val) {
                $cBooking = new CustomerBookings();
                $cBooking->customer_id = $user->id;
                $cBooking->statusv = $val->{'statusv'};
                $cBooking->consignment = $val->{'consignment'};
                $cBooking->item_qty = $val->{'item_qty'};
                $cBooking->sender = $val->{'sender'};
                $cBooking->receiver = $val->{'receiver'};
                $cBooking->delivery_date = $val->{'delivery_date'};
                $cBooking->amount = $val->{'amount'};
                $cBooking->save();
            }

            //------------ Customer Invoice -------------
            $invoiceData = json_decode($request['invoiceData']);
            foreach ($invoiceData as $key => $val) {
                $cInvoice = new CustomerInvoices();
                $cInvoice->customer_id = $user->id;
                $cInvoice->invoice_no = $val->{'invoice_no'};
                $cInvoice->consignment = $val->{'consignment'};
                $cInvoice->sender = $val->{'sender'};
                $cInvoice->receiver = $val->{'receiver'};
                $cInvoice->delivery_date = $val->{'delivery_date'};
                $cInvoice->amount = $val->{'amount'};
                $cInvoice->save();
            }

            //////////////////
            $customer_address = new customer_address();
            $customer_address->customer_id = $user->id;
            $customer_address->p_address_line_1 = $request['p_address_line_1'];
            $customer_address->p_address_line_2 = $request['p_address_line_2'];
            $customer_address->p_suburb = $request['p_suburb'];
            $customer_address->p_postal_code = $request['p_postal_code'];
            $customer_address->p_state = $request['p_state'];
            $customer_address->p_opening_time = $request['p_opening_time'];

            $customer_address->b_address_line_1 = $request['b_address_line_1'];
            $customer_address->b_address_line_2 = $request['b_address_line_2'];
            $customer_address->b_suburb = $request['b_suburb'];
            $customer_address->b_postal_code = $request['b_postal_code'];
            $customer_address->b_state = $request['b_state'];
            $customer_address->b_opening_time = $request['b_opening_time'];

            $customer_address->receiver_address_line_1 = $request['receiver_address_line_1'];
            $customer_address->receiver_address_line_2 = $request['receiver_address_line_2'];
            $customer_address->r_suburb = $request['r_suburb'];
            $customer_address->r_postal_code = $request['r_postal_code'];
            $customer_address->receiver_state = $request['receiver_state'];
            $customer_address->r_opening_time = $request['r_opening_time'];

            $customer_address->save();
            //////////////////
            $account_detail = new account_detail();
            $account_detail->customer_id = $user->id;
            $account_detail->business_name = $request['business_name'];
            $account_detail->trading_name = $request['trading_name'];
            $account_detail->account_manager = $request['account_manager'];
            $account_detail->account_status = $request['account_status'];
            $account_detail->account_code = $request['account_code'];
            $account_detail->industry = $request['industry'];
            $account_detail->ABN = $request['abn'];
            $account_detail->ACN = $request['acn'];
            $account_detail->payment_terms = $request['payment_term'];
            $account_detail->credit_limit = $request['credit_limit'];
            $account_detail->billing_method = $request['billing_method'];
            $account_detail->review_date = $request['Review_date'];
            $account_detail->gen_invoice_chk = $request['gen_invoice_chk'];
            $account_detail->xero_link_chk = $request['xero_link_chk'];
            $account_detail->invoice_export = $request['invoice_export'];

            $account_detail->save();

            ///////////////////
            ///

            if ($request['note'][0] != null) {
                for ($i = 0; $i < count($request['note']); $i++) {
                    $note = new notes();
                    $note->customer_id = $user->id;
                    $note->note = $request['note'][$i];
                    $note->author = $request['author_name'][$i];
                    $note->date = $request['date'][$i];
                    $note->save();
                }
            }



            /////////////////////
            if ($request->file != null) {
                $fileName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('uploads'), $fileName);

                $file = new attachments();
                $file->customer_id = $user->id;
                $file->file = $fileName;
                $file->save();
            }


            $uuser = User::find($user->id);
            $uuser->is_show = 1;
            $uuser->save();
            // Session::flash('success_message', 'Great! Customer has been save successfully!');
            // return redirect()->back();
            return response()->json(['status' => true, 'res' => 1, 'message' => ' Customer created successfully'], 200);
        }
    }
    public function update_customer(Request $request)
    {

        $request->validate([
            'file' => 'max:2048',
        ]);

        //return $request->all();
        $user = User::find($request['c_id']);
        $user->name = $request['c_name'];
        $user->plan = $request['c_plan'];
        $user->active = $request['c_active'];
        $user->primary_contact = $request['primary_contact'];
        $user->primary_site = $request['primary_site'];
        $user->save();
        if ($user) {


            ////////////////
            $customer_address = customer_address::where('customer_id', $request['c_id'])->first();
            $customer_address->customer_id = $request['c_id'];
            $customer_address->p_address_line_1 = $request['p_address_line_1'];
            $customer_address->p_address_line_2 = $request['p_address_line_2'];
            $customer_address->p_suburb = $request['p_suburb'];
            $customer_address->p_postal_code = $request['p_postal_code'];
            $customer_address->p_state = $request['p_state'];
            $customer_address->p_opening_time = $request['p_opening_time'];

            $customer_address->b_address_line_1 = $request['b_address_line_1'];
            $customer_address->b_address_line_2 = $request['b_address_line_2'];
            $customer_address->b_suburb = $request['b_suburb'];
            $customer_address->b_postal_code = $request['b_postal_code'];
            $customer_address->b_state = $request['b_state'];
            $customer_address->b_opening_time = $request['b_opening_time'];

            $customer_address->receiver_address_line_1 = $request['receiver_address_line_1'];
            $customer_address->receiver_address_line_2 = $request['receiver_address_line_2'];
            $customer_address->r_suburb = $request['r_suburb'];
            $customer_address->r_postal_code = $request['r_postal_code'];
            $customer_address->receiver_state = $request['receiver_state'];
            $customer_address->r_opening_time = $request['r_opening_time'];

            $customer_address->save();

            /////////////////////

            $account_detail = account_detail::where('customer_id', $request['c_id'])->first();
            $account_detail->customer_id = $request['c_id'];
            $account_detail->business_name = $request['business_name'];
            $account_detail->trading_name = $request['trading_name'];
            $account_detail->account_manager = $request['account_manager'];
            $account_detail->account_status = $request['account_status'];
            $account_detail->account_code = $request['account_code'];
            $account_detail->industry = $request['industry'];
            $account_detail->ABN = $request['abn'];
            $account_detail->ACN = $request['acn'];
            $account_detail->payment_terms = $request['payment_term'];
            $account_detail->credit_limit = $request['credit_limit'];
            $account_detail->billing_method = $request['billing_method'];
            $account_detail->review_date = $request['Review_date'];
            $account_detail->gen_invoice_chk = $request['gen_invoice_chk'];
            $account_detail->xero_link_chk = $request['xero_link_chk'];
            $account_detail->invoice_export = $request['invoice_export'];

            $account_detail->save();

            /////////////////////
            ///

            if ($request['note'][0] != null) {

                $filter_notes = array_filter($request->note);
                $filer_authors = array_filter($request->author_name);
                $filter_dates = array_filter($request->date);


                DB::table('customer_notes')->where('customer_id', $request->c_id)->delete();

                for ($i = 0; $i < count($filter_notes); $i++) {
                    $note = new notes();
                    $note->customer_id = $request['c_id'];
                    $note->note = $filter_notes[$i];
                    $note->author = $filer_authors[$i];
                    $note->date = $filter_dates[$i];
                    $note->save();
                }
            }

            //////////////////////
            ///
            if ($request->file != null) {
                $fileName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('uploads'), $fileName);

                $file = attachments::where('customer_id', $request['c_id'])->first();
                if (isset($file)) {
                    $file->customer_id = $request['c_id'];
                    $file->file = $fileName;
                    $file->save();
                } else {
                    $file = new attachments();
                    $file->customer_id = $request['c_id'];
                    $file->file = $fileName;
                    $file->save();
                }
            }

            // Session::flash('success_message', 'Great! Customer has been updated successfully!');
            // return redirect()->back();
            return response()->json(['status' => true, 'res' => 1, 'message' => ' Customer updated successfully'], 200);
        }
    }
}
