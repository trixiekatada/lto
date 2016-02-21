<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class ClientController extends Controller {
 
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
   
    protected $loginPath = '/client/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest', ['except' => 'getLogout']);
    }

   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'transaction_id' => 'required|max:255',
            'verification_code' => 'required',            
        ]);
    }

    public function index(){
    	return view('client.login');
    }

    public function post_login(){
    	var_dump($_POST);
    }

  
   
}