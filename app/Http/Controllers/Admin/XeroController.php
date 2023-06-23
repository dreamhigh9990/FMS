<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LangleyFoxall\XeroLaravel\OAuth2;
use League\OAuth2\Client\Token\AccessToken;

use LangleyFoxall\XeroLaravel\XeroApp;


use XeroApi\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Api;

use Calcinai\OAuth2\Client\Provider\Xero;
use DateTime;

// use Dcblogdev\Xero\Facades\Xero;

class XeroController extends Controller
{
    public function connect(){
        // return Xero::connect();
        return $this->redirectUserToXero();
    }

    // public function disconnect(){
    //     if (Xero::isConnected()) {
    //         return Xero::disconnect();
    //     }
    //     return "disconnected";
    // }

    // public function getTenantId(){
    //     if (!Xero::isConnected()) {
    //         return redirect('admin/xero/connect');
    //     } else {
    //         return Xero::getTenantName();
    //         // return ['invoices' => Xero::invoices()->get(1)];
    //         // return ['contacts' => array_map(fn ($val) => $val['Name'], Xero::contacts()->get(1)), 'invoices' => array_map(fn ($val) => $val['InvoiceNumber'], Xero::invoices()->get(1))];
    //     }
    // }

    // public function getInvoices(){
    //     if (!Xero::isConnected()) {
    //         return redirect('admin/xero/connect');
    //     } else {
    //         return Xero::invoices()->get();
    //     }
    // }
    // public function getContacts(){
    //     if (!Xero::isConnected()) {
    //         return redirect('admin/xero/connect');
    //     } else {
    //         return Xero::contacts()->get();
    //     }
    // }

    public function test()
    {
        // return $this->refreshAccessTokenIfNecessary();
        $user = auth()->user();
        $accessToken = new AccessToken((array)json_decode($user->xero_access_token));


        $xero1 = new \XeroPHP\Application($accessToken, $user->tenant_id);

        $contacts = $xero1->load(\XeroPHP\Models\Accounting\Contact::class)
        ->where('EmailAddress', 'vladtarasov20203@gmail.com')
        ->execute();
        $invoices = $xero1->load(\XeroPHP\Models\Accounting\Invoice::class)->execute();
        $accounts = $xero1->load(\XeroPHP\Models\Accounting\Account::class)->execute();


        ///////////// Save a new contact

        // $contact111 = new \XeroPHP\Models\Accounting\Contact($xero1);
        // $contact111->setName('Test Contact')
        //     ->setFirstName('Vlad')
        //     ->setLastName('Tarasov')
        //     ->setEmailAddress('vladtarasov20203@gmail.com');

        // $contact111->save();


        ///////////// Save a new invoice

        $lineItem = new \XeroPHP\Models\Accounting\LineItem();
        $lineItem->setDescription('Test Invoice')
            ->setQuantity(11)
            ->setAccountCode($accounts[1]['Code'])
            ->setUnitAmount(111);

        $invoice = new \XeroPHP\Models\Accounting\Invoice($xero1);
        $invoice->setReference('Ref-1111')
            ->setDueDate(new DateTime('2022-10-30'))
            ->setContact($contacts[0])
            ->addLineItem($lineItem)
            ->setStatus(\XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_AUTHORISED)
            ->setType(\XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCREC)
            ->setLineAmountType(\XeroAPI\XeroPHP\Models\Accounting\LineAmountTypes::EXCLUSIVE);

        $invoice->save();


        // $xero1->save($invoice, false);


        return $accounts;




        // $xero = new XeroApp(
        //     $accessToken,
        //     $user->tenant_id
        // );
        // $contacts = $xero->contacts;
        // $invoices = $xero->invoices;
        // var_dump($contacts->values()->get(0));

        // $data=['contact'=>$invoices->toArray()[0]['contact']];

        // $lineitems = [];
        // $contact = new \XeroAPI\XeroPHP\Models\Accounting\Contact;
        // $contact->setContactId('c10c71cf-0af2-4c20-90d8-a8ee588fa418');

        // $arr_invoices = [];

        // $invoice_1 = new \XeroAPI\XeroPHP\Models\Accounting\Invoice;
        // $invoice_1->setReference('Ref-1111')
        //     ->setDueDate(new DateTime('2022-10-30'))
        //     ->setContact($contact)
        //     ->setLineItems($lineitems)
        //     ->setStatus(\XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_AUTHORISED)
        //     ->setType(\XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCPAY)
        //     ->setLineAmountTypes(\XeroAPI\XeroPHP\Models\Accounting\LineAmountTypes::EXCLUSIVE);

        // array_push($arr_invoices, $invoice_1);

        // $invoices = new \XeroAPI\XeroPHP\Models\Accounting\Invoices;
        // $invoices->setInvoices($arr_invoices);
        // var_dump($newInv);

        // $org = $xero1->load(\XeroPHP\Models\Accounting\Invoice::class)->execute();
        // print_r($org);
        // $invoice = $xero1->loadByGUID(\Accounting\Invoice::class, '[GUID]');

        // var_dump($invoices->toArray()[0]['contact']);
        // array_push($invoices, $invoices[0]);
        // $res = $xero->setInvoices($arr_invoices);
    }

    private function getOAuth2()
    {
        // This will use the 'default' app configuration found in your 'config/xero-laravel-lf.php` file.
        // If you wish to use an alternative app configuration you can specify its key (e.g. `new OAuth2('other_app')`).
        return new OAuth2();
    }

    public function redirectUserToXero()
    {
        // Step 1 - Redirect the user to the Xero authorization URL.
        return $this->getOAuth2()->getAuthorizationRedirect();
    }

    public function handleCallbackFromXero(Request $request)
    {
        // Step 2 - Capture the response from Xero, and obtain an access token.
        $accessToken = $this->getOAuth2()->getAccessTokenFromXeroRequest($request);

        // Step 3 - Retrieve the list of tenants (typically Xero organisations), and let the user select one.
        $tenants = $this->getOAuth2()->getTenants($accessToken);
        $selectedTenant = $tenants[0]; // For example purposes, we're pretending the user selected the first tenant.

        // Step 4 - Store the access token and selected tenant ID against the user's account for future use.
        // You can store these anyway you wish. For this example, we're storing them in the database using Eloquent.
        $user = auth()->user();
        $user->xero_access_token = json_encode($accessToken);
        $user->tenant_id = $selectedTenant->tenantId;
        $user->save();
    }

    public function refreshAccessTokenIfNecessary()
    {
        // Step 5 - Before using the access token, check if it has expired and refresh it if necessary.
        $user = auth()->user();
        $accessToken = new AccessToken(json_decode($user->xero_access_token));

        if ($accessToken->hasExpired()) {
            $accessToken = $this->getOAuth2()->refreshAccessToken($accessToken);

            $user->xero_access_token = $accessToken;
            $user->save();
        }
    }
}
