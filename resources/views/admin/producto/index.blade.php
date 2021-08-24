<div id="app">
    <h1>Lista Productos</h1>
    <h1> @{{ titulo }} </h1>
    <input type="text" v-model="titulo">
    <table class="table">
        <tr>
            <td>ID</td>
            <td>NOMBRE</td>
            <td>PRECIO</td>
            <td>STOCK</td>
            <td>ACCIONES</td>
        </tr>
        <tr v-for="producto in lista_productos">
            <td>@{{ producto.id }}</td>
            <td>@{{ producto.nombre }}</td>
            <td>@{{ producto.precio }}</td>
            <td>@{{ producto.stock }}</td>
            <td>
                

            </td>
        </tr>
    </table>
    @{{ lista_productos }}
</div>


<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    let app = new Vue({
        el: "#app",
        // data
        data(){
            return {
                titulo: "Listado de Productos",
                estado: 1,
                lista_productos: []
            }
        },
        // created o mounted
        async mounted(){
            let { data } = await axios.get('/api/sucursal');
                    this.lista_productos = data
                    console.log(this.lista_productos);
        }
        // methods

    })
</script>
