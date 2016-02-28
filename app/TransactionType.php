<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    //
    protected $table = 'tbl_transaction_type_labels';
    protected $primaryKey = 'transaction_type_id';
}
