<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = new Brand();
        $brand->title = 'Oster';
        $brand->save();

        $brand = new Brand();
        $brand->title = 'Sony';
        $brand->save();

        $brand = new Brand();
        $brand->title = 'Logitech';
        $brand->save();

        $brand = new Brand();
        $brand->title = 'Genius';
        $brand->save();

        $brand = new Brand();
        $brand->title = 'Pioneer';
        $brand->save();

        $brand = new Brand();
        $brand->title = 'Skullcandy';
        $brand->save();
    }
}
