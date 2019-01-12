<?php

use Illuminate\Database\Seeder;

use App\SubDevice;

class SubDeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   	

        //Equipos
        $device = new SubDevice();
        $device->name = 'Licuadora';
        $device->save();
         
        $device = new SubDevice();
        $device->name = 'Plancha';
        $device->save();           

        $device = new SubDevice();
        $device->name = 'TV';
        $device->save();         

        $device = new SubDevice();
        $device->name = 'Teclado';
        $device->save();         

        $device = new SubDevice();
        $device->name = 'Auriculares';
        $device->save();        

        $device = new SubDevice();
        $device->name = 'Nevera';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Cable';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Control';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Corneta';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Radio';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Telefono';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Transmisor';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Cargador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Ventilador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Adaptador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Lampara';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Linterna';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Disco duro';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Reloj';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'tarjeta madre';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Cotufera';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Planta';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Amplificador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Subwoofer';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Estereo';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Pantalla';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Tabled';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Consola';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Transformador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Condensador';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Aire';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'sensor';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Enducido';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Cautin';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Taladro';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Esmeril';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Pendrive';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Escaner';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Impresora';
        $device->save();          

        $device = new SubDevice();
        $device->name = 'Regleta';
        $device->save();          
        
    }
}
