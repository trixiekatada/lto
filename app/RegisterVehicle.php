<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterVehicle extends Model
{
     protected $primaryKey = "rv_id";
     protected $table = 'tbl_register_vehicle';
        public    $timestamps = false;

     public function getClientInfo(){
     	return $this->hasMany("App\ClientInfo","client_id" ,"client_id");
     }
}
