@extends('layouts.app')

@section('content')
<h1>Lista Documentos</h1>
<a href="/documento/create">Registrar Nuevo Documento</a> |
<a href="{{ route('documento.create') }}">Registrar Nuevo Documento 2</a>
<a href="{{ url('/documento/create') }}">Registrar Nuevo Documento 3</a>

<form action="{{ route('documento.index') }}" method="get">
    <input type="text" name="buscar" class="form-control" placeholder="buscar...">
    <input type="text" name="descripcion" class="form-control" placeholder="Ingrese Descripción">
    <input type="text" name="fecha" class="form-control" placeholder="Ingrese Fecha">
    <input type="submit" value="buscar" class="btn btn-primary">
</form>
<table class="table">
    <thead>
        <tr>
        <th>TITULO</th>
        <th>FECHA</th>
        <th>DESCRIPCION</th>
        <th>ARCHIVO</th>
        <th>USUARIO</th>   
        <th>ACCIONES</th>     
        </tr>
    </thead>
    <tbody>
    @foreach ($lista_docs as $doc)    
        <tr>
            <td>{{ $doc->titulo }}</td>
            <td>{{ $doc->fecha }}</td>
            <td>{{ $doc->descripcion }}</td>
            <td>
                <a href="/{{ $doc->archivo }}" target="_blank" class="btn btn-warning">Mostrar Archivo</a>
            </td>
            <td>{{ $doc->user->name }}</td>
            <td>
                <a href="{{ route('documento.edit', $doc->id) }}" class="btn btn-success">editar</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $lista_docs->links() }}
@endsection

