<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Category;

class CategoriesController extends Controller{

    public function index(){
        $categories = Category::get();
        return view('pages.categories.index',compact('categories'));
    }


    public function create(){
        return view('pages.categories.create');
    }


    public function store(CategoryStoreRequest $request){

        $category = Category::create($request->all());

        return redirect()->route('pages.categories.index')->with('success','Registro creado satisfactoriamente');
    }

    public function storeWithModal(CategoryStoreRequest $request){

        $category = Category::create($request->all());

        return $category;
    }

    public function show($id){
        
    }

    public function edit($id){
        return view('pages.categories.edit');
    }


    public function update(CategoryUpdateRequest $request, $id){
        
        $category = Category::find($id);

        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)->with('success','Registro actualizado satisfactoriamente');
    }

    public function destroy($id){
        
        $category = Category::find($id);
        $category->status = 'INACTIVE';
        $category->save();

        return back()->with('success','Categoría eliminada correctamente');
    }
}
