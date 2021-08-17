@extends("layouts.app")

@section("content")

<h1>Lista de Usuarios</h1>


<a href="/usuario/create" class="btn btn-success">Nuevo usuario</a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Gestión Roles
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/role" method="post">
            @csrf
            <input type="text" name="nombre" class="form-control">
            <input type="submit" value="Guardar Rol">
        </form>
        <table class="table">
            <tr>
                <td>ID</td>
                <td>NOMBRE</td>
                <td>ACCIONES</td>
            </tr>
            @foreach ($lista_roles as $rol)            
            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->nombre }}</td>
                <td></td>
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

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>CORREO</td>
            <td>NOMBRE</td>
            <td>ROLES</td>
            <td>EDITAR ROLES</td>
            <td>ACCIONES</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($lista_usuarios as $usuario)        
        <tr>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->name }}</td>
            <td>
                <ul>
                @foreach ($usuario->roles as $rol )
                    <li>{{$rol->nombre}}</li>
                @endforeach
                </ul>
            </td>
            <td>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{ $usuario->id }}">
  editar Roles
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{ $usuario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/usuario/{{ $usuario->id }}/asignar_rol" method="post">
       @csrf
      <div class="modal-body">
        @foreach ($lista_roles as $rol)
            {{ $rol->nombre }} <input type="checkbox" name="roles[]" value="{{$rol->id}}">
            <br>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Cambiar Roles</button>
      </div>
      </form>
    </div>
  </div>
</div>


            </td>
            <td>
                <button class="btn btn-warning">editar</button>
                <button class="btn btn-danger">eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
