<?php

namespace App\Transformers\Transformers;

use League\Fractal\TransformerAbstract;
use App\Login;

class LoginTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Login $login)
    {
        return [
            'usuario' => (string)$login->username,
            'esAdministrador' => ($login->admin === 'true'),
        ];
    }


    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'contrasena_actual' => 'current_password',
            'confirmacion' => 'password_confirmation',
            'usuario' => 'username',
            'esAdministrador' => 'admin',
            'contrasena' => 'password',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
       
    }

    public static function transformedAttribute($index){
        $attributes = [
            'username' => 'usuario',
            'admin' => 'esAdministrador',
            'password' => 'contrasena',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
