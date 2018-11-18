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
        $device->name = 'Mouse';
        $device->save();          
        
    }
}
