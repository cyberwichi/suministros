<template>
    <div>
        <h2>CLIENTES</h2>
        <ul class="nav nav-justified">
            
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="listadoClientes"
                        >LISTADO</router-link
                    >
            </li>
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="nuevocliente"
                        >NUEVO</router-link
                    >
            </li>
            <li class="nav-item">
               <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="clientes"
                        >CONTRATOS</router-link
                    >
            </li>
           
        </ul>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    mounted() {}
};
</script>
