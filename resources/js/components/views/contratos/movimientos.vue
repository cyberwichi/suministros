<template>
    <div class="table-responsive">
        <h2>Movimientos en Contratos</h2>
        <autocompletarclient-component
            @newcontacto="buscarcontratos($event)"
        ></autocompletarclient-component>
        <div v-if="vercontratos" class="card bg-light border border-secondary">
            Contrato Seleccionado:
            <div class="d-flex justify-content-between text-center px-2">
                <div class="w-50">Comentario:</div>
                <div class="w-25">Importe:</div>
                <div class="w-25">Saldo:</div>
            </div>
            <div class="d-flex justify-content-between text-center px-2 mb-2">
                <input
                    class="text-center w-50 form-control"
                    v-model="contrato.comentario"
                    readonly
                />
                <input
                    class="text-center w-25 form-control"
                    v-model="contrato.importe"
                    readonly
                />
                <input
                    class="text-center w-25 form-control"
                    v-model="contrato.saldo"
                    readonly
                />
            </div>
            <div class="dropdown mt-1  p-2" v-if="vercontratos">
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
                <div
                    class="dropdown-menu w-100"
                    aria-labelledby="dropdownMenuButton"
                >
                    <button
                        type="button"
                        class="dropdown-item border border-secondary rounded bg-light d-flex justify-content-between m-1"
                        v-for="contrat in cliente.contrato"
                        :key="contrat.id"
                        v-on:click="seleccionarContrato(contrat)"
                    >
                        <div class="">{{ contrat.comentario }}</div>
                        <div>Importe:{{ contrat.importe }}</div>
                        <div>Saldo:{{ contrat.saldo }}</div>
                        <div class="dropdown-divider"></div>
                    </button>
                </div>
            </div>
        </div>
        <div
            v-if="vermovimientos"
            class="card bg-light border border-secondary mt-2 table-responsive p-3"
        >
            <h2>Movimientos</h2>

            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Aviso</th>
                        <th scope="col">Albaran</th>
                        <th scope="col">Importe sin IVA</th>
                        <th scope="col">Comentario</th>
                    </tr>
                </thead>
                <tbody v-for="(movimi, index) in movimientos" :key="index">
                    <tr
                        v-for="mov in movimi"
                        :key="mov.id"
                        v-on:click="verpdf(mov.id)"
                    >
                        <th scope="row">{{ mov.aviso_id }}</th>
                        <td>{{ mov.id }}</td>
                        <td>
                            {{ totales[mov.id] }}
                        </td>

                        <td>{{ mov.observaciones }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import datatables from "datatables";
export default {
    data() {
        return {
            contratos: [],
            vercontratos: false,
            cliente: {},
            contrato: {},
            movimientos: [],
            vermovimientos: false,
            totales:[],
            aux: 0,
            table:'',
        };
    },
    mounted() {},
    methods: {
        seleccionarContrato(con) {
            this.contrato = con;
            this.totales=[];
            axios.get("api/movimientos/" + this.contrato.id).then(response => {
                this.movimientos = response.data;
                this.movimientos.forEach(elem=>{
                    elem.forEach(element=>{
                        this.aux=0;
                        element.detallealbarans.forEach(detalle=>{
                            this.aux += (detalle.cantidad * detalle.precio);
                        })
                        this.totales[element.id]=this.aux;
                    })
                })
                this.vermovimientos = true;
                this.activarTabla();
            });
        },
        buscarcontratos(id) {
            this.vercontratos = true;
            this.cliente = id;
            this.contrato = {};
            this.vermovimientos= false;
            this.totales = [];
            this.movimientos = [];
        },
        verpdf(id) {
            window.open(
                        "albaranes/albaran" + id + ".pdf",
                        "_blank",
                        "width=800,height=700"
                    );

        },
        activarTabla() {
            $(document).ready(()=> {
                if ( $.fn.dataTable.isDataTable( '#myTable' ) ) {
                    this.table = $('#mytable').DataTable();
                }
                else {
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
                }
            });
        },
    }
};
</script>
<style scoped></style>
