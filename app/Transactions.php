<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //
    protected $table = 'tbl_transactions';
    protected $primaryKey  = 'transactions_id';

    public function client(){
    	return $this->hasMany('ClientInfo', 'clientID_fk', 'client_id');
    }
}
