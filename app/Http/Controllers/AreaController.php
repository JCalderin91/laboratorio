<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Area;
use App\Address;
use App\Http\Requests\AreaStoreRequest;
use App\Http\Requests\AreaUpdateRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::get();
        return view('pages.areas.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addresses = Address::get();
        return view('pages.areas.create',compact('addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStoreRequest $request)
    {

        $area = Area::create($request->all());
        return redirect()->route('areas.index')->with('success','Registro creado satisfactoriamente');

    }


    public function storeWithModal(AreaStoreRequest $request)
    {
        $area = Area::create($request->all());

        return $area;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('pages.areas.edit', compact('area') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdateRequest $request, $id)
    {
        $area = Area::find($id);

        $area->fill($request->all())->save();

        return redirect()->route('areas.index', $area->id)->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $area = Area::findOrFail($request->id);
        
        if($area->status === 'ACTIVE'){
            $area->status = 'INACTIVE';
        }else{
            $area->status = 'ACTIVE';
        }        

        $area->update();
        return redirect()->route('areas.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
