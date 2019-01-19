<?php

namespace App\Transformers;

use App\Area;
use League\Fractal\TransformerAbstract;

class AreaTransformer extends TransformerAbstract
{
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Area $area)
    {
        return [
            'identificador' => (int)$area->id,
            'nombre' => (string)$area->name,
            /* 'fechaCreacion' => (string)$area->created_at,
            'fechaActualizacion' => (string)$area->updated_at,
            'fechaEliminacion' => isset($area->deleted_at) ? (string)$area->deleted_at : null , */
        ];
    }
 

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }
}
