<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('login.login');
});

Route::get('/registro', function () {
    return view('registro.registro');
});

Route::get('/proyecto', function () {
    return view('proyecto.publicar-proyecto');
})->name('proyecto');

Route::get('/gestion-proyecto', function () {
    return view('gestionProyectos.gestionProyectos');
});

Route::get('/crear', function () {
    return view('usuarios.crearUsuario');
})->name('crear');

Route::get('/usuarios', function () {
    return view('usuarios.listaUsuario');
})->name('usuarios');

Route::get('/reporte', [ProyectoController::class, 'reporteProgreso'])->name('reporte.progreso');


// Ruta para mostrar el formulario de creación de proyecto (GET)
Route::get('/proyectos/create', [ProyectoController::class, 'createform'])->name('proyectos.create');

// Ruta para almacenar el nuevo proyecto (POST)
Route::post('/proyectos', [ProyectoController::class, 'storedate'])->name('proyectos.store');

