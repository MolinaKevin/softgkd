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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::prefix('familias/{familia}')->group(function () {
    Route::get('users', 'FamiliaController@usuarios')->name('familia.users');
    Route::get('deudas', 'FamiliaController@deudas')->name('familia.deudas');
    Route::get('pagos', 'FamiliaController@pagos')->name('familia.pagos');
});

Route::prefix('users/{user}')->group(function () {
    Route::get('plans', 'UserController@planes')->name('users.plans');
});

Route::get('users/rol/{rol}', 'UserController@roles')->name('users.roles');

Route::get('especials/create/{user}', 'EspecialController@createUser')->name('especials.user.create');


/**
 *  Resources basicos
 */
Route::group([],function () {
    Route::resource('familias', 'FamiliaController');
    Route::resource('revisacions', 'RevisacionController');
    Route::resource('deudas', 'DeudaController');
    Route::resource('pagos', 'PagoController');
    Route::resource('users', 'UserController');
    Route::resource('medicos', 'MedicoController');
    Route::resource('roles', 'RoleController');
    Route::resource('plans', 'PlanController');
    Route::resource('planUsers', 'PlanUserController');
    Route::resource('horarios', 'HorarioController');
    Route::resource('asistencias', 'AsistenciaController');
    Route::resource('huellas', 'HuellaController');
    Route::resource('especials', 'EspecialController');
    Route::resource('especialUsers', 'EspecialUserController');
});


/**
 *  Grupo de searchs
 */

Route::group([],function () {
    Route::get('familias/search', 'FamiliaController@search')->name('familias.search');
    Route::get('revisacions/search', 'RevisacionController@search')->name('revisacions.search');
    Route::get('deudas/search', 'DeudaController@search')->name('deudas.search');
    Route::get('pagos/search', 'PagoController@search')->name('pagos.search');
    Route::get('users/search', 'UserController@search')->name('users.search');
    Route::get('medicos/search', 'MedicoController@search')->name('medicos.search');
    Route::get('roles/search', 'RoleController@search')->name('roles.search');
    Route::get('plans/search', 'PlanController@search')->name('plans.search');
    Route::get('planUsers/search', 'PlanUserController@search')->name('planUsers.search');
    Route::get('horarios/search', 'HorarioController@search')->name('horarios.search');
    Route::get('asistencias/search', 'AsistenciaController@search')->name('asistencias.search');
    Route::get('huellas/search', 'HuellaController@search')->name('huellas.search');
    Route::get('especials/search', 'EspecialController@search')->name('especials.search');
    Route::get('especialUsers/search', 'EspecialUserController@search')->name('especialUsers.search');
});


