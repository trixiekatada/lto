<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'tbl_queues';
    protected $primaryKey = 'queue_id';

    public function getUser(){
        return $this->hasOne("App\User", "counter_id", "counterID_fk" );
    }
}
