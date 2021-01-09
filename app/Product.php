<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     //table name
     protected $table = 'product';
     //primary key
     protected $primaryKey = 'p_id';
     public $uniqueKey = 'p_serial_no';
     //timestamps
     public $timestamps = true;

     public function user(){
         return $this->belongsTo('App\User');
     }
}
