@extends("layouts.admin")


@section('contenido')

<h1>Editar Sucursal</h1>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<form action="{{ route('sucursal.update', $sucursal->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="">Ingrese nombre de la Sucursal</label>
    <input type="text" name="nombre" value="{{ $sucursal->nombre }}">
    <br>
    <label for="">Ingrese Telefono</label>
    <input type="text" name="telefono" value="{{ $sucursal->telefono }}">
    <br>
    <label for="">Ingrese Dirección</label>
    <input type="text" name="direccion" value="{{ $sucursal->direccion }}">
    <br>
    <label for="">Seleccione el Usuario encargado</label>
    
    <select name="user_id">
        <option value="">Seleccione una opción</option>
        @foreach ($lista_usuarios as $user)
            <option value="{{$user->id}}" {{ ($user->id == $sucursal->user_id)?'selected':'' }}>{{$user->name}} - {{$user->email}}</option>
        @endforeach
    </select>
    <br>
    <input type="submit" value="Modificar Sucursal">
</form>

@endsection