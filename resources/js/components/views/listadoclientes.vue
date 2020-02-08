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
                <tr
                    v-for="cliente in clientes"
                    :key="cliente.id"
                    v-on:click="editar(cliente)"                    
                >
                    <th scope="row">{{ cliente.id }}</th>
                    <td>{{ cliente.nombre }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.cif }}</td>
                    <td>{{ cliente.direccion }}</td>
                    <td>{{ cliente.telefono }}</td>
                </tr>
            </tbody>
        </table>
        <div id="modalEditaCliente" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="actualizarCliente">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Edicion de Cliente: {{ client.nombre }}
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <br>
                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    v-model="client.nombre"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <br>
                                <input
                                    type="email"
                                    name="Email"
                                    id=""
                                    v-model="client.email"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="Cif">Cif</label>
                                <br>
                                <input
                                    type="text"
                                    name="Cif"
                                    id=""
                                    v-model="client.cif"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="Direccion">Direccion</label>
                                <br>
                                <input
                                    type="text"
                                    name="Direccion"
                                    id=""
                                    v-model="client.direccion"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="Telefono">Telefono</label>
                                <br>
                                <input
                                    type="text"
                                    name="Telefono"
                                    id=""
                                    v-model="client.telefono"
                                    class="w-75"
                                    required
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-on:click.prevent="mostrarmodal2" type="button" class="btn btn-danger">
                                Borrar Cliente
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modalConfirmaBorrarCliente" class="modal bg-danger" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content  bg-warning">
                    
                        <div class="modal-header">
                            <h5 class="modal-title">
                              Confirmacion de Eliminacion de datos
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body alert">
                            <h5>¿ESTA SEGURO DE QUERER BORRAR LOS DATOS DE ESTE CLIENTE?</h5>
                            <div>Recuerde que los datos seran eliminados de la base de datos definitivamente no siendo recuperables </div>
                        </div>
                        <div class="modal-footer">                            
                            <button v-on:click.prevent="deleteCliente(client.id)" type="submit" class="btn btn-danger">
                               Confirmar
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import datatables from "datatables";
export default {
    data() {
        return {
            clientes: [],
            client: {},
            table:''
        };
    },
    mounted() {
        this.getClientes();
    },
    methods: {
        mostrarmodal2(){
            $('#modalConfirmaBorrarCliente').modal('show');
        },
        getClientes() {
            axios.get("/api/clientes").then(response => {
                this.clientes = response.data;
                this.activarTabla();
            });
        },
        activarTabla() {
            $(document).ready(()=> {
                this.table=$("#myTable").DataTable({
                    language: {
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
        },
        editar(cliente) {
            $("#modalEditaCliente").modal("show");
            this.client = cliente;
        },
        actualizarCliente(){
            axios.post('/api/cliente/'+this.client.id, this.client).then(response=>{
                if (response.data=='ok'){

                    $("#modalEditaCliente").modal("hide");
                }
            })
        },
        deleteCliente(id){
            axios.delete('/api/cliente/'+id).then(response=>{
                if (response.data=='ok') {
                    let indice= this.clientes.findIndex(cli=>cli.id===id);
                    this.clientes.splice(indice,1);
                    $('#modalConfirmaBorrarCliente').modal('hide');
                    $("#modalEditaCliente").modal("hide");
                }
            })
        }
    }
};
</script>
<style scoped>

</style>
