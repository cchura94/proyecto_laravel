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
        </td>
    </tr>
    @endforeach
</table>
            </div>
        </div>
    </div>

</div>


@endsection
