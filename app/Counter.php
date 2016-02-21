<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counters';
    protected $primaryKey = 'counter_id';

    public function getCounter(){
        return $this->hasOne("App\User", "teller_id", "teller_id" );
    }
}
