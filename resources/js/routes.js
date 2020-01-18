import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [{
            path: '/home',
            name: 'home',
            component: require('./components/views/home').default
        },
        {
            path: '/clientes',
            name: 'clientes',
            component: require('./components/views/clientes').default
        },
        {
            path: '/articulos',
            name: 'articulos',
            component: require('./components/views/articulos').default
        },
        {
            path: '/listadoclientes',
            name: 'listadoClientes',
            component: require('./components/views/listadoclientes').default
        },
        {
            path: '/nuevocliente',
                name: 'nuevocliente',
                component: require('./components/views/nuevocliente').default
        },
        {
            path: '*',
            name: '404',
            component: require('./components/views/404').default
        }
    ],
    mode: 'history'
});