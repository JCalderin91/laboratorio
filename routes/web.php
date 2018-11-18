<?php

Route::post('/ajax', function () {

	$data = (object) [
            'name' => $_GET['name']
          ];
    return json_encode($data);
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


//Direcciones
Route::post('/addresses/store', 'AddressController@storeWithModal')->name('addresses.modal');
Route::resource('/addresses',   'AddressController');

//Clientes
Route::post('/clients/store',   'ClientController@storeWithModal')->name('clients.modal');
Route::resource('/clients',     'ClientController');

//Equipos
Route::resource('/devices',     'DeviceController');

//Usuarios-Tecnicos
Route::resource('/users',       'UserController');

//Marcas
Route::post('/brands/store',    'BrandController@storeWithModal')->name('brands.modal');
Route::resource('/brands',      'BrandController');

//Horas
Route::resource('/hours',       'HourController');

//Ordenes
Route::resource('/orders',      'OrderController');

//Reparaciones
Route::resource('/repairs',     'RepairController');

//Areas
Route::post('/areas/store',     'AreaController@storeWithModal')->name('areas.modal');
Route::resource('/areas',       'AreaController');

 //Sub-equipos
Route::post('/sub-devices/store', 'SubDeviceController@storeWithModal')->name('sub-devices.modal');
Route::resource('/sub-devices',   'SubDeviceController'); 





/*<<<<<<< HEAD
Route::view('/register', 'pages.register');



=======
>>>>>>> 8376cd67c4a18af9cae572382121d9a86f6f84cb

Route::resource('api', 'testController');*/
Route::get('test', function () {
	return view('pages.register');
});
