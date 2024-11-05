<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatDocumentoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstadoController;

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

Route::get('/perfil-usuario', function () {
    return view('usuarios.perfilUsuario');
});

Route::controller(EstadoController::class)->group(function () {
    Route::get('/estados', 'index');            
    Route::post('/estados', 'store');          
    Route::get('/estados/{id}', 'show');        
    Route::put('/estados/{id}', 'update');       
    Route::delete('/estados/{id}', 'destroy');   
});

Route::controller(DocumentoController::class)->group(function () {
    Route::get('/documentos', 'index');            
    Route::post('/documentos', 'store');            
    Route::get('/documentos/{id}', 'show');        
    Route::put('/documentos/{id}', 'update');       
    Route::delete('/documentos/{id}', 'destroy');   
});
