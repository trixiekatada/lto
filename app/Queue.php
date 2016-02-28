<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //
    
    protected $table = 'tbl_queues';
    protected $primaryKey  = 'queue_id';
    protected $fillable = ['transactionID_fk','counterID_fk', 'clientID_fk'];

    //relation to tbl_transactions
    public function transactions(){
    	return $this->has('Transactions', 'transactionID_fk', 'transactions_id');
    }
}
