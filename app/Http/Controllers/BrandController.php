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

        return redirect()->route('brands.index')->with('success','Registro creado satisfactoriamente');
    }

    public function storeWithModal(BrandStoreRequest $request){
        /*ALMACENAR LA NUEVA MARCA*/ 
        $brand = Brand::create($request->all());

        return $brand;
    }


    public function show($id){
        //
    }

    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('pages.brands.edit', compact('brand') );
    }

    public function update(BrandUpdateRequest $request, $id){

        $brand = Brand::findOrFail($id);

        $brand->fill($request->all())->save();

        return redirect()->route('brands.index')->with('success','Registro actualizado satisfactoriamente');
    
    }

    public function destroy(Request $request, $id){
        $brand = Brand::findOrFail($request->id);
        
        if($brand->status === 'ACTIVE'){
            $brand->status = 'INACTIVE';
        }else{
            $brand->status = 'ACTIVE';
        }        

        $brand->update();
        return redirect()->route('brands.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
