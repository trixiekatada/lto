<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenewLicense extends Model
{
    protected $primaryKey = "id";
     protected $table = 'tbl_renew_license';
     public    $timestamps = false;

     public function getClientInfo(){
     	return $this->hasOne("App\ClientInfo","client_id" ,"client_id");
     }
}
