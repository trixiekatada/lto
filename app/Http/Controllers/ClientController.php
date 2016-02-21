<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\ClientModel;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class ClientController extends Controller {
 
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
  
  	protected $client_model;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
	public function __construct(){
		$client_model = new ClientModel();
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
    	//verify post if transaction id exists
    	//once login insert into tbl_queue
    //	$post = Input::all();
    	var_dump($_POST);

    	$has_log = ClientModel::verify_valid_transaction();
    	var_dump($has_log);
    }

  
   
}