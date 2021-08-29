<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.pedido.index");
    }

    public function lista_pedidos($id_sucursal)
    {
        $sucursal = Sucursal::find($id_sucursal);
        return view("admin.pedido.lista_pedido_sucursal", compact('sucursal'));
    }

    public function nuevo_pedido($id)
    {
        $sucursal = Sucursal::find($id);

        return view("admin.pedido.nuevo_pedido_sucursal", compact('sucursal'));
    }

    public function guardar_pedido($id, Request $request)
    {
        $pedido = new Pedido;
        $pedido->fecha_pedido = date('Y-m-d H:i:s');
        $pedido->estado = 1;
        $pedido->monto_total = 0;
        $pedido->cliente_id = $request->cliente_id;
        $pedido->save();

        $productos = $request->productos;

        foreach ($productos as $prod) {

            $pedido->productos()->attach($prod['id'], ['cantidad' => 1, "sucursal_id" => $id]);
        }
    
        $pedido->estado=2;
        $pedido->save();

        return response()->json($pedido);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
