@extends("layouts.admin")

@section("titulo", "Nuevo Pedido - ". $sucursal->nombre)

@section("contenido")

<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Lista de Productos</div>
                
                <table class="table table-striped table-hover">
                    <tr>
                        <td>NOMBRE</td>
                        <td>PRECIO</td>
                        <td>STOCK</td>
                        <td>ACCION</td>
                    </tr>
                    @foreach ($sucursal->productos as $prod)
                    <tr>
                        <td>{{ $prod->nombre }}</td>
                        <td>{{ $prod->precio }}</td>
                        <td>{{ $prod->pivot->stock }}</td>
                        <td>
                            <button class="btn btn-info" onclick="seleccionarProd('{{$prod}}')">seleccionar</button>
                        </td>
                    </tr>
                        
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Carrito</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>NOMBRE</td>
                                    <td>PRECIO</td>
                                    <td>CANTIDAD</td>
                                    <td>ACCION</td>
                                </tr>
                            </thead>
                            <tbody id="carrito">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cliente</div>

                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Nuevo Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">INGRESE NOMBRE COMPLETO:</label>
        <input type="text" id="nombre_completo" class="form-control">
        <label for="">CI / NIT:</label>
        <input type="text" id="ci_nit" class="form-control">
        <label for="">TELEFONO:</label>
        <input type="text" id="telefono" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="guardarCliente()">Guardar Cliente</button>
      </div>
    </div>
  </div>
</div>

<hr>
<h3>NOMBRE CLIENTE: <span id="clie"></span></h3>
<hr>

<button onclick="realizarPedido()" class="btn btn-info">Realizar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

let carrito = [];
let id_cliente = 0;

function listarCarrito(){
    let html = ``;
    for (let i = 0; i < carrito.length; i++) {
        const p = carrito[i];
        html += `
        <tr>
            <td>${p.nombre}</td>
            <td>${p.precio}</td>
            <td>1</td>
            <td><button onclick="quitarProd(${i})">x</button</td>
        </tr>
        `;
    }

    document.getElementById("carrito").innerHTML = html;   
}

function seleccionarProd(prod){
    let producto = JSON.parse(prod)
    carrito.push(producto)
    
    listarCarrito();
}

function quitarProd(pos){
    carrito.splice(pos, 1);
    listarCarrito();
}

function guardarCliente() {
    let nombre_completo = document.getElementById('nombre_completo').value;
    let ci_nit = document.getElementById('ci_nit').value;
    let telefono = document.getElementById('telefono').value; 

    let cliente = {nombre_completo: nombre_completo, ci_nit: ci_nit, telefono:telefono};
    axios.post("/cliente", cliente).then(function(res){

        console.log(res.data);
        document.getElementById("clie").innerHTML = res.data.nombre_completo
        id_cliente = res.data.id
        alert("Cliente Registrado: "+id_cliente)
    });


}

function realizarPedido() {
    let pedido = {
        productos: carrito,
        cliente_id: id_cliente
    }
    axios.post("/pedido/sucursal/{{$sucursal->id}}", pedido).then(function(res){
            console.log(res);
    });
}
</script>

@endsection

