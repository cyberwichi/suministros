<template>
    <div class="table-responsive">
        <h2>Articulos a Pedir</h2>
        <table id="myTable" class="table table-bordered table-striped mb-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Stock Vendido</th>
                    <th scope="col">Stock Pedido</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="article in articles" :key="article.id">
                    <th scope="row" v-on:click="editar(article)">
                        {{ article.id }}
                    </th>
                    <td v-on:click="editar(article)">{{ article.nombre }}</td>

                    <td>
                        <button
                            class="btn btn-secondary dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        ></button>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                        >
                            <div
                                class="dropdown-item"
                                href="#"
                                v-for="aux in article.proveedorarticle"
                                :key="aux.id"
                            >
                                {{ aux.proveedor.nombre }}
                                <br />
                                Coste :
                                {{ aux.coste }}
                            </div>
                        </div>
                    </td>
                    <td v-on:click="editar(article)">{{ article.precio }}</td>
                    <td v-on:click="editar(article)">{{ article.stock }}</td>
                    <td v-on:click="editar(article)">
                        {{ article.stockvendido }}
                    </td>
                    <td v-on:click="editar(article)">
                        {{ article.stockcomprado }}
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="mt-3">Pedidos En Curso</h2>

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
                    <th scope="col">Eliminar</th>
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
                    <td @click="eliminarPedido(index)">X</td>
                </tr>
            </tbody>
        </table>
        <div id="modalEditaArticle" class="modal" tabindex="-2" role="dialog">
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content">
                    <form v-on:submit.prevent="sumarpedido">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Pedir Articulo Numero : {{ artic.id }}
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
                                <br />
                                <textarea
                                    type="text"
                                    name="nombre"
                                    id=""
                                    v-model="artic.nombre"
                                    class="w-75"
                                    rows="3"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <br />
                                <input
                                    type="text"
                                    name="stock"
                                    id=""
                                    v-model="artic.stock"
                                    class="w-75"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="stockvendido">Stock Vendido</label>
                                <br />
                                <input
                                    type="text"
                                    name="stockvendido"
                                    id=""
                                    v-model="artic.stockvendido"
                                    class="w-75"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="stockcomprado"
                                    >Cantidad a Pedir</label
                                >
                                <br />
                                <input
                                    type="text"
                                    name="stockcomprado"
                                    id=""
                                    v-model="cantidad"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="stockcomprado">Comentario</label>
                                <br />
                                <input
                                    type="text"
                                    name="stockcomprado"
                                    id=""
                                    v-model="comentario"
                                    class="w-75"
                                    required
                                />
                            </div>
                            <div>
                                Proveedores del Articulo
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Id</th>
                                            <th>Proveedor</th>
                                            <th>Coste</th>
                                            <th>Eliminar</th>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(aux,
                                                index) in proveedors"
                                                :key="index"
                                            >
                                                <td>{{ aux.proveedorid }}</td>
                                                <td>
                                                    {{ aux.proveedor.nombre }}
                                                </td>
                                                <td>
                                                    <input
                                                        type="text"
                                                        v-model="aux.coste"
                                                        readonly
                                                    />
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger"
                                                        v-on:click="
                                                            proveedors.splice(
                                                                index,
                                                                1
                                                            )
                                                        "
                                                    >
                                                        X
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-if="proveedors.length > 1">
                                        Para un pedido concreto solo puede dejar
                                        un proveedor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                v-on:click="getarticulos"
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
            articles: [],
            pedidos: [],
            artic: {
                proveedor: {
                    nombre: ""
                }
            },
            proveedors: [],
            comentario: "",
            cantidad: 1,
            table:'',
            table2:'',
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
        eliminarPedido(id)
        {
            axios.delete('/api/pedido/'+this.pedidos[id].id).then( response=>{
                var index = this.articles.findIndex((artic)=>artic.id==response.data.id)
                this.articles[index]= response.data;
                this.pedidos.splice(id, 1);
                console.log(response.data);
            })
        },
        activarTabla() {
            $(document).ready(() => {
                if ($.fn.dataTable.isDataTable("#myTable")) {
                    this.table = $("#myTable").DataTable();
                } else {
                    this.table = $("#myTable").DataTable({
                        language: this.language
                    });
                }
                if ($.fn.dataTable.isDataTable("#otra")) {
                    this.table2 = $("#otra").DataTable();
                } else {
                    this.table2 = $("#otra").DataTable({
                        language: this.language
                    });
                }
            });
        },
        getarticulos() {
            axios.get("/api/articlesapedir").then(response => {
                this.articles = response.data;                
            });
            axios.get("/api/pedidos").then(response => {
                this.pedidos = response.data;
                /* if ($.fn.dataTable.isDataTable("#otra")) {
                    this.table2 = $("#otra").DataTable();
                } else {
                    this.table2 = $("#otra").DataTable({
                        language: this.language
                    });
                } */
                this.activarTabla();
            });
        },
        editar(id) {
            $("#modalEditaArticle").modal("show");
            this.proveedors = [];
            this.artic = id;
            this.proveedors = id.proveedorarticle;
            this.cantidad = 1;
            this.comentario = "";
        },
        sumarpedido() {
            var aux = {
                article_id: this.artic.id,
                nombre: this.artic.nombre,
                proveedor_id: this.artic.proveedorarticle[0].proveedor_id,
                nombre_proveedor: this.artic.proveedorarticle[0].proveedor
                    .nombre,
                telefono_proveedor: this.artic.proveedorarticle[0].proveedor
                    .telefono,
                email_proveedor: this.artic.proveedorarticle[0].proveedor.email,
                cantidad: this.cantidad,
                comentario: this.comentario
            };            
            this.cantidad = 1;
            this.comentario = "";
            axios.post('/api/pedido', aux).then(response=>{
                this.pedidos.push(response.data);
                var index = this.articles.findIndex((artic)=>artic.id==response.data.article_id)
                this.articles[index].stockcomprado = parseInt(this.articles[index].stockcomprado)+ parseInt(response.data.cantidad);
                $("#modalEditaArticle").modal("hide");
            });
            
        }
    }
};
</script>
<style scoped></style>
