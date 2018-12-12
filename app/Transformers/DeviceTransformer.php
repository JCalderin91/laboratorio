<?php

namespace App\Transformers;

use App\Device;
use League\Fractal\TransformerAbstract;

class DeviceTransformer extends TransformerAbstract
{
    
   
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Device $device)
    {
        return [
            'identificador' => (int)$device->id,
            'nombre' => $device->subDevice->name,
            'marca' => $device->brand->title,
            //'cliente' => (int)$device->client_id,
            'modelo' => $device->model,
            'bienNacinal' => isset($device->b_n) ? (string)$device->b_n : null ,
            /* 'fechaCreacion' => (string)$area->created_at,
            'fechaActualizacion' => (string)$area->updated_at,
            'fechaEliminacion' => isset($area->deleted_at) ? (string)$area->deleted_at : null , */
        ];
    }

     public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'subDevice_id',
            'marca' => 'brand_id',
            'cliente' => 'client_id',
            'modelo' => 'model',
            'bienNacinal' => 'b_n',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'subDevice_id' => 'nombre',
            'brand_id' => 'marca',
            'client_id' => 'cliente',
            'model' => 'modelo',
            'b_n' => 'bienNacinal',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }
}