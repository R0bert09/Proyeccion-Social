<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatDocumentoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('login.login');
});

Route::get('/permisos', function () {
    return view('permisos.gestionpermiso');
})
->name('permisos');

Route::get('/registro', function () {
    return view('registro.registro');
});

Route::get('/proyecto', function () {
    return view('proyecto.publicar-proyecto');
})->name('proyecto');

Route::get('/gestion-proyecto', function () {
    return view('gestionProyectos.gestionProyectos');
})->name('gestion-proyecto');

Route::get('/crear', function () {
    return view('usuarios.crearUsuario');
})->name('crear');

Route::get('/usuarios', function () {
    return view('usuarios.listaUsuario');
})->name('usuarios');

Route::get('/layouts', function () {
    return view('layouts.gestion-de-roles');
})->name('roles');

Route::get('/perfil', function () {
    return view('perfil.perfilUsuario');
})
->name('perfil');


// Rutas para EstudianteController
Route::controller(EstudianteController::class)
    ->prefix('estudiantes')
    ->name('estudiantes.')
    ->group(function () {
        Route::get('/', 'index')->name('index');          // Listar todos los estudiantes
        Route::post('/', 'store')->name('store');         // Crear un nuevo estudiante
        Route::get('/{id}', 'show')->name('show');        // Obtener un estudiante específico
        Route::put('/{id}', 'update')->name('update');    // Actualizar un estudiante específico
        Route::delete('/{id}', 'destroy')->name('destroy'); // Eliminar un estudiante específico
    });

// Rutas para ProyectoController
Route::controller(ProyectoController::class)
    ->prefix('proyectos')
    ->name('proyectos.')
    ->group(function () {
        Route::get('/', 'index')->name('index');          // Listar todos los proyectos
        Route::post('/', 'store')->name('store');         // Crear un nuevo proyecto
        Route::get('/{id}', 'show')->name('show');        // Obtener un proyecto específico
        Route::put('/{id}', 'update')->name('update');    // Actualizar un proyecto específico
        Route::delete('/{id}', 'destroy')->name('destroy'); // Eliminar un proyecto específico
    });
