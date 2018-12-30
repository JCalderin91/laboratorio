<?php

namespace App\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'tecnico',
        'cliente',
        'equipo',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform (Order $order)
    {
        return [
            'identificador' => (int)$order->id,
            'estado' => (string)$order->status,
            'detalle' => (string)$order->description,
            'fechaCreacion' => (string)$order->arrival_date,
            // 'fechaEliminacion' => isset($order->deleted_at) ? (string)$order->deleted_at : null ,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'estado' => 'status',
            'detalle' => 'description',
            'fechaCreacion' => 'arrival_date',
            'equipo' => 'device_id',
            'nombre_equipo' => 'name',
            'marca' => 'title',
            'modelo' => 'model',  	  	
            'bienNacional' => 'b_n',
            'cedula' => 'ci',
            'nombres' => 'first_name',
            'apellidos' => 'last_name',
            'telefono' => 'phone',
            'area' =>  'area_id',
            'tecnico' => 'user_id',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'status' => 'estado',
            'description' => 'detalle',
            'arrival_date' => 'fechaCreacion',
            'device_id' => 'equipo',
            'name' => 'nombre_equipo',
            'title' => 'marca',
            'model' => 'modelo',
            'b_n' => 'bienNacional',
            'ci' => 'cedula',
            'first_name' => 'nombres',
            'last_name' => 'apellidos',
            'phone' => 'telefono',
            'area_id' => 'area',
            'user_id' => 'tecnico',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public function includeTecnico(Order $order){
        
        $user = $order->user;

        return $this->item($user, new UserTransformer);
    }

    public function includeCliente(Order $order){
        
        $client = $order->client;

        return $this->item($client, new ClientTransformer);
    }

    public function includeEquipo(Order $order){
        
        $device = $order->device;

        return $this->item($device, new DeviceTransformer);
    }
}
