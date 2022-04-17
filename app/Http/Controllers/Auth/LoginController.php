<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

public function username(){	
	return 'username';
}

public function email(){	
	return 'email';
}


//this returns the 'active' column value for this user
public function active(){
	return 'active';	
}


/*public function login(Request $request){
	
$credentials = $request->only('username','password');
	
if(Auth::attempt(['username'=>$username,'password'=>$password,'active'=>1],$remember)){
//validating user....
return redirect()->intended('/dashboard');
}	

//end of the authenticate function

}*/
}
