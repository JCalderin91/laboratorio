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

//Direcciones

Route::apiResource('/addresses', 'AddressController');
Route::apiResource('/addresses.areas', 'AddressAreaController', ['only' => ['index']]);

//Clientes

Route::apiResource('/clients', 'ClientController');

//Equipos
Route::apiResource('/devices', 'DeviceController');

//Usuarios-Tecnicos
Route::apiResource('/users', 'UserController');

//Marcas
Route::apiResource('/brands', 'BrandController');

//Horas
Route::apiResource('/hours', 'HourController');

//Ordenes
Route::apiResource('/orders', 'OrderController');

//Reparaciones
Route::apiResource('/repairs', 'RepairController');

//Areas
Route::apiResource('/areas', 'AreaController');

 //Sub-equipos
Route::apiResource('/sub-devices', 'SubDeviceController'); 