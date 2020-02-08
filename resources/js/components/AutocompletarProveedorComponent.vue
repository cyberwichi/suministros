<template>
    <div class="card-body sombra">
        <div class="autocomplete form-group">
            <label for="querySearch">Proveedor</label>
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
                        onFocus = false;
                        $emit('newcontacto', contac);
                        borrar();
                    "
                    :key="index"
                >
                    <strong>{{
                        contac.nombre.substr(0, autocomplete.lenght)
                    }}</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            querySearch: '',
            contactos: [],
            currentFocus: "",
            autocomplete: "",
            onBlur: true,
            onFocus: false
        };
    },
    mounted() {
        var vm = this;        
        document.addEventListener("click", function(e) {
            vm.onBlur ? (vm.onFocus = false) : false;
        });
    },
    watch:{},
    methods: {
        addActive() {
            var vm = this;
            if (!vm.contactos) return false;
            if (vm.currentFocus >= vm.contactos.length) vm.currentFocus = 0;
            if (vm.currentFocus < 0) vm.currentFocus = vm.contactos.length - 1;
        },
        borrar() {
            this.querySearch = "";
            this.contactos =[];
        },
        getResult() {
            if (this.querySearch.length > 1) {
                document.getElementById("app").style.cursor = "progress";
                axios
                    .get("/api/searchproveedor/" + this.querySearch)
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
