<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursalController;

Route::get('/', function () {
    echo "Hola";
    return view('welcome');
});

Auth::routes(["register" => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// usuarios




Route::middleware(['auth','role:admin'])->group(function () {

    Route::resource("/documento", DocumentoController::class);
    // GET, POST, PUT, DELETE
    Route::resource("cliente", ClienteController::class);
    Route::resource("pedido", PedidoController::class);
    Route::resource("producto", ProductoController::class);
    Route::resource("proveedor", ProveedorController::class);
    Route::resource("sucursal", SucursalController::class);

    Route::post("/usuario/{id_usuario}/asignar_rol", [UsuarioController::class, "asignar_roles"]);
    Route::resource('/usuario', UsuarioController::class);
    Route::resource('/role', RoleController::class);

    
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