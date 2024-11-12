<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\HistorialDepartamentoController;
use App\Http\Controllers\TestsKevControllerController;
use App\Http\Controllers\AsignacionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatDocumentoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HorasSocialesController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProyectosDocumentosController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('login.login');
});

Route::get('/registro', function () {
    return view('registro.registro');
})->name('registro');

Route::get('/proyecto-g', function () {
    return view('proyecto.proyecto-general');
})->name('proyecto-g');

Route::get('/proyecto', function () {
    return view('proyecto.publicar-proyecto');
})->name('proyecto');

Route::get('/mensajeria', function () {
    return view('mensaje.mensaje');
})->name('mensajeria');

Route::get('/gestion-proyecto', function () {
    return view('gestionProyectos.gestionProyectos');
})->name('gestion-proyecto');

Route::get('/gestion-permiso', function () {
    return view('permisos.gestionpermiso');
})->name('gestion-permiso');

Route::get('/gestion-roles', function () {
    return view('layouts.gestion-de-roles');
})->name('gestion-roles');

Route::get('/proyecto-disponible', function () {
    return view('proyecto.proyecto-disponible');
})->name('proyecto-disponible');

Route::get('/detalle', function () {
    return view('proyecto.detalle-proyecto');
})->name('detalle');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/crear', [UserController::class, 'allSeccion'])->name('crear');
Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editarUsuario');
Route::put('/usuarios/{id}/actualizar', [UserController::class, 'update'])->name('usuarios.actualizar');
Route::get('/usuarios', [UserController::class, 'list'])->name('usuarios');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::delete('/usuarios/eliminar', [UserController::class, 'deleteSelected'])->name('usuarios.eliminar');

Route::resource('permissions', PermissionController::class)->except(['show']);

// Rutas de departamentos
Route::get('/ExportDptExcel', [DepartamentoController::class, 'exportarAllDepartamentos_Excel'])->name('Departamento.ExportExcel');
Route::get('/ExportDptPdf', [DepartamentoController::class, 'exportarAllDepartamentos_Pdf'])->name('Departamento.ExportPdf');
Route::resource('departamentos', DepartamentoController::class);

// Rutas de historial departamentos
Route::get('/ExportHistorialDptExcel', [HistorialDepartamentoController::class, 'exportarAllHistorialDepartamentos_Excel'])->name('Departamento.ExportExcelHistorial');
Route::get('/ExportHistorialDptPdf', [HistorialDepartamentoController::class, 'exportarAllHistorialDepartamentos_Pdf'])->name('Departamento.ExportPdfHistorial');
Route::resource('Historial_Departamentos', HistorialDepartamentoController::class);

// Rutas de prueba de Tests_Kev
Route::get('/tests_kev', [TestsKevControllerController::class, 'index'])->name('Tests.test');

// Rutas de layouts y perfil
Route::get('/layouts', function () {
    return view('layouts.gestion-de-roles');
})->name('roles');

Route::get('perfil/{id}', [UserController::class, 'showPerfil'])->name('perfil');

// Rutas del controlador Estudiante
Route::controller(EstudianteController::class)
    ->prefix('estudiantes')
    ->name('estudiantes.')
    ->group(function () {
        Route::get('/', 'index')->name('index');          
        Route::get('/create', 'create')->name('create');          
        Route::post('/', 'store')->name('store');         
        Route::get('/{id}', 'show')->name('show');        
        Route::put('/{id}', 'update')->name('update');    
        Route::delete('/{id}', 'destroy')->name('destroy'); 
    });

// Rutas del controlador Proyecto
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

// Rutas de recuperación y reseteo de contraseña
Route::get('/recuperarpassword', function () {
    return view('auth.recupassword');
})->name('recuperarpassword');

Route::get('/resetearpassword/{idUser}',[UserController::class,'resetearpassword'] );

Route::post('/enviocorreocode', [UserController::class, 'enviocorreocode'])->name('enviocorreocode');

Route::post('/updatepassword/{idUser}', [UserController::class, 'updatepassword'])->name('updatepassword');

// Rutas del controlador Estado
Route::controller(EstadoController::class)->group(function () {
    Route::get('/estados', 'index');            
    Route::post('/estados', 'store');          
    Route::get('/estados/{id}', 'show');        
    Route::put('/estados/{id}', 'update');       
    Route::delete('/estados/{id}', 'destroy');   
});

// Rutas del controlador Documento
Route::controller(DocumentoController::class)->group(function () {
    Route::get('/documentos', 'index');            
    Route::post('/documentos', 'store');            
    Route::get('/documentos/{id}', 'show');        
    Route::put('/documentos/{id}', 'update');       
    Route::delete('/documentos/{id}', 'destroy');   
});

// Rutas del controlador Asignacion
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

// Rutas del controlador ChatDocumento
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

// Rutas del controlador HorasSociales
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

// Rutas del controlador Notification
Route::controller(NotificacionController::class)
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

// Rutas del controlador ProyectosDocumentos
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
    //Rutas de controllador de roles 
    Route::get('/layouts/roles', [RoleController::class, 'index'])->name('layouts.roles');
    Route::post('/layouts/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/layouts/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::put('/layouts/roles/{role}', [RoleController::class, 'update'])->name('roles.update');

?>
