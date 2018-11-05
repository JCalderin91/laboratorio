<?php

use Illuminate\Database\Seeder;

use App\SubDevice;
use App\Category;

class SubDeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$elect = Category::where('name', 'Electrodomesticos')->first();
        $disp = Category::where('name', 'Dispositivos E/S')->first();

        //Equipos
        $device = new SubDevice();
        $device->name = 'Licuadora';
        $device->category_id = $elect->id;
        $device->save();
         

        $device = new SubDevice();
        $device->name = 'Plancha';
        $device->category_id = $elect->id;
        $device->save();  
         

        $device = new SubDevice();
        $device->name = 'TV';
        $device->category_id = $elect->id;
        $device->save();
        ;   

        $device = new SubDevice();
        $device->name = 'Teclado';
        $device->category_id = $disp->id;
        $device->save();
         

        $device = new SubDevice();
        $device->name = 'Auriculares';
        $device->category_id = $disp->id;
        $device->save();
        

        $device = new SubDevice();
        $device->name = 'Mouse';
        $device->category_id = $disp->id;
        $device->save();
          
        
    }
}
