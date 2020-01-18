<template>
    <div class="table-responsive">
        <h2>Listado de Clientes</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">C.I.F.</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes" :key="cliente.id">
                    <th scope="row">{{ cliente.id }}</th>
                    <td>{{ cliente.nombre }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.cif }}</td>
                    <td>{{ cliente.direccion }}</td>
                    <td>{{ cliente.telefono }}</td>
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
            clientes: []
        };
    },
    mounted() {
        this.getClientes();
    },
    methods: {
        getClientes() {
            axios.get("/api/clientes").then(response => {
                this.clientes = response.data;
                this.activarTabla();
            });
        },
        activarTabla() {
            $(document).ready(function() {
                $("#myTable").DataTable({
                    "language": {
                        sProcessing: "Procesando...",
                        sLengthMenu: "Mostrar _MENU_ registros",
                        sZeroRecords: "No se encontraron resultados",
                        sEmptyTable: "Ningún dato disponible en esta tabla =(",
                        sInfo:
                            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        sInfoEmpty:
                            "Mostrando registros del 0 al 0 de un total de 0 registros",
                        sInfoFiltered:
                            "(filtrado de un total de _MAX_ registros)",
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
                });
            });
        }
    }
};
</script>
