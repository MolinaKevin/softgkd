<?php

// Generales

Route::get('/', function () {
    return redirect('users');
});



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
    Route::resource('dispositivos', 'DispositivoController');
});



Route::prefix('familias/{familia}')->group(function () {
    Route::get('users', 'FamiliaController@usuarios')->name('familia.users');
    Route::get('deudas', 'FamiliaController@deudas')->name('familia.deudas');
    Route::get('pagos', 'FamiliaController@pagos')->name('familia.pagos');
});


