<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //
    
    protected $table = 'tbl_queues';
    protected $primaryKey  = 'queue_id';
    protected $fillable = ['transactionID_fk','counterID_fk', 'clientID_fk', 'queue_label'];

    public function getRegisterLicense(){
        return $this->hasMany("App\RegisterLicense", "rl_id", "rl_id" );
    }

    public function getRegisterVehicle(){
        return $this->hasMany("App\RegisterVehicle", "rv_id", "rv_id" );
    }

    public function getCounter(){
        return $this->hasMany("App\Counter", "counter_id", "counter_id");
    }
}
