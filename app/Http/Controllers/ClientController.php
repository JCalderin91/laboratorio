<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $clients = Client::get();
        return view('pages.clients.index',compact('clients')); 
    }

    public function create(){
        return view('pages.clients.create');
    }

    public function store(Request $request){
        $this->validate($request,[ 
            'dni'=>'required',
            'name'=>'required',
            'phone'=>'required'
        ]);
        Client::create($request->all());

        return redirect()->route('pages.client.index')->with('success','Registro creado satisfactoriamente');
    
    }

    public function show($dni){
        $clientes=Client::find($dni);
        return  view('pages.client.show',compact('clientes'));
    }

    public function edit($dni){
        $client=client::find($dni);
        return view('pages.clients.edit',compact('client'));
    }

    public function update(Request $request, $dni){
        $this->validate($request,[ 
            'dni'=>'required',
            'name'=>'required',
            'phone'=>'required'
        ]);
 
        client::find($dni)->update($request->all());

        return redirect()->route('pages.client.index')->with('success','Registro actualizado satisfactoriamente');
    
    }

    public function destroy($dni){
        Client::find($dni)->delete();
        return redirect()->route('pages.client.index')->with('success','Registro eliminado satisfactoriamente');
    
    }
}
