<template>
    <div class="card-body sombra">
        <div class="autocomplete form-group">
            <label for="querySearch">Cliente</label>
            <input
                @blur="onBlur = true"
                @focus="
                    onFocus = true;
                    onBlur = false;
                "
                class="form-control col-12"
                type="text"
                v-model="querySearch"
                name="querySearch"
                v-on:keyup="getResult()"
                v-on:keydown="keyDown"
                placeholder=""
                autocomplete="off"
            />
            <div class="autocomplete-items" v-if="onFocus">
                <div
                    v-for="(contac, index) in contactos"
                    @click="
                        querySearch = contac.nombre;
                        contacto.id = contac.id;
                        direccionForm = contac.direccion;
                        telefonoForm = contac.telefono;
                        nifForm = contac.cif;
                        emailForm = contac.email;
                        onFocus = false;
                        $emit('newcontacto', contac);
                    "
                    :key="index"
                >
                    <strong>{{
                        contac.nombre.substr(0, autocomplete.lenght)
                    }}</strong>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input
                class="form-control  col-12"
                type="text"
                v-model="direccionForm"
                name="direccion"
                readonly
                autocomplete="off"
            />
        </div>
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input
                type="text"
                class="form-control  col-12"
                name="telefono"
                v-model="telefonoForm"
                autocomplete="off"
                readonly
            />
        </div>
        <div class="form-group">
            <label for="nif">Nif</label>
            <input
                class="form-control  col-12"
                type="text"
                v-model="nifForm"
                name="nif"
                readonly
                autocomplete="off"
            />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                class="form-control  col-12"
                type="email"
                v-model="emailForm"
                name="email"
                readonly
                autocomplete="off"
            />
        </div>
    </div>
</template>

<script>
export default {
    props:["borra"],
    data() {
        return {
            ip: "",
            contacto: {
                id: "",
                nombre: this.querySearch,
                telefono: this.telefonoForm,
                nif: this.nifForm,
                email: this.emailForm
            },
            querySearch: "",
            contactos: [],
            currentFocus: "",
            autocomplete: "",
            onBlur: true,
            onFocus: false,
            upcForm: "",
            direccionForm: "",
            telefonoForm: "",
            nifForm: "",
            emailForm: ""
        };
    },
    mounted() {
        var vm = this;
        document.addEventListener("click", function(e) {
            vm.onBlur ? (vm.onFocus = false) : false;
        });
    },
    watch:{
        borra: function(val){
            
                this.borrar();
           
        }
    },
    methods: {
        addActive() {
            var vm = this;
            if (!vm.contactos) return false;
            if (vm.currentFocus >= vm.contactos.length) vm.currentFocus = 0;
            if (vm.currentFocus < 0) vm.currentFocus = vm.contactos.length - 1;
        },
        borrar() {
            this.querySearch = "";
            this.direccionForm = "";
            this.telefonoForm = "";
            this.nifForm = "";
            this.emailForm = "";
            this.contactos =[];
        },
        getResult() {
            if (this.querySearch.length > 1) {
                document.getElementById("app").style.cursor = "progress";
                axios
                    .get("/api/searchcontacto/" + this.querySearch)
                    .then(response => {
                        this.contactos = [];
                        response.data.forEach(contacto => {
                            this.contactos.push(contacto);
                        });
                        document.getElementById("app").style.cursor = "auto";
                    });
            }
        },
        keyDown(e) {
            var vm = this;

            if (e.keycode == 40) {
                vm.currentFocus++;
                vm.addActive();
            } else if (e.keyCode == 38) {
                vm.currentFocus--;
                vm.addActive();
            }
        }
    }
};
</script>
