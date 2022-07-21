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
    Route::post('{user}/pagoParcial', 'UserAPIController@pagoParcial')->name('users.pago.parcial');
    Route::get('{user}/renovar/{plan}', 'UserAPIController@renovarPlan')->name('users.plans.obtener');
    Route::get('{user}/pagarDeuda/{deuda}', 'UserAPIController@pagarDeuda')->name('users.plans.obtener');
    Route::put('{user}/cambiarVencimiento/{plan}', 'UserAPIController@cambiarVencimiento')->name('users.plans.obtener');
    Route::get('{user}/deudas', 'UserAPIController@deudas')->name('users.deudas.obtener');
    Route::put('{user}/deudas', 'UserAPIController@pagarDeudas')->name('users.deudas.pagar');
    Route::put('{user}/plans', 'UserAPIController@pagarPlanes')->name('users.plans.pagar');
    Route::put('{user}/detachPlanes', 'UserAPIController@detachPlanes')->name('users.plans.detach');
    Route::post('{user}/huella', 'UserAPIController@addHuella')->name('users.huella.adherir');
    Route::post('{user}/tag', 'UserAPIController@addTag')->name('users.tag.adherir');
    Route::post('{user}/deuda', 'UserAPIController@addDeuda')->name('users.deuda.adherir');
    Route::put('{user}/aplicarDescuento', 'UserAPIController@aplicarDescuento')->name('users.deudas.aplciar.descuento');
    Route::put('{user}/supraestado', 'UserAPIController@cambiarSupraestado')->name('users.supraestado.cambiar');

});

Route::prefix('deudas')->group(function () {
    Route::put('eliminar', 'DeudaAPIController@eliminar')->name('deudas.eliminar');
});

Route::resource('dispositivos', 'DispositivoAPIController');

Route::prefix('dispositivos')->group(function () {
    Route::post('{dispositivo}/plan', 'DispositivoAPIController@addPlan')->name('dispositivos.plan.adherir');
    Route::post('{dispositivo}/especial', 'DispositivoAPIController@addEspecial')->name('dispositivos.plan.adherir');
    Route::get('{dispositivo}/plans', 'DispositivoAPIController@plans')->name('dispositivos.plans');
    Route::get('{dispositivo}/ingresables', 'DispositivoAPIController@ingresables')->name('dispositivos.plans');
    Route::post('{dispositivo}/ingresados', 'DispositivoAPIController@ingresados')->name('dispositivos.ingresados');

});

Route::get('dispositivos/id/{modulo}', 'DispositivoAPIController@moduloPersonalizado');

Route::resource('asistencias', 'AsistenciaAPIController');

Route::resource('arqueos', 'ArqueoAPIController');

Route::resource('movimientos', 'MovimientoAPIController');

Route::resource('plans', 'PlanAPIController');
Route::get('plans/{plan}/vencimiento', 'PlanAPIController@vencimiento');



Route::resource('conexions', 'ConexionAPIController');

Route::resource('deudas', 'DeudaAPIController');

Route::resource('metodo_pagos', 'MetodoPagoAPIController');

Route::resource('cajas', 'CajaAPIController');