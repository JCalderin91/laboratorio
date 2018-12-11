<?php

use App\Exports\AreasExport;
use Maatwebsite\Excel\Facades\Excel;

Route::post('/ajax', function () {

	$data = (object) [
            'name' => $_GET['name']
          ];
    return json_encode($data);
});

Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::get('/', function () {
  return view('app');
});






/*<<<<<<< HEAD
Route::view('/register', 'pages.register');



=======
>>>>>>> 8376cd67c4a18af9cae572382121d9a86f6f84cb

Route::resource('api', 'testController');*/
Route::get('test', function () {
  $areas = App\Area::get();
  $clients = App\Client::get();
  $brands = App\Brand::get();
  $users = App\User::get();
  $addresses = App\Address::get();

  $areas_name = [];
  foreach($areas as $area) array_push($areas_name,$area->name);  
  $areas_name = json_encode($areas_name);

  $cis = [];
  foreach($clients as $client) array_push($cis,$client->ci);
  $cis = json_encode($cis);

  $brands_name = [];
  foreach($brands as $brand) array_push($brands_name,$brand->title);
  $brands_name = json_encode($brands_name);

    return view('pages.register',compact(['cis','areas_name','brands_name','users','addresses']));
});


// Prueba para exportar los resportes en pdf y excel
Route::get('excel', function () {
	return Excel::download(new AreasExport, 'users.xlsx');
});