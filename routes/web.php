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

Route::get('/test-service', function(){
    return view('utilities.test-service');

});




Route::post('/add-service','VehicleMaintenanceController@store');


Route::get('/add-vehicle', 'pageController@addVehicle');

Route::post('/add-vehicle','VehicleController@store');

Route::post('/add-vehicle/performance','VehicleController@store');

Route::post('/add-expense','ExpensesController@store');


Route::get('/latest-expense','ExpensesController@latest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/{username}/my-car', 'VehicleController@show');


//Mark as maintenance finished

Route::post('/mark-as-performed/{id}/','VehicleMaintenanceController@markAsPerformed');

//Ajax fetch routes

Route::get('/self-service-options', 'ComponentsIncludeController@selfServiceOptions');
Route::get('/only-warranty-options', 'ComponentsIncludeController@warrantyOptions');
//Route::get('/full-options', 'ComponentsIncludeController@fullOptions');


