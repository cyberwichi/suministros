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
            component: require('./components/views/articles/articulos').default
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
            path: '/contratos',
            name: 'contratos',
            component: require('./components/views/contratos/contratos').default
        },
        {
            path: '/nuevocontrato',
            name: 'nuevocontrato',
            component: require('./components/views/contratos/nuevocontrato').default
        },
        {
            path: '/movimientoscontrato',
            name: 'movimientos',
            component: require('./components/views/contratos/movimientos').default
        },

        {
            path: '/listadocontrato',
            name: 'listadocontrato',
            component: require('./components/views/contratos/listadocontrato').default
        },
        {
            path: '/listadoarticle',
            name: 'listadoarticle',
            component: require('./components/views/articles/listadoarticle').default
        },
        {
            path: '/pedirarticle',
            name: 'pedirarticle',
            component: require('./components/views/articles/pedirarticle').default
        },
        {
            path: '/recibirarticle',
            name: 'recibirarticle',
            component: require('./components/views/articles/recibirarticle').default
        },
        {
            path: '/nuevoarticle',
            name: 'nuevoarticle',
            component: require('./components/views/articles/nuevoarticle').default
        },
        {
            path: '/proveedores',
            name: 'proveedores',
            component: require('./components/views/proveedores/proveedores').default
        },
        {
            path: '/listadoproveedores',
            name: 'listadoproveedores',
            component: require('./components/views/proveedores/listadoproveedores').default
        },
        {
            path: '/nuevoproveedor',
            name: 'nuevoproveedor',
            component: require('./components/views/proveedores/nuevoproveedor').default
        },
        {
            path: '/avisos',
            name: 'avisos',
            component: require('./components/views/avisos/avisos').default
        },
        {
            path: '/nuevoaviso',
            name: 'nuevoaviso',
            component: require('./components/views/avisos/nuevoaviso').default
        },
        {
            path: '/listadoavisos',
            name: 'listadoavisos',
            component: require('./components/views/avisos/listadoavisos').default
        },
        {
            path: '/albaranes',
            name: 'albaranes',
            component: require('./components/views/albaranes/albaranes').default
        }, {
            path: '/nuevoalbaran/:id?',
            name: 'nuevoalbaran',
            component: require('./components/views/albaranes/nuevoalbaran').default,
            props:true
        }, 
        {
            path: '/listadoalbaranes',
            name: 'listadoalbaranes',
            component: require('./components/views/albaranes/listadoalbaranes').default
        },
        {
            path: '*',
            name: '404',
            component: require('./components/views/404').default
        }
    ],
    mode: 'history'
});
