<?php

namespace App;

use App\Transformers\OrderTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const ORDER_PENDING = 'pending';
    const ORDER_REVISED = 'revised';
    const ORDER_DELIVERED = 'delivered';

    protected $dates = ['deleted_at'];

    public $transformer = OrderTransformer::class;
    
    protected $fillable = [
        'client_id',
        'device_id',
        'user_id',
        'arrival_date',
        'description',
        'status',
        'user_delivery_id',
        'client_name',
        'client_ci',
    ];
    
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

    public function isPending (){
        return $this->status == Order::ORDER_PENDING;
    }

    public function isRevised (){
        return $this->status == Order::ORDER_REVISED;
    }

    public function isDelivered (){
        return $this->status == Order::ORDER_DELIVERED;
    }

    public $timestamps = false;
 

}
