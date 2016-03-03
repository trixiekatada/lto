<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterLicense extends Model
{
    protected $primaryKey = "rl_id";
     protected $table = 'tbl_register_license';
     public    $timestamps = false;


     public function getClientInfo(){
     	return $this->hasMany("App\ClientInfo","client_id" ,"client_id");
     }
}
