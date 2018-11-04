<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function device(){
        return $this->belongsTo('App\Device');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function repair(){
        return $this->hasOne('App\Repair');
    }

    public $timestamps = false;

}
