<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\User;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_sucursales = Sucursal::all();
        return view("admin.sucursal.listar", compact("lista_sucursales"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_usuarios = User::all();
        return view("admin.sucursal.nuevo", compact("lista_usuarios"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // validar
        $request->validate([
            "nombre" => "required|min:2|max:150",
            "direccion" => "required",
            "user_id" => "required"
        ]);
        // guardar
        $sucursal = new Sucursal;
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion = $request->direccion;
        $sucursal->user_id = $request->user_id;
        $sucursal->save();
        // redireccionar
        return redirect("/sucursal")->with("mensaje", "Sucursal Creado Correctamente!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sucursal = Sucursal::find($id);
        $lista_usuarios = User::all();
        return view("admin.sucursal.editar", compact('sucursal', 'lista_usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           // validar
        $request->validate([
            "nombre" => "required|min:2|max:150",
            "direccion" => "required",
            "user_id" => "required"
        ]);
        // guardar
        $sucursal = Sucursal::find($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->telefono = $request->telefono;
        $sucursal->direccion = $request->direccion;
        $sucursal->user_id = $request->user_id;
        $sucursal->save();
        // redireccionar
        return redirect("/sucursal")->with("mensaje", "Sucursal Modificado Correctamente!");
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
