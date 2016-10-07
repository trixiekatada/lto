<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenewVehicle extends Model
{
    protected $primaryKey = "id";
     protected $table = 'tbl_renew_vehicle';
     public    $timestamps = false;

     public function getClientInfo(){
     	return $this->hasOne("App\ClientInfo","client_id" ,"client_id");
     }
}
