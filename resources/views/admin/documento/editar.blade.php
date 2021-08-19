<h1>Editar Documento</h1>

<form action="{{ route('documento.update', $documento->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="">Ingrese Titulo:</label>
    <input type="text" name="titulo" value="{{ $documento->titulo }}">
    <br>
    <label for="">Ingrese Gestión:</label>
    <input type="date" name="fecha" value="{{ $documento->fecha }}">
    <br>
    <label for="">Ingrese Tipo:</label>
    <input type="text" name="tipo" value="{{ $documento->tipo }}">
    <br>
    <label for="">Descripción:</label>
    <textarea name="descripcion">{{ $documento->descripcion }}</textarea>
    <br>
    <p>Archivo Actual : <a href="/{{ $documento->archivo }}">{{ $documento->archivo }}</a></p>
    <label for="">Ingrese Archivo:</label>
    <input type="file" name="archivo">
    <br>
    <input type="submit" value="Modificar Datos">
    <input type="reset">
</form>