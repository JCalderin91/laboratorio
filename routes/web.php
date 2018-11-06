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


Route::get('test', function () {
    return view('pages.register');
});

Route::resource('api', 'testController');
