<h1>Lista de Sucursales</h1>

@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif

<hr>

<a href="{{ route('sucursal.create') }}">Nueva Sucursal</a>

<table class="table" border=1>
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
            <a href="{{ route('sucursal.edit', $sucursal->id) }}">editar</a>
        </td>
    </tr>
    @endforeach
</table>