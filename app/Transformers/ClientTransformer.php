<?php

namespace App\Transformers;

use App\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Client $client)
    {
        return [
            'identificador' => (int)$client->id,
            'cedula' => (string)$client->ci,
            'nombre' => (string)$client->first_name,
            'apellido' => (string)$client->last_name,
            'telefono' => (string)$client->phone,
            'area' => (string)$client->area->name,
            'direccion' => (string)$client->area->address->name,
            /* 'fechaCreacion' => (string)$area->created_at,
            'fechaActualizacion' => (string)$area->updated_at,
            'fechaEliminacion' => isset($area->deleted_at) ? (string)$area->deleted_at : null , */
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'cedula' => 'ci',
            'nombre' => 'first_name',
            'apellido' => 'last_name',
            'telefono' => 'phone',
            'area' =>  'area_id',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'id',
            'ci' => 'cedula',
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'phone' => 'telefono',
            'area_id' =>  'area',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    
}
