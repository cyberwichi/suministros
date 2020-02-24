<template>
    <div class="table-responsive">
        <h2>Listado de Albaranes</h2>
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero Aviso</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Contrato</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Terminado</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(contrato, index) in contratos"
                    :key="index"
                    v-on:click="editar(contrato.id)"
                >
                    <th scope="row">{{ contrato.id }}</th>
                    <td>{{ contrato.aviso_id }}</td>
                    <td> <div v-if="contrato.aviso">{{ contrato.aviso.client.nombre}}</div>
                    <div v-else> AVISO</div></td>
                    <td><div  v-if="contrato.aviso">{{ contrato.aviso.contrato.comentario}}</div>
                    <div v-else> ELIMINADO</div> 
                    </td>

                    <td>{{ contrato.observaciones }}</td>                    
                    <td >
                         <div  v-if="contrato.aviso" class="btn" v-bind:class="[ contrato.aviso.terminado ? terminado : noterminado]"></div>    
                    </td>  
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
            contratos: [],
            contrat: {
                aviso:{
                    client: {
                        nombre: ''
                    }
                },
                detallealbarans:[]
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
    },
    methods: {        
        getContratos() {
            axios.get("/api/albaranes").then(response => {
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
            window.open(
                        "albaranes/albaran" + cliente + ".pdf",
                        "_blank",
                        "width=800,height=700"
                    );
           
        }
    }
};
</script>
<style scoped>


</style>
