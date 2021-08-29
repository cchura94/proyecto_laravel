@extends("layouts.admin")

@section("titulo", "Lista Pedidos")

@section("contenido")

<h2>ENCARDADO DE VENTAS: {{ Auth::user()->name }}</h2>
<h2>CORREO: {{ Auth::user()->email }}</h2>
<hr>
<h3>Seleccionar Sucursal para nueva venta </h3>

@foreach (Auth::user()->sucursales as $sucursal)
    <a href="/pedido/sucursal/{{$sucursal->id}}" class="btn btn-info">{{$sucursal->nombre}}</a>
    
@endforeach

@endsection