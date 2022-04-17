<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('index')->with('title','Parcel Search Service');
})->name('index');

Route::get('search_service', function(Request $request){
	
	$parcelService = new \App\Http\Controllers\ParcelServiceController;
	$jsonData = $parcelService->searchAvailability($request);
	
	//print_r($jsonData['body']);
	if($jsonData !=NULL){
	if($jsonData['body'] !=NULL){
	
	
	return view('parcelfound',['jsonObj'=>json_encode($jsonData['body']), 'trackingID'=>$jsonData['body']['shipment']['idShip']])->with('title','Parcel Found, Proceed to Payment');
	
	
	}else{
	return view('parcelnotfound')->with('title','Parcel Found, Proceed to Payment');		
	}
}else{
	return redirect()->route('parcelnotfound')->with('title','Parcel Not Found - La Poste Parcel Search Service');
}
	
})->name('parcel_service_search');


//returned page showing the search status
Route::get('parcelfound', function(){
	
	return view('parcelfound');
	
})->name('parcelfound');


Route::get('parcelnotfound',function(){
	
	return view('parcelnotfound')->with('title','Parcel Not Found - La Poste Parcel Search Service');
	
})->name('parcelnotfound');


//paypal payment handler here
Route::post('handle-payment', '\App\Http\Controllers\PayPalPaymentController@payment')->name('handle-payment');

Route::get('trackinginfo_page', function(Request $request){
	
	$parcelService = new \App\Http\Controllers\ParcelServiceController;
	$jsonData = $parcelService->getParcel($request, $_GET['parcel_number']);
	if($jsonData!=NULL){
	$jsonBody = json_encode($jsonData);
	
	return view('trackinginfo_page', ['jsonBody'=>$jsonData, 'i'=>1])->with('title','Tracking Information - TrackingMore Search Service');

	}else{
	return redirect()->route('index')->with('title','Tracking Information - TrackingMore Search Service');		
	}
})->name('trackinginfo_page');

//Cancel payment transaction
Route::get('cancel-payment','\App\Http\Controllers\PayPalPaymentController@cancelTransaction')->name('cancel-payment');