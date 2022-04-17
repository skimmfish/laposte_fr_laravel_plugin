<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParcelServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 public $trackingNumber;
	 
	 public function __construct(){
		 
		$this->params = [
		'headers'=>[
		'Accept'=>'application/json',	 
		'X-Okapi-Key'=>'pU3l8y58HA4UPgaWQDeE3fUcx14//olzJIa2Xi5bBa0XF/eKitQ0csBx6eXSU5f6',
        'X-Forwarded-For'=>'127.0.0.1',
		'lang'=>'fr_FR',
		 ]
		 ];
	 }



    public function index()
    {
        //
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


	/**
	*@param string $parcelNumber
	*@return \Illuminate\Http\Response object
	*/
	public function searchAvailability(Request $request){
		$data = null;
		$jsonObj = null;
		
		$searchJson = null;
		$rule = [
		'parcel_number'=>'required | min:11 | max:15'
		];
		
//		$request = new \Illuminate\Http\Request; 
		
		$trackingNumber= $request->parcel_number;
		
		$validator = $request->validate($rule);
	
		
		$httpClient = new \GuzzleHttp\Client();
		$url = 'https://api.laposte.fr/suivi/v2/idships/'.$trackingNumber;
		
		//creating a cache key for subsequent retrievals
		$cacheKey = md5($url); 
		
		try{
			
		$request = $httpClient->request('GET',$url,$this->params);		

		$response = $request->getBody()->getContents();
		
		$jsonObj = json_decode($response, true);
		
		$data = ['body'=>$jsonObj, 'headers'=>$request->getHeaders()];
		
		//print_r($data);
		//print_r($jsonObj);
		
		
		}catch(\Exception $e){
			
		 //abort(500, $e->getMessage());
		
		echo $e->getMessage();
		}			
			
	return $data;
	}
	
	/*
	*@return Json_decoded object containing all the tracking info
	*/
	
	public function getParcel(Request $request,$trackingID){
		$data = null;
		$jsonObj = null;
		
		$httpClient = new \GuzzleHttp\Client();
		$url = 'https://api.laposte.fr/suivi/v2/idships/'.$trackingID;
		
		//creating a cache key for subsequent retrievals
		$cacheKey = md5($url); 
		
		try{
			
		$request = $httpClient->request('GET',$url,$this->params);		

		$response = $request->getBody()->getContents();
		
		$jsonObj = json_decode($response, true);
		
		$data = ['body'=>$jsonObj, 'headers'=>$request->getHeaders()];
		
		}catch(\Exception $e){
			
		 //abort(500, $e->getMessage());
		
		echo $e->getMessage();
		}			
			
	return $data;
	}
	
}
