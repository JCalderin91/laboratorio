<?php

use Illuminate\Database\Seeder;
use App\Category;


class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	

    	//Categorias padre
        $category = new Category();
        $category->name = 'Electrodomesticos';
        $category->save(); 

        $category = new Category();
        $category->name = 'Dispositivos E/S';
        $category->save(); 

    }
}
