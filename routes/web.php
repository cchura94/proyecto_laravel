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
    // return view('welcome');
    return redirect("/login");
});

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// usuarios




Route::middleware(['auth','role:admin'])->group(function () {

    // adicionar productos a sucursales
    Route::post("/producto/{id}/asignar_sucursal", [ProductoController::class, "adicionar_productos_sucursal"])->name('adicionar_productos_sucursal');
    // reporte pdf
    Route::get("/producto/reporte", [ProductoController::class, "reporte"])->name('reporte');


    Route::resource("/documento", DocumentoController::class);
    // GET, POST, PUT, DELETE
    
    
    Route::resource("producto", ProductoController::class);
    Route::resource("proveedor", ProveedorController::class);
    Route::resource("sucursal", SucursalController::class);

    Route::post("/usuario/{id_usuario}/asignar_rol", [UsuarioController::class, "asignar_roles"]);
    Route::resource('/usuario', UsuarioController::class);
    Route::resource('/role', RoleController::class);

    
    
});


Route::middleware(['auth','role:ventas'])->group(function () {
    Route::get("/pedido/sucursal/{id}", [PedidoController::class, "lista_pedidos"]);
    Route::get("/pedido/sucursal/{id}/nuevo", [PedidoController::class, "nuevo_pedido"]);
    
    Route::post("/pedido/sucursal/{id}", [PedidoController::class, "guardar_pedido"]);
    Route::resource("pedido", PedidoController::class);

    Route::resource("cliente", ClienteController::class);
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