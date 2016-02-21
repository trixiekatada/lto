<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model {

	protected $table = 'tbl_transactions';

	public static function verify_valid_transaction(){
		return $_POST;
	}

}