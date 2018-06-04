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


