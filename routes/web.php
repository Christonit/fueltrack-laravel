<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'pageController@home');

Route::get('/loggedin', 'pageController@index')->name('loggedin');

Route::get('/no-car-found', function(){
         return view('utilities.no-car-found-callout');

});


Route::get('/no-model-found', function(){
    return view('utilities.no-car-model-callout');

});

//
//Route::get('/test', function(){
//    return view('utilities.test-service');
//
//});


Route::get('/test','VehicleController@test');


Route::post('/add-service','VehicleMaintenanceController@store');

Route::get('/my-maintenance/{id}/edit', 'VehicleMaintenanceController@edit');
Route::patch('/my-maintenance/{id}/edit','VehicleMaintenanceController@update');
Route::get('/my-maintenance/{id}/delete','VehicleMaintenanceController@delete');
Route::delete('/my-maintenance/{id}/delete','VehicleMaintenanceController@destroy');




Route::get('/add-vehicle', 'pageController@addVehicle');

Route::post('/add-vehicle','VehicleController@store');

Route::post('/add-vehicle/performance','VehicleController@store');

Route::post('/add-expense','ExpensesController@store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/{username}/my-car', 'VehicleController@show');



//Mark as maintenance finished

Route::post('/mark-as-performed/{id}/','VehicleMaintenanceController@markAsPerformed');

//Ajax fetch routes

Route::get('/self-service-options', 'ComponentsIncludeController@selfServiceOptions');
Route::get('/only-warranty-options', 'ComponentsIncludeController@warrantyOptions');


Route::get('/latest-expense','ExpensesController@latest');
Route::get('/latest-maintenance','VehicleMaintenanceController@latestPerformed');
Route::get('/recent-maintenance-added','VehicleMaintenanceController@latestAdded');


//Route::get('/latest-expense', function (){
//
//
//    return 'hola';
//});






//Route::get('/full-options', 'ComponentsIncludeController@fullOptions');


