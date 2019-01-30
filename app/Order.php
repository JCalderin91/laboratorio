<?php

namespace App;

use Carbon\Carbon;
use App\Transformers\OrderTransformer;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    const ORDER_PENDING = 'pendiente';
    const ORDER_REVISED = 'revisado';
    const ORDER_DELIVERED = 'entregado';

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
        'serial',
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
        return $this->hasOne('App\Repair');
    }

    public function getArrivalDateAttribute($value){
        $dateTime = Carbon::parse($value);
        return $dateTime->format('d-m-Y H:i:s');
    }

    public function getDeliveryDateAttribute($value){
        
        if($value){
            $dateTime = Carbon::parse($value);   
            return $dateTime->format('d-m-Y H:i:s');
        }else{
            return null;
        }
            
    }

    public static function getSerial(){

        $date = Carbon::now()->format('dmY');
        $num = Order::whereYear('arrival_date', Carbon::now()->format('Y'))->get()->count() + 1;

        return $date.$num;
    }

    public $timestamps = false;
 

}
