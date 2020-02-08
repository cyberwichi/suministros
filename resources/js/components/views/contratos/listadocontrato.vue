<template>
    <div class="table-responsive">
        <h2>Listado de Contratos</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Comentario</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="contrato in contratos"
                    :key="contrato.id"
                    v-on:click="editar(contrato)"                    
                >
                    <th scope="row">{{ contrato.id }}</th>
                    <td>{{ contrato.client.nombre }}</td>
                    <td>{{ contrato.importe }}</td>
                    <td v-if="contrato.saldo > 1" class="bg-success">{{ contrato.saldo }}</td>
                    <td v-else class="bg-danger">{{ contrato.saldo }}</td>
                    <td>{{ contrato.comentario }}</td>                    
                </tr>
            </tbody>
        </table>
        <div id="modalEditaCliente" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="actualizarCliente">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Edicion de Contrato Numero : {{ contrat.id}}
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
                                <label for="nombre">Cliente</label>
                                <br>
                                <input
                                    type="text"
                                    name="nombre"
                                    id=""
                                    v-model="contrat.client.nombre"
                                    class="w-75"
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="importe">Importe</label>
                                <br>
                                <input
                                    type="text"
                                    name="importe"
                                    id=""
                                    v-model="contrat.importe"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="importe">Saldo</label>
                                <br>
                                <input
                                    type="text"
                                    name="importe"
                                    id=""
                                    v-model="contrat.saldo"
                                    class="w-75"
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="comentario">Comentarios</label>
                                <br>
                                <textarea
                                    type="text"
                                    name="comentario"
                                    id=""
                                    v-model="contrat.comentario"
                                    class="w-75"
                                    rows="10"
                                    required
                                />
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button v-on:click.prevent="mostrarmodal2" type="button" class="btn btn-danger">
                                Borrar Contrato
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
                <div class="modal-content bg-warning">
                    
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
                        <div class="modal-body">
                            <h5>¿ESTA SEGURO DE QUERER BORRAR LOS DATOS DE ESTE CONTRATO?</h5>
                            <div>Recuerde que los datos seran eliminados de la base de datos definitivamente no siendo recuperables </div>
                        </div>
                        <div class="modal-footer">                            
                            <button v-on:click.prevent="deleteCliente(contrat.id)" type="submit" class="btn btn-danger">
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
            contratos: [],
            contrat: {
                client:{}
            },
            table:''
        };
    },
    mounted() {
        this.getContratos();
    },
    methods: {
        mostrarmodal2(){
            $('#modalConfirmaBorrarCliente').modal('show');
        },
        getContratos() {
            axios.get("/api/contrato").then(response => {
                this.contratos = response.data;
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
            this.contrat = cliente;
        },
        actualizarCliente(){
            axios.put('/api/contrato/'+this.contrat.id, this.contrat).then(response=>{
                if (response.data=='ok'){

                    $("#modalEditaCliente").modal("hide");
                }
            })
        },
        deleteCliente(id){
            axios.delete('/api/contrato/'+id).then(response=>{
                if (response.data=='ok') {
                    let indice= this.contratos.findIndex(cli=>cli.id===id);
                    this.contratos.splice(indice,1);
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
