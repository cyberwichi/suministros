<template>
    <div class="">
        <form
            action=""
            v-on:submit.prevent="buscaaviso"
            class="border border-secondary rounded d-flex justify-content-center mb-2"
        >
            <h2 class="col-9">Nuevo Albaran</h2>
            <div class="col-3">
                <div class="input-group rounded mt-1">
                    <input
                        type="text"
                        name="numaviso"
                        v-model="numAviso"
                        required
                        class="text-center form-control"
                        placeholder="Aviso:"
                    />
                    <div class="input-group-prepend">
                        <button class="" type="submit">Cargar</button>
                    </div>
                </div>
            </div>
        </form>

        <form v-on:submit.prevent="guardaalbaran" class="">
            <div class="border border-secondary rounded d-flex flex-wrap mb-2">
                <h5 class="col-12">Cliente</h5>
                <div class="form-group col-6">
                    <label for="nombre">Cliente</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="aviso.client.nombre"
                        name="nombre"
                        readonly
                        autocomplete="off"
                    />
                </div>
                <div class="form-group col-6">
                    <label for="direccion">Direccion</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="aviso.client.direccion"
                        name="direccion"
                        readonly
                        autocomplete="off"
                    />
                </div>
                <div class="form-group col-6">
                    <label for="telefono">Telefono</label>
                    <input
                        type="text"
                        class="form-control"
                        name="telefono"
                        v-model="aviso.client.telefono"
                        autocomplete="off"
                        readonly
                    />
                </div>
                <div class="form-group col-6">
                    <label for="nif">Nif</label>
                    <input
                        class="form-control"
                        type="text"
                        v-model="aviso.client.cif"
                        name="nif"
                        readonly
                        autocomplete="off"
                    />
                </div>
                <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input
                        class="form-control"
                        type="email"
                        v-model="aviso.client.email"
                        name="email"
                        readonly
                        autocomplete="off"
                    />
                </div>
            </div>
            <div class="border border-secondary rounded mb-2" v-if="aviso.contrato">
                <h5>Contrato</h5>
                    <div
                        class="d-flex justify-content-between text-center px-2"
                    >
                        <div class="w-50">Comentario:</div>
                        <div class="w-25">Importe:</div>
                        <div class="w-25">Saldo:</div>
                    </div>
                    <div
                        class="d-flex justify-content-between text-center px-2 mb-2"
                    >
                        <input
                            class="text-center w-50 form-control"
                            v-model="aviso.contrato.comentario"
                            readonly
                        />
                        <input
                            class="text-center w-25 form-control"
                            v-model="aviso.contrato.importe"
                            readonly
                        />
                        <input
                            class="text-center w-25 form-control"
                            v-model="aviso.contrato.saldo"
                            readonly
                        />
                    </div>
                
                <!-- <div
                    class="dropdown-menu w-100"
                    aria-labelledby="dropdownMenuButton"
                >
                    <button
                        type="button"
                        class="dropdown-item border border-secondary rounded bg-light d-flex justify-content-between m-1"
                        v-for="contrat in aviso.client.contrato"
                        :key="contrat.id"
                        v-on:click="aviso.contrato = contrat"
                    >
                        <div class="">{{ contrat.comentario }}</div>
                        <div>Importe:{{ contrat.importe }}</div>
                        <div>Saldo:{{ contrat.saldo }}</div>
                        <div class="dropdown-divider"></div>
                    </button>
                </div> -->
            </div>
            <div class="form-group bg-light border border-secondary mt-2 p-2">
                <h5>Comentario</h5>
                <textarea
                    type="text"
                    class="form-control mb-3"
                    id="comentario"
                    placeholder="Introducir comentario"
                    rows="3"
                    v-model="aviso.comentario"
                    readonly
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
                         <tr v-for="(detalle, index) in aviso.detalleaviso" :key="index">
                            <td>{{detalle.article.id}}</td>
                             <td>{{detalle.article.nombre}}</td>
                            <td class="text-right"> <input v-on:change="actualizaTotal" type="text" v-model="detalle.cantidad" style="width:40px"></td>
                            <td class="text-right">{{detalle.precio}}</td>
                            <td class="btn" v-on:click="borradetalle(index)">
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
                <h5>Terminado</h5>
                <div class="w-100 text-center"><input type="checkbox" v-model="aviso.terminado"></div>
                <div class="bg-success" v-if="aviso.terminado">SI</div>
                <div class="bg-danger" v-else>NO</div>
            </div>

            <!-- firmas -->

            <div class="card bg-light mb-1 border border-secondary">
                <div >
                    <h5>Firma Cliente</h5>
                </div>
                <div class="firmas">
                    <div class="text-center col-12 ">
                        <div id="cliente" v-show="ponerfirma" >
                            <div>
                                <img
                                    id="save"
                                    src="/images/firma.png"
                                    width="45px"
                                    v-on:click="ponerImagen()"
                                />
                            </div>
                            <canvas
                                id="signature-pad2"
                                class="signature-pad"
                                width="150"
                                height="150"
                            ></canvas>
                        </div>
                        <img
                            id="clear"
                            src="/images/Delete.png"
                            width="45px"
                            v-on:click="quitarImagen()"
                        />
                    </div>
                    <img class="mb-2" id="firmacli" alt />
                </div>
            </div>
            <div class="form-group bg-light border border-secondary mt-2 p-2">
                <h5>Observaciones</h5>
                <textarea
                    type="text"
                    class="form-control mb-3"
                    id="observaciones"
                    placeholder="Introducir comentario"
                    rows="3"
                    v-model="observaciones"
                />
            </div>



            <button type="submit" class="btn btn-primary col-12">
                Guardar
            </button>
        </form>


    </div>
</template>
<script>
export default {
    data() {
       return {
            numAviso: null,
            aviso: {
                client: {},
                contrato:{},
                detalleaviso:[]
            },
            vercontratos: true,
            verarticulos: true,
            borra: false,
            iva: 0,
            subtotal: 0,
            total: 0,
            firmacli: "",
            ponerfirma:true,
            signaturePad: "",
            observaciones:''

        };
    },
    mounted() {
        if (this.$attrs.id){
            this.numAviso=this.$attrs.id;
            this.buscaaviso();
        }
        this.firmaCliente();       
    },
    watch: { 
        aviso: function(){

        }      
    },
    methods: {
        firmaCliente() {
            this.signaturePad = new SignaturePad(
                document.getElementById("signature-pad2"),
                {
                    backgroundColor: "rgba(122, 122, 122, .2)",
                    penColor: "rgb(0, 0, 0)"
                }
            );
        },
        ponerImagen() {            
                this.ponerfirma = false;
                var imgfirmacli = document.getElementById("firmacli");               
                this.firmacli = this.signaturePad.toDataURL("image/png");
                imgfirmacli.src = this.firmacli;
                           
        },
        quitarImagen() {
            this.signaturePad.clear();
            var imgfirmacli = document.getElementById("firmacli");           
            imgfirmacli.src = "";
            this.ponerfirma = true;
            this.firmaCliente();
        },
        buscaaviso() {
            axios.get("/api/aviso/" + this.numAviso).then(response => {
                this.aviso = response.data;
                this.actualizaTotal();
            });
        },
        borrartodo() {
            this.vercontratos = false;
            this.verarticulos = false;
            this.contrato = {};
            this.comentario = "";
            this.detalleaviso = [];
            this.iva = 0;
            this.subtotal = 0;
            this.total = 0;
            this.cliente = {};
        },
        sumararticulo(arti) {            
            var aux = new Object;
            aux.article=arti;
            aux.articulo_id=arti.id;
            aux.aviso=this.numAviso;
            aux.cantidad=1;
            aux.precio=arti.precio;
            this.aviso.detalleaviso.push(aux);
            this.actualizaTotal();
            this.verarticulos = true;
        },


        guardaalbaran() {
            var request = {
                aviso_id: this.aviso.id,
                firma: this.firmacli,
                observaciones: this.observaciones,
                detallealbaran: this.aviso.detalleaviso
            };
            axios.post("/api/albaran", request).then(response => {
                axios.get('/api/creapdf/'+ response.data).then(response=>{
                    window.open(
                        "albaranes/albaran" + response.data + ".pdf",
                        "_blank",
                        "width=800,height=700"
                    );
                    this.$router.push('listadoalbaranes');
                })               
            });
        },
        borradetalle(index) {
            this.aviso.detalleaviso.splice(index, 1);
            this.actualizaTotal();
        },
        actualizaTotal() {
            this.iva = 0;
            this.subtotal = 0;
            this.total = 0;
            this.aviso.detalleaviso.forEach(element => {
                this.subtotal += element.precio * element.cantidad;
            });
            this.subtotal = Number(this.subtotal.toFixed(2));
            this.iva = this.subtotal * 0.21;
            this.iva = Number(this.iva.toFixed(2));
            this.total = this.subtotal + this.iva;
            this.total = Number(this.total.toFixed(2));
        }
    }
};
</script>
<style scope>
.firmas {
    display: flex;
    width: 90%;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: auto;
}
</style>
