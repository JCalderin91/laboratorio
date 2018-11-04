<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return view('pages.clients.index',compact('clients')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 
            'dni'=>'required',
            'name'=>'required',
            'phone'=>'required'
        ]);
        Client::create($request->all());

        return redirect()->route('pages.client.index')->with('success','Registro creado satisfactoriamente');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $dni
     * @return \Illuminate\Http\Response
     */
    public function show($dni)
    {
        $clientes=Client::find($dni);
        return  view('pages.client.show',compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $dni
     * @return \Illuminate\Http\Response
     */
    public function edit($dni)
    {
        $client=client::find($dni);
        return view('pages.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $dni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dni)
    {
        $this->validate($request,[ 
            'dni'=>'required',
            'name'=>'required',
            'phone'=>'required'
        ]);
 
        client::find($dni)->update($request->all());

        return redirect()->route('pages.client.index')->with('success','Registro actualizado satisfactoriamente');
 
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $dni
     * @return \Illuminate\Http\Response
     */
    public function destroy($dni)
    {
        Client::find($dni)->delete();
        return redirect()->route('pages.client.index')->with('success','Registro eliminado satisfactoriamente');
    
    }
}
