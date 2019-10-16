<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([
    
   // 'middleware' => 'jwt.auth',
    'prefix' => 'api'


], function() {

    Route::apiResource('/accounts', 'LoginController', ['only' => ['index', 'update']]);
    
    
    //Direcciones
    Route::apiResource('/addresses', 'AddressController');
    
    //Areas
    Route::apiResource('/areas', 'AreaController');

    //Clientes

    Route::apiResource('/clients', 'ClientController');
    Route::apiResource('/clients.devices', 'ClientDeviceController', ['only' => ['index']]);

    //Equipos
    Route::apiResource('/devices', 'DeviceController');

    //Usuarios-Tecnicos
    Route::get('users-all', 'UserController@all');
    Route::apiResource('/users', 'UserController');

    //Marcas
    Route::apiResource('/brands', 'BrandController');

    //Horas
    Route::apiResource('/hours', 'HourController');

    //Ordenes
    Route::get('/orders-all', 'OrderController@all');
    Route::apiResource('/orders', 'OrderController');
    
    Route::apiResource('/orders.repairs', 'OrderRepairController',  ['only' => ['store', 'update', 'destroy']]);
    Route::apiResource('/orders.deliveries', 'OrderDeliveryController',  ['only' => ['store', 'update', 'destroy']]);

    //Reparaciones
    Route::apiResource('/repairs', 'RepairController');

    
    //Sub-equipos
    Route::apiResource('/sub-devices', 'SubDeviceController'); 


    Route::post('/reports', 'ReportController@index');

});