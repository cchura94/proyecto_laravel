<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    echo "Hola";
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// usuarios

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', function () {
        return "Administración";
    });

    Route::get('/admin/usuario', function () {
        return "Lista de Usuario";
    });
});

// roles
/*
Route::group(function () {
    Route::get('/admin2', function () {
        return "Administración 2";
    });

    Route::get('/admin2/usuario', function () {
        return "Lista de Usuario 2";
    });
});
*/

// productos