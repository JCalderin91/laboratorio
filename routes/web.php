<?php

Route::post('/ajax', function () {

	$data = (object) [
            'name' => $_GET['name']
          ];
    return json_encode($data);
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('clients', 'ClientController');
Route::resource('devices', 'DeviceController');
Route::resource('tecnics', 'TecnicController');
Route::resource('categories', 'CategoriesController');
Route::resource('brands', 'BrandController');
Route::resource('hours', 'HoursController');


/*<<<<<<< HEAD
Route::view('/register', 'pages.register');



=======
>>>>>>> 8376cd67c4a18af9cae572382121d9a86f6f84cb

Route::resource('api', 'testController');*/
Route::get('test', function () {
	return 'Hay que hacer esta vista';
});
