<template>
    <div class="">
        <h2>Nuevo Contrato</h2>
        <form v-on:submit.prevent="guardacontrato">
            <div class="form-group">
                <autocompletarclient-component :borra="borra"
                    @newcontacto="añadircliente($event)"
                ></autocompletarclient-component>
                <label for="importe">Importe</label>
                <input
                    type="text"
                    class="form-control"
                    id="importe"
                    placeholder="Introducir importe"
                    required
                    v-model="contrato.importe"
                />
            </div>
            <div class="form-group">
                <label for="comentario">comentario</label>
                <textarea
                    type="text"
                    class="form-control"
                    id="comentario"
                    placeholder="Introducir comentario"
                    v-model="contrato.comentario"
                    rows="10"
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
            contrato: {},
            borra: false
        };
    },
    mounted() {},
    methods: {
        añadircliente(cliente) {
            this.contrato.client_id = cliente.id;
        },
        guardacontrato() {
            axios.post("/api/contrato", this.contrato).then(response => {
                alert(
                    "Contrato registrado correctamente con el numero " +
                        response.data.id
                );
                this.contrato = {};
                this.borra=!this.borra;
                
            });
        }
    }
};
</script>
