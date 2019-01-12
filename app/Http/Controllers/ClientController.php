<?php

namespace App\Http\Controllers;

use App\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ClientTransformer;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;


class ClientController extends ApiController{
    

    public function __construct(){
        //parent::__construct();

        $this->middleware('transform.input:' . ClientTransformer::class)->only(['store', 'update']);
    }
    
    public function index(){
       
        $clients = Client::all();

        if(request()->has('paginate')){

            return $this->showAll($clients, 200, true);
        }

        return $this->showAll($clients);
    }

    

    public function store(ClientStoreRequest $request){

        $client = Client::create($request->all());

        return $this->showOne($client, 201);
    
    }

    public function show($id){

        $client = Client::where('ci', $id)->first();

        return $this->showOne($client);

    }

   

    public function update(ClientUpdateRequest $request, $id){
        
        $client = Client::findOrFail($id);
        
        $client->fill($request->all());
        

        if(!$client->isDirty()){
            return $this->errorResponse( 'Se debe especificar al menos un valor diferente para actualizar' , 422);      
        }

        $client->save();

        return $this->showOne($client);
    
    }

    public function destroy($id){
        $client = Client::findOrFail($id);
        
        $client->delete();

        return $this->showOne($client);
    }
}
