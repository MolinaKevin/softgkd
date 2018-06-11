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

/**
 *  Resources basicos
 */
Route::group([], function () {
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
    Route::resource('dispositivos', 'DispositivoController');
});

/**
 *  Grupo de searchs
 */

Route::prefix('busqueda')->group(function () {
    Route::get('familias', 'FamiliaController@busqueda')->name('familias.busqueda');
    Route::get('revisacions', 'RevisacionController@busqueda')->name('revisacions.busqueda');
    Route::get('deudas', 'DeudaController@busqueda')->name('deudas.busqueda');
    Route::get('pagos', 'PagoController@busqueda')->name('pagos.busqueda');
    Route::get('users', 'UserController@busqueda')->name('users.busqueda');
    Route::get('medicos', 'MedicoController@busqueda')->name('medicos.busqueda');
    Route::get('roles', 'RoleController@busqueda')->name('roles.busqueda');
    Route::get('plans', 'PlanController@busqueda')->name('plans.busqueda');
    Route::get('planUsers', 'PlanUserController@busqueda')->name('planUsers.busqueda');
    Route::get('horarios', 'HorarioController@busqueda')->name('horarios.busqueda');
    Route::get('asistencias', 'AsistenciaController@busqueda')->name('asistencias.busqueda');
    Route::get('huellas', 'HuellaController@busqueda')->name('huellas.busqueda');
    Route::get('especials', 'EspecialController@busqueda')->name('especials.busqueda');
    Route::get('especialUsers', 'EspecialUserController@busqueda')->name('especialUsers.busqueda');
    Route::get('dispositivos', 'DispositivoController@busqueda')->name('dispositivos.busqueda');
    Route::get('home', 'DispositivoController@busqueda')->name('home.busqueda');
});

Route::prefix('familias/{familia}')->group(function () {
    Route::get('users', 'FamiliaController@usuarios')->name('familia.users');
    Route::get('deudas', 'FamiliaController@deudas')->name('familia.deudas');
    Route::get('pagos', 'FamiliaController@pagos')->name('familia.pagos');
});

Route::prefix('users/{user}')->group(function () {
    Route::get('plans', 'UserController@planes')->name('users.plans');
});

Route::get('users/rol/{rol}', 'UserController@roles')->name('users.roles');

Route::get('users/{user}/agregar', 'UserController@agregar')->name('users.agregar');

Route::get('especials/create/{user}', 'EspecialController@createUser')->name('especials.user.create');
