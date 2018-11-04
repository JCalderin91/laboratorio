<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        /* OPTENER LAS MARCAS PARA MOSTRARLAS EN LA LISTA DE MARCA */
        $brands = Brand::get();
        return view('pages.brands.index', compact('brands'));
    }


    public function create(){
        /* IR A LA VISTA PARAR CREAR LA NUEVA MARCA */
        return view('pages.brands.create');
    }

    public function store(Request $request){
        /*ALMACENAR LA NUECA MARCA*/ 
        $brand = new Brand();
        $brand->title = $request->get('title');
        $brand->save();
        return redirect('brands')->with('success','Brand has been added');
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id)
    {
        //
    }
}
