<?php

namespace App;

use App\Transformers\ClientTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $transformer = ClientTransformer::class;
   
    protected $fillable = [
        'ci', 'first_name', 'last_name', 'phone', 'area_id', 'address_id' 
    ];

	public function orders(){
        return $this->hasMany('App\Order');
    } 

    public function devices(){
        return $this->hasMany('App\Device');
    } 

    public function area(){
        return $this->belongsTo('App\Area');
    } 

    public function address(){
        return $this->belongsTo('App\Address');
    } 



}
