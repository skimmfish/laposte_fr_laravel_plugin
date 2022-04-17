<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
   
class PayPalPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


public function payment(Request $request){

		$provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => $request->return_url,
                "cancel_url" => $request->cancel_url,
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $request->currency,
                        "value" => $request->amt
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()->route('cancel-payment')->with('error', 'Something went wrong.');

        } else {
            return redirect()->route('cancel-payment')->with('error', $response['message'] ?? 'Something went wrong.');
        }

 }
   

/**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request, $trackingID)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('trackinginfo_page/{trackingID}')->with(['success'=>'Transaction complete.', 'trackingID'=>$trackingID]);
        } else {
            return redirect()->route('cancel-payment')->with('error', $response['message'] ?? 'Something went wrong.');
        }
 }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()->route('cancel-payment')->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }




	/**
	* Handles payment for paypal
	* @param Request $request obj
	*@returns payment_status and the right link based on the response returned from the paypal payment service
	*/
	
public function handlePayment(Request $request){
		
$product = [];

$product['items'] = [
[
'name' => 'Parcel Tracking Service',
'price' => $request->amt,
'currency'=>$request->currency,
'desc'  =>$request->desc,
'qty'=>1
]
];

 
$faker = \Faker\Factory::create();

$product['invoice_id'] = $faker->numerify('####-####-##');
$product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
$product['return_url'] = $request->return_url;
$product['cancel_url'] = $request->cancel_url;
$product['total'] = 2;

//initializing the checkout module
$paypalModule = new ExpressCheckout;

$res = $paypalModule->setExpressCheckout($product);

$res = $paypalModule->setExpressCheckout($product, true);

 
return redirect($res['paypal_link']);
		
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
