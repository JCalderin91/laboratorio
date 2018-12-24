<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ClientDeviceController extends ApiController
{
   
    public function index(Client $client){

        $devices = $client->devices;

        return $this->showAll($devices);

    }
}
