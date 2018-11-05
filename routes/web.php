<?php

Route::get('/ajax', function () {
	$data = (object) [
            'pendientes' => 2,
            'reparados' => 1,
            'entregados' => 4,
          ];
    return json_encode($data);
})->name('ho-ras');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('clients', 'ClientController');
Route::resource('devices', 'DeviceController');
Route::resource('tecnics', 'TecnicController');
Route::resource('categories', 'CategoriesController');
Route::resource('brands', 'BrandController');
Route::resource('hours', 'HoursController');







