<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignacionController;

Route::get('/', function () {
    return view('login.login');
});

Route::get('/proyecto', function () {
    return view('permisos.gestionpermiso');
})
->name('proyecto');


