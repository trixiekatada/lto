<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    //

    protected $table = 'tbl_client_info';
    protected $primaryKey  = 'client_id';

    public function hasTransaction(){
    	return $this->hasOne('Transactions', 'clientID_fk', 'client_id');
    }

    public function getRegisterLicense(){
    	return $this->hasMany("App\RegisterLicense","id","id");
    }

    public function getRegisterVehicle(){
    	return $this->hasMany("App\RegisterVehicle","id","id");
    }
}
