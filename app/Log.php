<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //table name
    protected $table = 'log';
    //primary key
    protected $primaryKey = 'l_id';
}
