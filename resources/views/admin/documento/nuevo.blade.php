<h1>Nuevo Documento</h1>

<form action="{{ route('documento.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">Ingrese Titulo:</label>
    <input type="text" name="titulo">
    <br>
    <label for="">Ingrese Gestión:</label>
    <input type="date" name="fecha">
    <br>
    <label for="">Ingrese Tipo:</label>
    <input type="text" name="tipo">
    <br>
    <label for="">Descripción:</label>
    <textarea name="descripcion"></textarea>
    <br>
    <label for="">Ingrese Archivo:</label>
    <input type="file" name="archivo">
    <br>
    <input type="submit" value="Guardar Datos">
    <input type="reset">
</form>