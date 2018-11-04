<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    

    public $incrementing = false;
    public $timestamps = false;

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
