<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }


}
