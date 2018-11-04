<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Brand;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Ids de las marcas
    	$oster = Brand::where('title', 'Oster')->first();
    	$sony = Brand::where('title', 'Sony')->first();
    	$logit = Brand::where('title', 'Logitech')->first();
    	$genius = Brand::where('title', 'Genius')->first();
    	$pioneer = Brand::where('title', 'Pioneer')->first();
    	$skull = Brand::where('title', 'Skullcandy')->first();

    	//Categorias padre
        $category = new Category();
        $category->name = 'Electrodomesticos';
        $category->save(); 

        $category = new Category();
        $category->name = 'Dispositivos E/S';
        $category->save(); 

        $elect = Category::where('name', 'Electrodomesticos')->first();
        $disp = Category::where('name', 'Dispositivos E/S')->first();

        //Equipos
        $category = new Category();
        $category->name = 'Licuadora';
        $category->parent_id = $elect->id;
        $category->save();
        $category->brands()->attach($oster); 

        $category = new Category();
        $category->name = 'Plancha';
        $category->parent_id = $elect->id;
        $category->save();  
        $category->brands()->attach($oster); 

        $category = new Category();
        $category->name = 'TV';
        $category->parent_id = $elect->id;
        $category->save();
        $category->brands()->attach($sony);   

        $category = new Category();
        $category->name = 'Teclado';
        $category->parent_id = $disp->id;
        $category->save();
        $category->brands()->syncWithoutDetaching([$genius->id,$logit->id]);   

        $category = new Category();
        $category->name = 'Auriculares';
        $category->parent_id = $disp->id;
        $category->save();
        $category->brands()->syncWithoutDetaching([$pioneer->id,$skull->id,$sony->id]);  

        $category = new Category();
        $category->name = 'Mouse';
        $category->parent_id = $disp->id;
        $category->save();
        $category->brands()->syncWithoutDetaching([$genius->id,$logit->id]);  
        

    }
}
