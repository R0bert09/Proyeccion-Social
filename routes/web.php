<?php

use App\Http\Controllers\AsignacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatDocumentoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HorasSocialesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProyectosDocumentosController;
use Illuminate\Http\Request;


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



Route::get('/layouts', function () {
    return view('layouts.gestion-de-roles');
})->name('roles');

Route::get('/perfil', function () {
    return view('perfil.perfilUsuario');
})
->name('perfil');


Route::controller(EstudianteController::class)
    ->prefix('estudiantes')
    ->name('estudiantes.')
    ->group(function () {
        Route::get('/', 'index')->name('index');          
        Route::post('/', 'store')->name('store');         
        Route::get('/{id}', 'show')->name('show');        
        Route::put('/{id}', 'update')->name('update');    
        Route::delete('/{id}', 'destroy')->name('destroy'); 
    });

Route::controller(ProyectoController::class)
    ->prefix('proyectos')
    ->name('proyectos.')
    ->group(function () {
        Route::get('/', 'index')->name('index');          
        Route::post('/', 'store')->name('store');         
        Route::get('/{id}', 'show')->name('show');        
        Route::put('/{id}', 'update')->name('update');    
        Route::delete('/{id}', 'destroy')->name('destroy'); 
    });

Route::get('/recuperarcontraseña', function () {
    return view('auth.recupassword');
});

Route::get('/resetearcontraseña', function () {
    return view('auth.resetpassword');
});

Route::get('/proyecto-general', function () {
    return view('proyecto.proyecto-general');
})->name('proyecto-general');

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


Route::controller(AsignacionController::class)
    ->prefix('asignaciones')
    ->name('asignaciones.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/export/excel', 'exportExcel')->name('export.excel');
        Route::get('/export/pdf', 'exportPDF')->name('export.pdf');
    });

    Route::controller(ChatDocumentoController::class)
        ->prefix('chat_documentos')
        ->name('chat_documentos.')
        ->group(function () {
            Route::get('/', 'index')->name('index');            
            Route::get('/crear', 'create')->name('create');       
            Route::post('/', 'store')->name('store');            
            Route::get('/{id}/editar', 'edit')->name('edit');   
            Route::put('/{id}', 'update')->name('update');            
            Route::delete('/{id}', 'destroy')->name('destroy');         
            Route::get('/buscar', 'search')->name('search');            
        });

    Route::controller(DepartamentoController::class)
        ->prefix('departamentos')
        ->name('departamentos.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/buscar', 'searchByName')->name('searchByName'); 
            Route::get('/crear', 'create')->name('create'); 
            Route::post('/', 'store')->name('store');  
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/editar', 'edit')->name('edit');   
            Route::put('/{departamento}', 'update')->name('update');   
            Route::delete('/{id}', 'destroy')->name('destroy');      
        });

    Route::controller(HistorialController::class)
    ->prefix('historial')
    ->name('historial.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

    Route::controller(HorasSocialesController::class)
    ->prefix('horas_sociales')
    ->name('horas_sociales.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/estudiante/{id_estudiante}', 'getHorasByEstudiantes')->name('getHorasByEstudiantes');
    });

    Route::controller(NotificationController::class)
    ->prefix('notificaciones')
    ->name('notificaciones.')
    ->group(function () {
        Route::get('/usuario/{userId}', 'index')->name('index');        
        Route::get('/create', 'create')->name('create');                  
        Route::post('/', 'store')->name('store');                        
        Route::get('/{id}', 'show')->name('show');                        
        Route::get('/{id}/edit', 'edit')->name('edit');                   
        Route::put('/{id}', 'update')->name('update');                   
        Route::delete('/{id}', 'destroy')->name('destroy');               
    });

    Route::controller(ProyectosDocumentosController::class)
    ->prefix('proyectos_documentos')
    ->name('proyectos_documentos.')
    ->group(function () {
        Route::get('/', 'index')->name('index');             
        Route::get('/create', 'create')->name('create');      
        Route::post('/', 'store')->name('store');            
        Route::get('/{id}', 'show')->name('show');            
        Route::get('/{id}/edit', 'edit')->name('edit');      
        Route::put('/{id}', 'update')->name('update');        
        Route::delete('/{id}', 'destroy')->name('destroy');  
    });