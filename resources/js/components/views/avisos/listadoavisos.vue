<template>
    <div class="table-responsive">
        <h2>Listado de Avisos</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Contrato</th>
                    <th scope="col">Terminado</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(contrato, index) in contratos"
                    :key="index"
                    v-on:click="editar(index)"
                >
                    <th scope="row">{{ contrato.id }}</th>
                    <td>{{ contrato.comentario }}</td>
                    <td>{{ contrato.client.nombre}}</td>
                    <td v-if="contrato.contrato">{{ contrato.contrato.comentario }}</td>
                     <td v-else>Sin Contrato</td>                    
                    <td >
                         <div class="btn" v-bind:class="[ contrato.terminado ? terminado : noterminado]"></div>    
                    </td>  
                </tr>
            </tbody>
        </table>
       <div id="modalEditaCliente" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form v-on:submit.prevent="actualizarCliente">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Edicion de Aviso Numero : {{ contrat.id}}
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
                                                        
                            <div v-if="contrat.contrato" class="card bg-light border border-secondary">
                                Contrato Seleccionado:
                                <div class="d-flex justify-content-between text-center px-2">
                                        <div class="w-50">Comentario:</div>                       
                                        <div class="w-25">Importe:</div>                        
                                        <div class="w-25">Saldo:</div>
                                </div>
                                <div class="d-flex justify-content-between text-center px-2 mb-2">
                                        <input class="text-center w-50 form-control" v-model="contrat.contrato.comentario" readonly/>
                                        <input class="text-center w-25 form-control" v-model="contrat.contrato.importe" readonly/>
                                        <input class="text-center w-25 form-control" v-model="contrat.contrato.saldo" readonly/>
                                </div>
                                <div class="dropdown mt-1  p-2" v-if="contrat.contrato">
                                    <button
                                        class="w-100 btn btn-light border border-secondary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        Contratos del Cliente
                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <button type="button" class="dropdown-item border border-secondary rounded bg-light d-flex justify-content-between m-1" v-for="contrate in contrat.client.contrato" :key="contrate.id" v-on:click="contrat.contrato=contrate">
                                            <div class="">{{ contrate.comentario }}</div>                       
                                            <div>Importe:{{ contrate.importe }}</div>                        
                                            <div>Saldo:{{ contrate.saldo }}</div>
                                        </button>
                                    </div>
                                </div>    
                            </div>
                            <div class="card  bg-light border border-secondary my-2 p-2">
                                <label for="comentario">Comentario</label>
                                <textarea
                                    type="text"
                                    class="form-control mb-3"
                                    id="comentario"
                                    placeholder="Introducir comentario"
                                    rows="3"
                                    v-model="contrat.comentario"
                                />
                            </div>
                            <div class="card bg-light mb-1 border border-secondary table-responsive">
                                <h5> Articulos del Aviso</h5>
                                    <table v-if="verarticulos" class="table">
                                        <thead>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Eliminar</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(detalle, index) in contrat.detalleaviso" :key="index">
                                                <td>{{detalle.article.id}}</td>
                                                <td>{{detalle.article.nombre}}</td>
                                                <td class="text-right"> <input v-on:change="actualizaTotal" type="text" v-model="detalle.cantidad"></td>
                                                <td class="text-right">{{detalle.precio}}</td>
                                                <td class="btn" v-on:click="borraarticulo(index)">
                                                    X
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-if="verarticulos" class="d-flex justify-content-between text-center px-2">
                                            <div class="w-50">Subtotal:</div>                       
                                            <div class="w-25">Iva 21%:</div>                        
                                            <div class="w-25">Total:</div>
                                    </div>
                                    <div v-if="verarticulos" class="d-flex justify-content-between text-center px-2 mb-2">
                                            <input class="text-center w-50 form-control" v-model="subtotal" readonly/>
                                            <input class="text-center w-25 form-control" v-model="iva" readonly/>
                                            <input class="text-center w-25 form-control" v-model="total" readonly/>
                                    </div>
                                    <autocompletararticulo-component @newarticulo="sumararticulo($event)" ></autocompletararticulo-component>
                            </div>
                            <div class="card bg-light mb-1 border border-secondary ">
                                Terminado
                                <div class="w-100 text-center"><input type="checkbox" v-model="contrat.terminado"></div>
                                <div class="bg-success" v-if="contrat.terminado">SI</div>
                                <div class="bg-danger" v-else>NO</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button v-on:click.prevent="mostrarmodal2" type="button" class="btn btn-danger">
                                Borrar Aviso
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
                            <h5>¿ESTA SEGURO DE QUERER BORRAR LOS DATOS DE ESTE AVISO?</h5>
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
                client:{},
                contrato:{},
                detalleaviso:[]
            },
            table:'',
            noterminado: "bg-danger",
            terminado: "bg-success",
            vercontratos:true,
            verarticulos:true,
            subtotal: 0,
            iva: 0,
            total: 0
        };
    },
    mounted() {
        this.getContratos();
        $('#myModal').on('hidden.bs.modal', function (e) {
            this.contrat={};
            this.contrat.client={};
            this.contrat.contrato={};
            this.contrat.detalleaviso=[]; 
        })
    },
    methods: {
        sumararticulo(arti){
            var aux= new Object;
            aux.article= arti;
            aux.cantidad=1;
            aux.precio= arti.precio;
            aux.aviso_id=this.contrat.id;
            aux.articulo_id=arti.id;
            this.contrat.detalleaviso.push(aux);
            this.actualizaTotal();
            this.verarticulos=true;
        },
        borraarticulo(index){
            this.contrat.detalleaviso.splice(index,1);
            this.actualizaTotal();
        },
        actualizaTotal(){
            this.iva = 0;
            this.subtotal = 0;
            this.total = 0;
            this.contrat.detalleaviso.forEach(element => {
                this.subtotal += element.precio * element.cantidad;
            });
            this.subtotal = Number(this.subtotal.toFixed(2));
            this.iva = this.subtotal * 0.21;
            this.iva = Number(this.iva.toFixed(2));
            this.total = this.subtotal + this.iva;
            this.total = Number(this.total.toFixed(2));
        },
        mostrarmodal2(){
            $('#modalConfirmaBorrarCliente').modal('show');
        },
        getContratos() {
            axios.get("/api/avisos").then(response => {
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
            this.contrat=new Object;            
            this.contrat = this.contratos[cliente];
            this.actualizaTotal();
           
        },
        actualizarCliente(){
            axios.put('/api/aviso/'+this.contrat.id, this.contrat).then(response=>{
                if (response.data=='Ok'){
                    $("#modalEditaCliente").modal("hide");
                }
            })
        },
        deleteCliente(id){
            axios.delete('/api/aviso/'+id).then(response=>{
                if (response.data=='Ok') {
                    let indice= this.contratos.findIndex(cli=>cli.id===id);
                    this.contratos.splice(indice,1);
                    $('#modalConfirmaBorrarCliente').modal('hide');
                    $("#modalEditaCliente").modal("hide");
                    alert('Aviso eliminado');
                }
            })
        }
    }
};
</script>
<style scoped>


</style>
