<?php

namespace App\Http\Controllers;

use App\Brand;

use Illuminate\Http\Request;
use App\Transformers\BrandTransformer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends ApiController{
   

    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . BrandTransformer::class)->only(['store', 'update']);
    }
    
    
    public function index(){

        $brands = Brand::all();

        return $this->showAll($brands);
    }



    public function store(BrandStoreRequest $request){
        
        $brand = Brand::create($request->all());

        return $this->showOne($brand, 201);
    }

    
    public function show($id){
        //
    }


    public function update(BrandUpdateRequest $request, Brand $brand){
        
        if($request->has('title')){
            $brand->title = $request->title;
        }

        if(!$brand->isDirty()){
            return $this->errorResponse('Se debe especificar un valor diferente para actualizar' , 422);       
        }

        $brand->save();

        return $this->showOne($brand);
    
    }

    public function destroy(Brand $brand){
           
        $brand->delete();

        return $this->showOne($brand);
    }
}
