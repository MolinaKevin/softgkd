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

Route::resource('familias', 'FamiliaController');

Route::prefix('familias/{familia}')->group(function () {
    Route::get('users', 'FamiliaController@usuarios')->name('familia.users');
    Route::get('deudas', 'FamiliaController@deudas')->name('familia.deudas');
    Route::get('pagos', 'FamiliaController@pagos')->name('familia.pagos');
});



Route::resource('revisacions', 'RevisacionController');

Route::resource('deudas', 'DeudaController');

Route::resource('pagos', 'PagoController');

Route::resource('users', 'UserController');

Route::prefix('users/{user}')->group(function () {
    Route::get('plans', 'UserController@planes')->name('users.plans');
});

Route::get('users/rol/{rol}', 'UserController@roles')->name('users.roles');

Route::resource('medicos', 'MedicoController');

Route::resource('roles', 'RoleController');

Route::resource('plans', 'PlanController');