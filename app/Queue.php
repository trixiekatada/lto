<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //
    
    protected $table = 'tbl_queues';
    protected $primaryKey  = 'queue_id';
    protected $fillable = ['transactionID_fk','counterID_fk', 'clientID_fk'];
}
