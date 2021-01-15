<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //table name
    protected $table = 'transaction_log';
    //primary key
    protected $primaryKey = 'uuid';
}
