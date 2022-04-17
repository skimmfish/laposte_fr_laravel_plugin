<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;


class UsersController extends Controller
{

public function index(){

$response = User::orderBy('created_at','asc')->get();
return view('admin.users')->withUsers($response);


}


}
