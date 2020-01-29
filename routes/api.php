<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExpensesController;
use App\User;
use App\vehicle;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/expenses/historic','ExpensesController@latest');

/*

Route::post('/user/check-username','ValidationsController@username');
Route::post('/user/check-password','ValidationsController@password');
Route::post('/user/check-email','ValidationsController@email');
*/