<template>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav  nav-fill">
                <li class="nav-item  ">
                    <router-link
                        tag="button"
                        class="text-white btn btn-primary"
                        to="avisos"
                        >AVISOS</router-link
                    >
                </li>
                <li class="nav-item  ">
                    <router-link
                        tag="button"
                        class="text-white btn btn-primary"
                        to="albaranes"
                        >ALBARANES</router-link
                    >
                </li>
                <li class="nav-item">
                    <router-link
                        tag="button"
                        class="text-white  btn btn-primary "
                        to="clientes"
                        >CLIENTES</router-link
                    >
                </li>
                <li class="nav-item ">
                    <router-link
                        tag="button"
                        class="text-white  btn btn-primary "
                        to="contratos"
                        >CONTRATOS</router-link
                    >
                </li>
                
                <li class="nav-item  ">
                    <router-link
                        tag="button"
                        class="text-white btn btn-primary"
                        to="articulos"
                        >ARTICULOS</router-link
                    >
                </li>
                <li class="nav-item  ">
                    <router-link
                        tag="button"
                        class="text-white btn btn-primary"
                        to="proveedores"
                        >PROVEEDORES</router-link
                    >
                </li>


                 <li class="nav-item   ">
                    <button class="btn btn-outline-info" @click="$router.go(-1)">
                        <img src="/images/volver.png" width="20" height="20" alt="">                    
                    </button>
                </li>
               
            </ul>
            
        </div>
        <div class="card-body">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
<style scoped>
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all 0.5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(50px);
  opacity: 0;
}
</style>>
    
</style>
