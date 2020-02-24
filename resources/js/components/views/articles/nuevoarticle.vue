<template>
    <div class="">
        <h2>Nuevo Articulo</h2>
        <form v-on:submit.prevent="guardacontrato">
           <div class="form-group">
                <label for="nombre">Nombre</label>
                <br />
                <textarea
                    type="text"
                    name="nombre"
                    id="nombre"
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
                    id="nserie"
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
                    id="descripcion"
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
                    id="precio"
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
                    id="stock"
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
                    id="stockvendido"
                    v-model="artic.stockvendido"
                    class="w-75"
                    required
                />
            </div>
            <div class="form-group">
                <label for="stockcomprado">Stock Comprado</label>
                <br />
                <input
                    type="text"
                    name="stockcomprado"
                    id="stockcomprado"
                    v-model="artic.stockcomprado"
                    class="w-75"
                    required
                />
            </div>
            <div>
                Proveedores del Articulo
                <div class="table-responsive">
                    <table class="table" >
                        <thead>
                            <th>Id</th>
                            <th>Proveedor</th>
                            <th>Coste</th>
                        </thead>
                        <tbody>
                            <tr v-for="(aux,index) in proveedors" :key="index" >
                                <td>{{aux.proveedorid}}</td>
                                <td>{{aux.proveedornombre}}</td>
                                <td>
                                    <input type="text" v-model="aux.coste" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <autocompletarproveedor-component @newcontacto="sumarProveedor($event)"></autocompletarproveedor-component>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            artic: {
                nombre:'',
                nserie:'',
                descripcion: '',
                proveedor_id: 1,
                precio: 0.00,
                stock: 0,
                stockvendido: 0,
                stockcomprado: 0
            },
            borra: false,
            proveedors:[]
        };
    },
    mounted() {},
    methods: {
        sumarProveedor(prov){
            console.log(prov);
            var aux = {};
            aux.proveedor_id= prov.id;
            aux.proveedornombre= prov.nombre;
            aux.coste= 0.00;            
            this.proveedors.push(aux);
        },
        guardacontrato() {
            axios.post("/api/article", this.artic).then(response => {
                this.proveedors.forEach(data=>{
                    console.log(data);
                    axios.post("/api/proveedorarticulo/" + response.data.id, data)
                        .then(response =>{
                            console.log(response.data);
                            this.artic = {
                                nombre:'',
                                nserie:'',
                                descripcion: '',
                                proveedor_id: 1,
                                precio: 0.00,
                                stock: 0,
                                stockvendido: 0,
                                stockcomprado: 0
                            };
                            this.borra = !this.borra;

                        });
                });
                this.proveedors=[];

            });
        }
    }
};
</script>
