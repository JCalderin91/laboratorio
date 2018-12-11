<?php

namespace App\Transformers;

use App\Brand;
use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Brand $brand)
    {
        return [
            'identificador' => (int)$brand->id,
            'nombre' => (string)$brand->title,
            /* 'fechaCreacion' => (string)$area->created_at,
            'fechaActualizacion' => (string)$area->updated_at,
            'fechaEliminacion' => isset($area->deleted_at) ? (string)$area->deleted_at : null , */
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'title',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;  
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'title' => 'nombre',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }
}
