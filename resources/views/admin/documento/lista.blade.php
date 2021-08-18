<h1>Lista Documentos</h1>
<a href="/documento/create">Registrar Nuevo Documento</a> |
<a href="{{ route('documento.create') }}">Registrar Nuevo Documento 2</a>

{{ $lista_docs }}

<table border="1">
    <thead>
        <tr>
        <th>TITULO</th>
        <th>FECHA</th>
        <th>ARCHIVO</th>
        <th>USUARIO</th>        
        </tr>
    </thead>
    <tbody>
    @foreach ($lista_docs as $doc)    
        <tr>
            <td>{{ $doc->titulo }}</td>
            <td>{{ $doc->fecha }}</td>
            <td>
                <a href="/{{ $doc->archivo }}" target="_blank">Mostrar Archivo</a>
            </td>
            <td>{{ $doc->user_id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>