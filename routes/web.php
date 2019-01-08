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

Route::get('/home', 'pageController@home');

Route::get('/my-car', 'pageController@myCar');
