<template>
    <div>
        <h2>CONTRATOS</h2>
        <ul class="nav nav-justified">
            
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="nuevocontrato"
                        >NUEVO</router-link
                    >
            </li>
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="listadocontrato"
                        >LISTADO</router-link
                    >
            </li>
            <li class="nav-item">
               <router-link
                        tag="button"
                        class="text-white  btn btn-success "
                        to="movimientoscontrato"
                        >MOVIMIENTOS</router-link
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
