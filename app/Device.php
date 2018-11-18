<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'sub_device_id', 'brand_id', 'client_id', 'b_n', 'model',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function subDevice(){
        return $this->belongsTo('App\SubDevice');
    }


}
