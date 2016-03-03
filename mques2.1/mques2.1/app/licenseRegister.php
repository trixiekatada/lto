<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class licenseRegister extends Model
{
	 protected $primaryKey = "transactionID";
     protected $table = 'license_registration';
     public    $timestamps = false;


     public function getUser(){
     	return $this->hasMany("App\Users","id" ,"id");
     }
}
