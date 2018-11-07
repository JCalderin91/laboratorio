<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;


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

    public function store(ClientStoreRequest $request){

        Client::create($request->all());

        return redirect()->route('pages.clients.index')->with('success','Registro creado satisfactoriamente');
    
    }


    public function storeWithModal(ClientStoreRequest $request){

        $client = Client::create($request->all());

        return $client;
    
    }

    public function show($id){

        $clients = Client::find($id);
        return  view('pages.clients.show',compact('clients'));
    }

    public function edit($id){

    
        return view('pages.clients.edit');
    }

    public function update(ClientUpdateRequest $request, $id){
        
        $client = Client::find($id);
        $client->fill($request->all())->save();

        return redirect()->route('clients.edit', $client->id)->with('success','Registro actualizado satisfactoriamente');
    
    }

    public function destroy($id){

        $client = Client::find($id);
        $client->status = 'INACTIVE';
        $client->save();

        return back()->with('success','Cliente eliminado correctamente');
    
    }
}
