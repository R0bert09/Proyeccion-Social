<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeccionController;

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

Route::prefix('secciones')->group(function () {
    Route::get('/', [SeccionController::class, 'index']);       
    Route::post('/', [SeccionController::class, 'store']);      
    Route::get('/{id}', [SeccionController::class, 'show']);    
    Route::put('/{id}', [SeccionController::class, 'update']);  
    Route::delete('/{id}', [SeccionController::class, 'destroy']);
});
