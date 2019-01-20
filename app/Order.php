<?php

namespace App;

use Carbon\Carbon;
use App\Transformers\OrderTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const ORDER_PENDING = 'pendiente';
    const ORDER_REVISED = 'revisado';
    const ORDER_DELIVERED = 'entregado';

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
        return $this->belongsTo('App\Client')->withTrashed();
    }

    public function device(){
        return $this->belongsTo('App\Device')->withTrashed();
    }

    public function user(){
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function repair(){
        return $this->hasOne('App\Repair')->withTrashed();
    }

    public function getArrivalDateAttribute($value){
        $dateTime = Carbon::parse($value);
        return $dateTime->format('d-m-Y H:i:s');
    }

    public $timestamps = false;
 

}
