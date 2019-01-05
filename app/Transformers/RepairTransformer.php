<?php

namespace App\Transformers;

use App\Repair;
use League\Fractal\TransformerAbstract;

class RepairTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    protected $defaultIncludes = ['tecnico'];

    public function transform(Repair $repair)
    {
        return [
            'identificador' => (int)$repair->id,
           // 'orden' => (int)$repair->order_id,
            'estado' => (string)$repair->status,
            'fechaCreacion' => (string)$repair->created,
            'detalle' => (string)$repair->description,
            //'fechaEliminacion' => isset($repair->deleted_at) ? (string)$repair->deleted_at : null ,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'orden' => 'order_id',  
            'tecnico' => 'user_id',  
            'estado' => 'status',  
            'fechaCreacion' => 'created',  
            'detalle' => 'description',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'order_id' => 'orden',  
            'user_id' => 'tecnico',  
            'status' => 'estado',  
            'created' => 'fechaCreacion',  
            'description' => 'detalle',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public function includeTecnico(Repair $repair){
        
        $user = $repair->user;

        return $this->item($user, new UserTransformer);
    }
}
