<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        /* OBTENER LAS MARCAS PARA MOSTRARLAS EN LA LISTA DE MARCA */
        $brands = Brand::get();
        return view('pages.brands.index', compact('brands'));
    }


    public function create(){
        /* IR A LA VISTA PARAR CREAR LA NUEVA MARCA */
        return view('pages.brands.create');
    }

    public function store(BrandStoreRequest $request){
        /*ALMACENAR LA NUEVA MARCA*/ 
        $brand = Brand::create($request->all());

        return redirect()->route('pages.brand.index')->with('success','Registro creado satisfactoriamente');
    }

    public function show($id){
        //
    }

    public function edit($id){
        return view('pages.brands.edit');
    }

    public function update(BrandUpdateRequest $request, $id){

        $brand = Brand::find($id);

        $brand->fill($request->all())->save();

        return redirect()->route('brands.edit', $brand->id)->with('success','Registro actualizado satisfactoriamente');
    
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->status = 'INACTIVE';
        $brand->save();

        return back()->with('success','Categoría eliminada correctamente');
    }
}
