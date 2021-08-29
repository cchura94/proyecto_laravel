@extends("layouts.admin")

@section("titulo", "Lista Pedidos de la Sucursal:". $sucursal->nombre)

@section("contenido")

<a href="/pedido/sucursal/{{$sucursal->id}}/nuevo" class="btn btn-primary">Nuevo Pedido</a>

@endsection