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

Route::get('staff', 'FamiliaAPIController@obtenerStaff');

Route::resource('users', 'UserAPIController');

Route::get('usuariosNuevos', 'UserAPIController@usuariosNuevos');

Route::resource('gimnasio', 'GimnasioAPIController');

Route::prefix('users')->group(function () {
    Route::get('{user}/plans', 'UserAPIController@planes')->name('users.plans.obtener');
    Route::get('{user}/deudas', 'UserAPIController@deudas')->name('users.deudas.obtener');
    Route::put('{user}/deudas', 'UserAPIController@pagarDeudas')->name('users.deudas.pagar');
    Route::put('{user}/plans', 'UserAPIController@pagarPlanes')->name('users.plans.pagar');
    Route::post('{user}/huella', 'UserAPIController@addHuella')->name('users.huella.adherir');
    Route::post('{user}/tag', 'UserAPIController@addTag')->name('users.tag.adherir');
    Route::post('{user}/deuda', 'UserAPIController@addDeuda')->name('users.deuda.adherir');

});

Route::resource('dispositivos', 'DispositivoAPIController');

Route::prefix('dispositivos')->group(function () {
    Route::post('{dispositivo}/plan', 'DispositivoAPIController@addPlan')->name('dispositivos.plan.adherir');
});


Route::get('dispositivos/id/{modulo}', 'DispositivoAPIController@moduloPersonalizado');

Route::resource('asistencias', 'AsistenciaAPIController');