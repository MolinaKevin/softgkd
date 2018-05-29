<?php

use Illuminate\Http\Request;

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

Route::resource('familias', 'FamiliaAPIController');

Route::resource('users', 'UserAPIController');
Route::resource('gimnasio', 'GimnasioAPIController');

Route::prefix('users')->group(function () {
    Route::get('{user}/plans', 'ExtrasAPIController@planes')->name('users.plans.obtener');
    Route::get('{user}/deudas', 'ExtrasAPIController@deudas')->name('users.deudas.obtener');
    Route::put('{user}/deudas', 'ExtrasAPIController@pagarDeudas')->name('users.deudas.pagar');
    Route::put('{user}/plans', 'ExtrasAPIController@pagarPlanes')->name('users.plans.pagar');
    Route::post('{user}/huella', 'ExtrasAPIController@addHuella')->name('users.huella.adherir');
});
