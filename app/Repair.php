<?php

namespace App;

use App\Transformers\RepairTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repair extends Model
{
    
    const ORDER_REPAIRED = 'repaired';
    const ORDER_WITHOUT_REPAIR = 'without repair';

    use SoftDeletes;

    public $transformer = RepairTransformer::class;

    protected $dates = ['deleted_at', 'created'];
    
    protected $fillable = [
        'user_id', 
        'status', 
        'description', 
    ];

    public $timestamps = false;

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function isRepair(){
        return $this->status == Repair::ORDER_REPAIRED;
    }

}
