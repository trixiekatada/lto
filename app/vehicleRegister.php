<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicleRegister extends Model
{
   	 protected $primaryKey = 'transactionID';
     protected $table = 'vehicle_registration';
     public    $timestamps = false;


     public function getUser(){
     	return $this->hasOne("App\Users","id" ,"id");
     }
}
