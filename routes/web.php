<?php

use App\Http\Controllers\Admin\JobController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


use Dcblogdev\Xero\Facades\Xero;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/manage/xero', [\App\Http\Controllers\Admin\XeroController::class, 'index'])->name('xero.auth.success');

// Route::group(['middleware' => ['web', 'auth']], function(){
//     Route::get('xero', function(){

//         if (! Xero::isConnected()) {
//             return redirect('xero/connect');
//         } else {
//             //display your tenant name
//             return Xero::getTenantName();
//         }

//     });

//     Route::get('xero/connect', function(){
//         return Xero::connect();
//     });
// });


// Route::group(['middleware' => ['web', 'XeroAuthenticated']], function(){
//     Route::get('xero', function(){
//         return Xero::getTenantName();
//     });
// });

// Route::get('xero/connect', function(){
//     return Xero::connect();
// });




Route::get('/', function () {
    return view('auth.login');
});

Route::get('/ef6c412c0c5c8baaef5d657738b52ae1.html', function () {
    return view('auth.login');
});


Route::get('/clear', function () {

    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('storage:link');
});

// Route::get('storage/{filename}', function ($filename)
// {
//     var_dump("ddddddddd");
//     die;
//     $path = storage_path('public/' . $filename);

//     if (!File::exists($path)) {
//         abort(404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;
// });

Auth::routes();

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'client',
    'namespace'     => 'Client'
], function () {
    Route::get('/dashboard', 'ClientController@index')->name('client.dashboard');
    Route::get('/profile', 'ClientController@edit')->name('client-profile');
    Route::post('/admin-update', 'ClientController@update')->name('client-update');
});

Route::group([
    'middleware'    => ['auth', 'is_admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function () {
    Route::get('xero/connect','XeroController@connect')->name('admin.xero.connect');
    Route::get('xero/disconnect','XeroController@disconnect');
    Route::get('xero/getTenantId','XeroController@getTenantId');
    Route::get('xero/getInvoices','XeroController@getInvoices');
    Route::get('xero/getContacts','XeroController@getContacts');
    Route::get('xero/test','XeroController@test');
    Route::get('xero/callback','XeroController@handleCallbackFromXero');



    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting', 'SettingController');
    Route::resource('user', 'UsersController');
    Route::get('integration', 'SettingController@integrations')->name('setting.integration');


    //Customer Routes
    Route::resource('customers', 'CustomerController');

    Route::post('get_customer', 'CustomerController@getSingleCustomer')->name('get_customer');
    Route::post('get_xero_contacts','CustomerController@getXeroContacts')->name('get_xero_contacts');
    Route::post('sync_xero_contacts','CustomerController@syncXeroContacts')->name('sync_xero_contacts');


    Route::post('store_customer', 'CustomerController@store_customer')->name('store_customer');
    Route::post('update_customer', 'CustomerController@update_customer')->name('update_customer');


    //customer contacts
    Route::post('store_customer_contacts', 'CustomerController@store_customer_contacts')->name('store_customer_contacts');
    Route::post('update_customer_contacts', 'CustomerController@update_customer_contacts')->name('update_customer_contacts');

    //customer address
    Route::post('store_customer_address', 'CustomerController@store_customer_address')->name('store_customer_address');
    Route::post('update_customer_address/{id}', 'CustomerController@update_customer_address')->name('update_customer_address');


    //customer detail
    Route::post('store_account_detail', 'CustomerController@store_account_detail')->name('store_account_detail');
    Route::post('update_account_detail{id}', 'CustomerController@update_account_detail')->name('update_account_detail');


    //customer notes
    Route::post('store_notes', 'CustomerController@store_notes')->name('store_notes');
    Route::post('update_notes', 'CustomerController@update_notes')->name('update_notes');


    //customer file
    Route::post('store_customer_file', 'CustomerController@store_customer_file')->name('store_customer_file');
    Route::post('update_customer_file/{id}', 'CustomerController@update_customer_file')->name('update_customer_file');


    //Customer Sites
    Route::resource('customer_sites', 'CustomerSiteController');
    Route::post('get_customer_sites', 'CustomerSiteController@getSites')->name('get_customer_sites');
    Route::post('update_site', 'CustomerSiteController@updateSite')->name('update_site');
    Route::post('delete_site', 'CustomerSiteController@deleteSite')->name('delete_site');

    //Customer Contacts
    Route::resource('customer_contacts', 'CustomerContactController');
    Route::post('get_customer_contacts', 'CustomerContactController@getContacts')->name('get_customer_contacts');
    Route::post('update_contact', 'CustomerContactController@updateContact')->name('update_contact');
    Route::post('delete_contact', 'CustomerContactController@deleteContact')->name('delete_contact');

    //Customer Bookings
    Route::resource('customer_bookings', 'CustomerBookingController');
    Route::post('get_customer_bookings', 'CustomerBookingController@getBookings')->name('get_customer_bookings');
    Route::post('update_booking', 'CustomerBookingController@updateBooking')->name('update_booking');
    Route::post('delete_booking', 'CustomerBookingController@deleteBooking')->name('delete_booking');

    //Customer Invoices
    Route::resource('customer_invoices', 'CustomerInvoiceController');
    Route::post('get_customer_invoices', 'CustomerInvoiceController@getInvoices')->name('get_customer_invoices');
    Route::post('update_invoice', 'CustomerInvoiceController@updateInvoice')->name('update_invoice');
    Route::post('delete_invoice', 'CustomerInvoiceController@deleteInvoice')->name('delete_invoice');


    //customer sites
    Route::post('store_customer_site', 'CustomerController@store_customer_site')->name('store_customer_site');
    Route::post('update_customer_site', 'CustomerController@update_customer_site')->name('update_customer_site');

    Route::post('get-customers', 'CustomerController@getCustomers')->name('admin.getCustomers');
    Route::post('get-customer', 'CustomerController@customerDetail')->name('admin.getCustomer');
    Route::get('customer/delete/{id}', 'CustomerController@destroy');
    Route::post('delete-selected-customers', 'CustomerController@deleteSelectedCustomers')->name('admin.delete-selected-customers');


    //Manifest Routes
    Route::resource('manifest', 'ManifestController');
    Route::post('get-manifests', 'ManifestController@getManifests')->name('admin.getManifests');
    Route::post('delete-selected-manifests', 'ManifestController@deleteSelectedManifests')->name('admin.delete-selected-manifests');
    Route::post('get-manifest', 'ManifestController@getManifest')->name('admin.getManifest');
    Route::get('manifest/delete/{id}', 'ManifestController@destroy');

    //Pricing Routes
    //Route::get('/pricing/store', 'PricingController@store');
    Route::get('/update-pricing', 'PricingController@update')->name('updatePricing');
    Route::resource('pricing', 'PricingController');
    Route::post('get-pricings', 'PricingController@getPricings')->name('admin.getPricings');
    Route::post('delete-selected-pricings', 'PricingController@deleteSelectedPricing')->name('admin.delete-selected-pricings');
    Route::post('get-pricing', 'PricingController@getPricing')->name('admin.getPricing');
    Route::get('pricing/delete/{id}', 'PricingController@destroy');
    Route::post('/get_add_price_by_weight', 'PricingController@get_price_by_weight');
    Route::post('/get_add_price_by_spc', 'PricingController@get_price_by_spc');
    Route::get('get-all-pricings', 'PricingController@get_all')->name('get-all-pricings');
    Route::get('pricing/get_price_detail/{id}', 'PricingController@get_price_detail')->name('admin.get_price_detail');



    //items routes
    //    Route::resource('items', 'ItemController');
    //    Route::post('get-items', 'ItemController@getItems')->name('admin.getItems');
    //    Route::post('delete-selected-items', 'ItemController@deleteSelectedItems')->name('admin.delete-selected-items');
    //    Route::post('get-item', 'ItemController@getItem')->name('admin.getItem');
    //    Route::get('items/delete/{id}', 'ItemController@destroy');

    // JOb Pallet routes
    Route::resource('pallet', 'PalletController');
    Route::get('get_pallet_outstanding', 'PalletController@getOutstanding')->name('get_pallet_outstanding');
    Route::get('get_pallet_transaction', 'PalletController@getTransaction')->name('get_pallet_transaction');

    //Job Status Routes
    Route::resource('jobstatus', 'JobStatusController');
    Route::post('get-jobstatuses', 'JobStatusController@getJobsStatus')->name('admin.getJobsStatus');
    Route::get('jobstatus/delete/{id}', 'JobStatusController@destroy');
    Route::post('delete-selected-status', 'JobStatusController@deleteSelectedStatus')->name('admin.delete-selected-status');

    //Branches Routes
    Route::resource('branches', 'BranchesController');
    Route::post('get-branches', 'BranchesController@getBranches')->name('admin.getBranches');
    Route::get('branches/delete/{id}', 'BranchesController@destroy');
    Route::post('delete-selected-branches', 'BranchesController@deleteSelectedBranches')->name('admin.delete-selected-branches');

    //items routes
    Route::resource('items', 'ManageItemsController');
    Route::post('get-items', 'ManageItemsController@getItems')->name('admin.getItems');
    Route::get('items/delete/{id}', 'ManageItemsController@destroy');
    Route::post('delete-selected-items', 'ManageItemsController@deleteSelectedItems')->name('admin.delete-selected-items');
    Route::post('get-item', 'ManageItemsController@getItem')->name('admin.getItem');


    Route::resource('jobs', 'JobController');
    Route::post('job_file', 'JobController@job_file');
    Route::get('create-job-status', 'JobController@create_job_status')->name('create_job_status');
    Route::post('update-job-status', 'JobController@update_job_status')->name('update_job_status');
    Route::get('export-pdf/{id}', 'JobController@exportPdf')->name('export_pdf');
    Route::post('export-pdf-post', 'JobController@exportPdfPost')->name('export-pdf-post');
    Route::get('export-label-pdf/{id}', 'JobController@exportLabelPdf')->name('export_label_pdf');
    Route::post('export-label-pdf-post', 'JobController@exportLabelPdfPost')->name('export-label-pdf-post');
    Route::get('jobs/delete/{id}', 'JobController@destroy');
    Route::post('delete-selected-freights', 'JobController@deleteSelectedFreights')->name('admin.delete-selected-freights');
    Route::post('update-job-status-bulk', 'JobController@update_job_status_bulk')->name('update_job_status_bulk');

    Route::get('jobs_email/{id}', 'JobController@exportJobsEmail')->name('jobs_email');

    Route::get('get-freight', [JobController::class, 'getFreight'])->name('admin.getFreight');
    Route::get('freight', [JobController::class, 'index'])->name('freight-index');


    Route::get('dirver', 'DriverController@index')->name('driver.index');
    Route::get('get_drivers', 'DriverController@get_drivers')->name('get_drivers');
    Route::post('get_driver', 'DriverController@get_driver')->name('get_driver');
    Route::get('create-driver', 'DriverController@create_driver')->name('driver.create');
    Route::post('store-driver', 'DriverController@store_driver')->name('driver.store');
    Route::get('driver-edit/{id}', 'DriverController@edit_driver')->name('driver.edit');
    Route::post('update-driver/{id}', 'DriverController@update_driver')->name('driver.update');
    Route::post('delete-selected-drivers', 'DriverController@deleteSelectedDrivers')->name('admin.delete-selected-drivers');
    Route::get('driver/delete/{id}', 'DriverController@destroy');

    //Job manifest routes
    Route::post('add_job_to_manifest', 'JobManifestController@add_job_to_manifest')->name('add_job_to_manifest');
    Route::post('remove_jobs_from_manifest', 'JobManifestController@remove_jobs_from_manifest')->name('remove_jobs_from_manifest');
    Route::post('update_manifest', 'JobManifestController@update_manifest')->name('update_manifest');
    Route::get('print_manifest/{id}', 'ManifestController@print_manifest')->name('print_manifest');

    //Employee Routes
    Route::resource('employee', 'EmployeeController');
    Route::get('get-employees', 'EmployeeController@getEmployees')->name('admin.getEmployees');
    Route::get('employee/delete/{id}', 'EmployeeController@destroy');
    Route::post('delete-selected-employee', 'EmployeeController@deleteSelectedEmployee')->name('admin.delete-selected-employee');
    Route::get('get-employee', 'EmployeeController@getEmployee')->name('admin.getEmployee');

    /////////////////////
    ///spare routes

    Route::post('calculate_m_1', 'JobController@calculate_m_1')->name('calculate_m_1');
    Route::post('calculate_m_2', 'JobController@calculate_m_2')->name('calculate_m_2');
    Route::post('calculate_m_3', 'JobController@calculate_m_3')->name('calculate_m_3');
    Route::post('calculate_m_4', 'JobController@calculate_m_4')->name('calculate_m_4');
    Route::get('calculate_m_5', 'JobController@calculate_m_5')->name('calculate_m_5');
    Route::get('calculate_m_6', 'JobController@calculate_m_6')->name('calculate_m_6');
});
