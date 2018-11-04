<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller{

    public function index(){
        $categories = Category::get();
        return view('pages.categories.index',compact('categories'));
    }


    public function create(){
        return view('pages.categories.create');
    }


    public function store(Request $request){

        $categories = new Category();

        $categories->name = $request->get('name');

        $categories->save();

        return redirect('categories')->with('success','Registro creado satisfactoriamente');
    }

    public function show($id){
        
    }

    public function edit($id){
        return view('pages.categories.edit');
    }


    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
