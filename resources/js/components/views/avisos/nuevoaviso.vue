<template>
    <div class="">
        <h2>Nuevo Aviso</h2>
        <form v-on:submit.prevent="guardaaviso" class="">
            <autocompletarclient-component
                class="card bg-light mb-1 border border-secondary"
                :borra="borra"
                @newcontacto="añadircliente($event)"
            ></autocompletarclient-component>
            <div v-if="vercontratos" class="card bg-light border border-secondary">
                Contrato Seleccionado:
                <div class="d-flex justify-content-between text-center px-2">
                        <div class="w-50">Comentario:</div>                       
                        <div class="w-25">Importe:</div>                        
                        <div class="w-25">Saldo:</div>
                </div>
                <div class="d-flex justify-content-between text-center px-2 mb-2">
                        <input class="text-center w-50 form-control" v-model="contrato.comentario" readonly/>
                        <input class="text-center w-25 form-control" v-model="contrato.importe" readonly/>
                        <input class="text-center w-25 form-control" v-model="contrato.saldo" readonly/>
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
                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                        <button type="button" class="dropdown-item border border-secondary rounded bg-light d-flex justify-content-between m-1" v-for="contrat in contratos" :key="contrat.id" v-on:click="contrato=contrat">
                            <div class="">{{ contrat.comentario }}</div>                       
                            <div>Importe:{{ contrat.importe }}</div>                        
                            <div>Saldo:{{ contrat.saldo }}</div>
                            <div class="dropdown-divider"></div>
                        </button>

                    </div>
                </div>    
            </div>
                      
            <div class="form-group bg-light border border-secondary mt-2 p-2">
                <label for="comentario">Comentario</label>
                <textarea
                    type="text"
                    class="form-control mb-3"
                    id="comentario"
                    placeholder="Introducir comentario"
                    rows="3"
                    v-model="comentario"
                />
            </div>
            <div class="card bg-light mb-1 border border-secondary table-responsive">
               <h5> Añadir Articulos al Aviso</h5>
                <table v-if="verarticulos" class="table">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        <tr v-for="(detalle,index) in detalleaviso" :key="index">
                            <td>{{detalle.id}}</td>
                            <td>{{detalle.nombre}}</td>
                            <td class="text-right"> <input v-on:change="actualizaTotal" style="width:30px;" type="text" v-model="detalle.cantidad"></td>
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
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            contratos: [],
            borra: false,
            vercontratos: false,
            verarticulos: false,
            contrato:{},
            comentario: '',
            detalleaviso:[],
            iva:0,
            subtotal:0,
            total:0,
            cliente:{}
        };
    },
    mounted() {},
    watch:{
        
    },
    methods: {
        borrartodo(){
            this.vercontratos= false;
            this.verarticulos= false;
            this.contrato={};
            this.comentario= '';
            this.detalleaviso=[];
            this.iva=0;
            this.subtotal=0;
            this.total=0;
            this.cliente={};
        },
        sumararticulo(arti){
            arti.cantidad=1;
            this.detalleaviso.push(arti);
            this.actualizaTotal();
            this.verarticulos=true;
        },
        añadircliente(cliente) {
            this.contratos = [];
            this.vercontratos = false;
            this.cliente=cliente;
            axios
                .get("api/cliente/" + this.cliente.id + "/contratos")
                .then(response => {
                    this.contratos = response.data;
                    if (this.contratos.length) {
                        this.vercontratos = true;
                        this.contrato={};
                    }
                });
        },
        guardaaviso() {
            var request ={
                client_id: this.cliente.id,
                comentario: this.comentario,
                contrato_id: this.contrato.id,
                detalleaviso: this.detalleaviso
            }
            axios.post('/api/aviso', request).then( response=>{
                console.log(response.data)
                alert('Aviso Guardado');
                        this.borra=true;
                        this.borrartodo();
            })
        },
        borradetalle(index){
            this.detalleaviso.splice(index,1);
            this.actualizaTotal();
        },
        actualizaTotal() {
            this.iva = 0;
            this.subtotal = 0;
            this.total = 0;
            this.detalleaviso.forEach(element => {
                this.subtotal += element.precio * element.cantidad;
            });
            this.subtotal = Number(this.subtotal.toFixed(2));
            this.iva = this.subtotal * 0.21;
            this.iva = Number(this.iva.toFixed(2));
            this.total = this.subtotal + this.iva;
            this.total = Number(this.total.toFixed(2));
        },
    }
};
</script>
