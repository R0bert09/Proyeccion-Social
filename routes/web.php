<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;
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

Route::get('/crear', function () {
    return view('usuarios.crearUsuario');
})->name('crear');

Route::get('/usuarios', function () {
    return view('usuarios.listaUsuario');
})->name('usuarios');


//endpoint de documentos 
Route::prefix('documentos')->group(function () {
    Route::get('/', function () {
        $controller = app(DocumentoController::class);
        $response = $controller->index();
        return response()->json($response->getData()); 
    });

    Route::post('/', function (Request $request) {
        $controller = app(DocumentoController::class);
        $controller->store($request);
        return response()->json(['message' => 'Documento creado exitosamente']);
    });

    Route::get('/{id}', function ($id) {
        $controller = app(DocumentoController::class);
        $response = $controller->show($id);
        return response()->json($response->getData());
    });

    Route::put('/{id}', function (Request $request, $id) {
        $controller = app(DocumentoController::class);
        $controller->update($request, $id);
        return response()->json(['message' => 'Documento actualizado exitosamente']);
    });

    Route::delete('/{id}', function ($id) {
        $controller = app(DocumentoController::class);
        $controller->destroy($id);
        return response()->json(['message' => 'Documento eliminado exitosamente']);
    });
});
//endpoint de estados
Route::prefix('estados')->group(function () {
    Route::get('/', function () {
        $controller = app(EstadoController::class);
        $response = $controller->index();
        return response()->json($response->getData()); 
    });

    Route::post('/', function (Request $request) {
        $controller = app(EstadoController::class);
        $controller->store($request);
        return response()->json(['message' => 'Estado creado exitosamente']);
    });

    Route::get('/{id}', function ($id) {
        $controller = app(EstadoController::class);
        $response = $controller->show($id);
        return response()->json($response->getData());
    });

    Route::put('/{id}', function (Request $request, $id) {
        $controller = app(EstadoController::class);
        $controller->update($request, $id);
        return response()->json(['message' => 'Estado actualizado exitosamente']);
    });

    Route::delete('/{id}', function ($id) {
        $controller = app(EstadoController::class);
        $controller->destroy($id);
        return response()->json(['message' => 'Estado eliminado exitosamente']);
    });
});