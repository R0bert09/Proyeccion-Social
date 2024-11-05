<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\historial_departamentoController;
use App\Http\Controllers\Tests_KevControllerController;
use Illuminate\Support\Facades\Route;

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

//departamentos
Route::get('/ExportDptExcel', [DepartamentoController::class, 'exportarAllDepartamentos_Excel'])->name('Departamaento.Exportexcel');
Route::get('/ExportDptPdf', [DepartamentoController::class, 'exportarAllDepartamentos_Pdf'])->name('Departamaento.ExportPdf');

Route::resource('departamentos', DepartamentoController::class);

//historial departamentos
Route::get('/ExportHistorialDptExcel', [historial_departamentoController::class, 'exportarAllHistorialDepartamentos_Excel'])->name('Departamaento.ExportexcelHistotial');
Route::get('/ExportHistorialDptPdf', [historial_departamentoController::class, 'exportarAllHistorialDepartamentos_Pdf'])->name('Departamaento.ExportPdfHistotial');

Route::resource('Historial_Departamentos', historial_departamentoController::class);


Route::get('/tests_kev',[Tests_KevControllerController::class,'index'])->name('Tests.test');w