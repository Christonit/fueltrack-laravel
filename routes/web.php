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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

// Route::get('/', 'HomeController@welcome');
//
// Route::get('/home', 'HomeController@index')->name('home');
//
//
// Route::get('/welcome2/{usuarios}', 'HomeController@welcome2');


Route::get('/', 'pageController@home');

Route::get('/loggedin', 'pageController@index')->name('loggedin');

//Route::get('/login', 'pageController@login');

//Route::get('/my-car', 'pageController@myCar');

Route::get('{username}/my-car/', 'VehicleController@show');


Route::get('/no-car-found', function(){
         return view('utilities.no-car-found-callout');

});


Route::get('/no-model-found', function(){
    return view('utilities.no-car-model-callout');

});

Route::post('/add-service','VehicleMaintenanceController@store');

Route::get('/add-vehicle', 'pageController@addVehicle');

Route::post('/add-vehicle','VehicleController@store');

Route::post('/add-vehicle/performance','VehicleController@store');

Route::post('/add-expense','ExpensesController@store');


Route::get('/latest-expense','ExpensesController@latest');
