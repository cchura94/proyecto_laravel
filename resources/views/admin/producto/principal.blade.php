@extends("layouts.admin")

@section('titulo', 'Lista de Productos')

@section("css")
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  
@endsection    


@section("contenido")
@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif
<div class="card">
              <div class="card-header">
                <!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal">
  Nuevo Producto
</button>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
          @csrf
      <div class="modal-body">
        <label for="">Nombre del Producto</label>
        <input type="text" required class="form-control" name="nombre">

        <label for="">Ingrese precio:</label>
        <input type="number" step="0.01" class="form-control" name="precio">
        <label for="">Ingrese Descrición:</label>
        <textarea name="descripcion" class="form-control"></textarea>

        <label for="">Imagen:</label>
        <input type="file"  class="form-control" name="imagen">

        <label for="">fecha_vencimiento:</label>
        <input type="date" class="form-control" name="fecha_vencimiento">
        
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
      </div>
      </form>
    </div>
  </div>
</div>

<a href="{{ route('reporte') }}" class="btn btn-info" target="_blank">Generar Reporte</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>FN</th>
                    <th>ACCIONES</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                      @foreach ($lista_productos as $prod)                      
                  <tr class="{{($prod->fecha_vencimiento && $prod->fecha_vencimiento < date('Y-m-d'))?'bg-danger':''}}">
                    <td>{{ $prod->id }}</td>
                    <td>{{$prod->nombre}}</td>
                    <td>{{$prod->precio}}</td>
                    <td> {{$prod->fecha_vencimiento}}</td>
                    <td>
                        
                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sucursalModal{{ $prod->id }}">
  Adicionar Sucursal
</button>

<!-- Modal -->
<div class="modal fade" id="sucursalModal{{ $prod->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Producto a Sucursal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('adicionar_productos_sucursal', $prod->id) }}" method="post">
      @csrf
      <div class="modal-body">
          <label for="">Producto:</label>
          <p>{{$prod->nombre}}</p>

          <label for="">Cantidad:</label>
          <input type="number" name="cantidad" class="form-control">
          
          <label for="">Seleccionar Sucursal</label>
          <select name="sucursal_id" id="" class="form-control">
          @foreach ($lista_sucursales as $sucursal)
            <option value="{{ $sucursal->id }}">{{$sucursal->nombre}}</option>
          @endforeach
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Asignar Productos</button>
      </div>
      </form>
    </div>
  </div>
</div>
                        
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

@endsection

@section("js")
    <!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection