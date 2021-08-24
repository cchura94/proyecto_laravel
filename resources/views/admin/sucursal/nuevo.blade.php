@extends('layouts.admin')

@section('contenido')

<h1>Nueva Sucursal</h1>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<form action="{{ route('sucursal.store') }}" method="post">
    @csrf
    <label for="">Ingrese nombre de la Sucursal</label>
    <input type="text" name="nombre">
    <br>
    <label for="">Ingrese Telefono</label>
    <input type="text" name="telefono">
    <br>
    <label for="">Ingrese Dirección</label>
    <input type="text" name="direccion">
    <br>
    <label for="">Seleccione el Usuario encargado</label>
    
    <select name="user_id">
        <option value="">Seleccione una opción</option>
        @foreach ($lista_usuarios as $user)
            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
        @endforeach
    </select>
    <br>
    <input type="submit" value="Guardar Sucursal">
</form>

@endsection