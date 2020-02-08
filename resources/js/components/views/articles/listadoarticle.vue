<template>
    <div class="table-responsive">
        <h2>Listado de Articulos</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Numero Serie</th>
                    <th scope="col">Descripcion</th>
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
                    <td v-on:click="editar(article)">{{ article.nserie }}</td>
                    <td v-on:click="editar(article)">
                        {{ article.descripcion }}
                    </td>
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
        <div id="modalEditaArticle" class="modal" tabindex="-2" role="dialog">
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content">
                    <form v-on:submit.prevent="actualizarArticle">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Edicion de Articulo Numero : {{ artic.id }}
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
                                <label for="nserie">Numero de Serie</label>
                                <br />
                                <input
                                    type="text"
                                    name="nserie"
                                    id=""
                                    v-model="artic.nserie"
                                    class="w-75"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <br />
                                <textarea
                                    type="text"
                                    name="descripcion"
                                    id=""
                                    v-model="artic.descripcion"
                                    class="w-75"
                                    rows="3"
                                />
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <br />
                                <input
                                    type="text"
                                    name="precio"
                                    id=""
                                    v-model="artic.precio"
                                    class="w-75"
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
                                />
                            </div>
                            <div class="form-group">
                                <label for="stockcomprado"
                                    >Stock Comprado</label
                                >
                                <br />
                                <input
                                    type="text"
                                    name="stockcomprado"
                                    id=""
                                    v-model="artic.stockcomprado"
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
                                                        required
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
                                </div>
                                <autocompletarproveedor-component
                                    @newcontacto="sumarProveedor($event)"
                                ></autocompletarproveedor-component>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                v-on:click.prevent="mostrarmodal2"
                                type="button"
                                class="btn btn-danger"
                            >
                                Borrar Articulo
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
        <div
            id="modalConfirmaBorrarCliente"
            class="modal bg-danger"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
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
                    <div class="modal-body">
                        <h5>
                            ¿ESTA SEGURO DE QUERER BORRAR LOS DATOS DE ESTE
                            ARTICULO?
                        </h5>
                        <div>
                            Recuerde que los datos seran eliminados de la base
                            de datos definitivamente no siendo recuperables
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-on:click.prevent="deleteArticle(artic.id)"
                            type="submit"
                            class="btn btn-danger"
                        >
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
            articles: [],
            artic: {
                proveedor: {
                    nombre: ""
                }
            },
            table: "",
            proveedors: [],
            au: {
                proveedorid: "",
                coste: 0
            }
        };
    },
    mounted() {
        this.getArticles();
    },
    methods: {
        mostrarmodal2() {
            $("#modalConfirmaBorrarCliente").modal("show");
        },
        getArticles() {
            axios.get("/api/articles").then(response => {
                this.articles = response.data;
                this.activarTabla();
            });
        },
        activarTabla() {
            $(document).ready(() => {
                this.table = $("#myTable").DataTable({
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
        sumarProveedor(prov) {
            var aux = {};
            aux.articleid = this.artic.id;
            aux.coste = 0.0;
            aux.proveedor = prov;
            aux.proveedorid=prov.id;
            this.proveedors.push(aux);
        },
        editar(article) {
            $("#modalEditaArticle").modal("show");
            this.proveedors = [];
            this.artic = article;
            this.proveedors = article.proveedorarticle;
        },
        actualizarArticle() {
            axios
                .put("/api/article/" + this.artic.id, this.artic)
                .then(response => {
                    axios
                        .put("/api/proveedorarticuloup/" + this.artic.id)
                        .then(response => {
                            this.proveedors.forEach(data => {
                                console.log(data);
                                axios
                                    .post(
                                        "/api/proveedorarticulo/" +
                                            this.artic.id,
                                        data
                                    )
                                    .then(response => {
                                        console.log(response.data);
                                        if (response.data == "Ok") {
                                            $("#modalEditaArticle").modal(
                                                "hide"
                                            );
                                        }
                                    });
                            });
                        });
                });
        },
        deleteArticle(id) {
            axios.delete("/api/article/" + id).then(response => {
                if (response.data == "ok") {
                    let indice = this.articles.findIndex(cli => cli.id === id);
                    this.articles.splice(indice, 1);
                    $("#modalConfirmaBorrarCliente").modal("hide");
                    $("#modalEditaArticle").modal("hide");
                }
            });
        }
    }
};
</script>
<style scoped></style>
