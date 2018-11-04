<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = new Area();
        $area->name = 'Estudiante de Informatica';
        $area->address_id = 1;
        $area->save();

        $area = new Area();
        $area->name = 'Estudiante de turismo';
        $area->address_id = 2;
        $area->save();
    }
}
