<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Address;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::get();
        return view('pages.address.index',compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressStoreRequest $request)
    {
        $address = Address::create($request->all());

        return redirect()->route('addresses.index')->with('success','Registro creado satisfactoriamente');
    }
    

    public function storeWithModal(AddressStoreRequest $request)
    {
        $address = Address::create($request->all());

        return $address;
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

        $address = Address::findOrFail($id);
        return view('pages.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressUpdateRequest $request, $id)
    {
        $address = Address::find($id);

        $address->fill($request->all())->save();

        return redirect()->route('addresses.index', $address->id)->with('success','Registro actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->status = 'INACTIVE';
        $address->save();

        return back()->with('success','Categoría eliminada correctamente');
    }
}
