@extends('layouts.admin')

@section('titulo', 'Lista de Sucursales')

@section('contenido')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

               

@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<hr>

<a href="{{ route('sucursal.create') }}" class="btn btn-primary">Nueva Sucursal</a>

<table class="table table-striped table-hover" border=1>
    <tr>
        <td>NOMBRE</td>
        <td>TELEFONO</td>
        <td>DIRECCION</td>
        <td>USUARIO</td>
        <td>ACCIONES</td>
    </tr>
    @foreach ($lista_sucursales as $sucursal)    
    <tr>
        <td>{{ $sucursal->nombre }}</td>
        <td>{{ $sucursal->telefono }}</td>
        <td>{{ $sucursal->direccion }}</td>
        <td>{{ $sucursal->user_id }}</td>
        <td>
            <a href="{{ route('sucursal.edit', $sucursal->id) }}" class="btn btn-warning btn-xs">editar</a>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$sucursal->id}}">
  Mostrar productos
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{$sucursal->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista de Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-striped">
            <tr>
                <td>ID</td>
                <td>NOMBRE</td>
                <td>PRECIO</td>
                <td>STOCK</td>
            </tr>
            @foreach ($sucursal->productos as $producto)            
            <tr class="{{($producto->pivot->stock > 6)?'':'bg-warning'}}">
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td >{{ $producto->pivot->stock }}</td>
            </tr>
            @endforeach
            
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        </td>
    </tr>
    @endforeach
</table>
            </div>
        </div>
    </div>

</div>


@endsection
