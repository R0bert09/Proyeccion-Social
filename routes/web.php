<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatDocumentoController;
use App\Http\Controllers\DepartamentoController;

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

Route::get('/proyecto', function () {
    return view('proyecto.publicar-proyecto');
})->name('proyecto');

Route::get('/proyecto-disponible', function () {
    return view('proyecto.proyecto-disponible');
})->name('proyecto-disponible');

Route::get('/detalle', function () {
    return view('proyecto.detalle-proyecto');
})->name('detalle');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/crear', function () {
    return view('usuarios.crearUsuario');
})->name('crear');

Route::get('/usuarios', function () {
    return view('usuarios.listaUsuario');
})->name('usuarios');


Route::controller(SeccionController::class)->group(function () {
    Route::get('/secciones', 'index'); 
    Route::post('/secciones', 'store'); 
    Route::get('/secciones/{id}', 'show'); 
    Route::put('/secciones/{id}', 'update');
    Route::delete('/secciones/{id}', 'destroy'); 
});

Route::get('/layouts', function () {
    return view('layouts.gestion-de-roles');
})->name('roles');

Route::get('/perfil', function () {
    return view('perfil.perfilUsuario');
})
->name('perfil');

Route::get('/perfil-usuario', function () {
    return view('usuarios.perfilUsuario');
});

