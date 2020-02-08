<template>
    <div class="table-responsive">
        <h2>Nuevo Proveedor</h2>
        <form v-on:submit.prevent="guardacliente" >
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    placeholder="Nombre Proveedor"
                    required
                    v-model="cliente.nombre"
                />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Introducir email"
                    required
                    v-model="cliente.email"
                />
            </div>
            <div class="form-group">
                <label for="cif">C.I.F.</label>
                <input
                    type="text"
                    class="form-control"
                    id="cif"
                    placeholder="Introducir cif"
                    required
                    v-model="cliente.cif"
                />
            </div>
            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input
                    type="text"
                    class="form-control"
                    id="direccion"
                    placeholder="Introducir direccion"
                    required
                    v-model="cliente.direccion"
                />
            </div>
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input
                    type="text"
                    class="form-control"
                    id="telefono"
                    placeholder="Introducir telefono"
                    required
                    v-model="cliente.telefono"
                />
            </div>
            <div class="form-group">
                <label for=" comentario">comentario</label>
                <textarea
                    type="text"
                    class="form-control"
                    id="comentario"
                    rows=3
                    placeholder="Introducir comentario"
                    v-model="cliente.comentario"
                />
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cliente: {}
        };
    },
    mounted() {},
    methods: {
        guardacliente() {
            axios.post("/api/proveedor", this.cliente).then(response => {
                alert( "Proveedor registrado correctamente con el numero "+ response.data.id);
                this.cliente={};
            });
        }
    }
};
</script>
