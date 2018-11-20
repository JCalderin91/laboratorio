<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    
    protected $fillable = [
        'user_id', 'order_id', 'status', 'description', 'created',
    ];

    public $incrementing = false;
    public $timestamps = false;

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
