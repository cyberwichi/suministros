<template>
    <div class="table-responsive">
        <h2>Recibir Articulos</h2>
        
        <h4 class="mt-3">Pedidos En Curso</h4>

        <table
            v-show="pedidos.length"
            id="otra"
            class="table table-bordered table-striped"
        >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Articulo</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Recibir</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(pedido, index) in pedidos" :key="pedido.id">
                    <th scope="row">
                        {{ pedido.id }}
                    </th>
                    <td>{{ pedido.article.nombre }}</td>
                    <td>
                        {{ pedido.proveedor.nombre }} <br />
                        Telefono: {{ pedido.proveedor.telefono }} <br />
                        Email: {{ pedido.proveedor.email }} <br />
                    </td>
                    <td>{{ pedido.cantidad }}</td>
                    <td>
                        {{ pedido.comentario }}
                    </td>
                    <td @click="recibirPedido(index)">Recibido</td>
                </tr>
            </tbody>
        </table>

        
    </div>
</template>
<script>
import datatables from "datatables";
export default {
    data() {
        return {   
            articulo:[],
            table2: '',
            pedidos: [],
            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningún dato disponible en esta tabla =(",
                sInfo:
                    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty:
                    "Mostrando registros del 0 al 0 de un total de 0 registros",
                sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                sInfoPostFix: "",
                sSearch: "Buscar:",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                oAria: {
                    sSortAscending:
                        ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending:
                        ": Activar para ordenar la columna de manera descendente"
                },
                buttons: {
                    copy: "Copiar",
                    colvis: "Visibilidad"
                }
            }
        };
    },
    mounted() {
        this.getarticulos();        
    },
    methods: {
        getarticulos() {
            axios.get("/api/pedidos").then(response => {
                this.pedidos = response.data;
                this.activarTabla();             
            });
        },
        recibirPedido(index)
        {
            axios.get('/api/recibepedido/'+ this.pedidos[index].id).then(response =>{
                console.log(response.data);
                this.pedidos.splice(index, 1);
            });
        },
        activarTabla() {
            $(document).ready(() => {
               /*  if ($.fn.dataTable.isDataTable("#myTable")) {
                    this.table = $("#myTable").DataTable();
                } else {
                    this.table = $("#myTable").DataTable({
                        language: this.language
                    });
                } */
                if ($.fn.dataTable.isDataTable("#otra")) {
                    this.table2 = $("#otra").DataTable();
                } else {
                    this.table2 = $("#otra").DataTable({
                        language: this.language
                    });
                }
            });
        },
        
    }
};
</script>
<style scoped></style>
