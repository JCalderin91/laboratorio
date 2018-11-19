<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Area;
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

        $client = Client::find($id);
        $areas = Area::get();

        return view('pages.clients.edit',compact(['client', 'areas']));
    }

    public function update(ClientUpdateRequest $request, $id){
        
        $client = Client::find($id);
        $client->fill($request->all())->save();

        return redirect()->route('clients.index', $client->id)->with('success','Registro actualizado satisfactoriamente');
    
    }

    public function destroy(Request $request, $id){
        $client = Client::findOrFail($request->id);
        
        if($client->status === 'ACTIVE'){
            $client->status = 'INACTIVE';
        }else{
            $client->status = 'ACTIVE';
        }        

        $client->update();
        return redirect()->route('clients.index')->with('success','Cambio de status realizado efectivamente');   
    }
}
