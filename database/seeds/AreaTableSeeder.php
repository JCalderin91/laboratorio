<?php

use App\Area;

use Illuminate\Database\Seeder;

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
        $area->name = 'Administrativo';
        $area->save();

        $area = new Area();
        $area->name = 'Estudiante';
        $area->save();

        $area = new Area();
        $area->name = 'Obrero';
        $area->save();

        $area = new Area();
        $area->name = 'Profesor';
        $area->save();

    }
}
