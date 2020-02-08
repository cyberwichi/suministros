<template>
    <div>
        <h2>PROVEEDORES</h2>
        <ul class="nav nav-justified">
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-primary "
                        to="nuevoproveedor"
                        >NUEVO</router-link
                    >
            </li>
            <li class="nav-item">
                <router-link
                        tag="button"
                        class="text-white  btn btn-primary "
                        to="listadoproveedores"
                        >LISTADO</router-link
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
