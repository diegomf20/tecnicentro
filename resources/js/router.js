import Vue from 'vue';
import VueRouter from 'vue-router'
import multiguard from 'vue-router-multiguard'

Vue.use(VueRouter)

var title=(to, from,next)=>{
    document.title=to.meta.title;
    next();
}
var auth=(to, from,next)=>{
    
    if(local.getItem("cuenta")===null){
        next('/login');
    }else{
        next();
        var cuenta=JSON.parse(local.getItem("cuenta"));
        // if (to.meta.space == cuenta.tipo ){
        //     next();
        // }else{
        //     if(cuenta.tipo=="policia"){
        //         next('/reporte');
        //     }else{
        //         next('/home');
        //     }
        // }
    }
    
}

var routes =[
    // { 
    //     path: '/', 
    //     component: require('./view/Landing.vue').default,
    //     meta:{
    //         layout: "empty",
    //     },
    // },
    // { 
    //     path: '/home', 
    //     component: require('./view/Home.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/stock', 
    //     component: require('./view/Stock.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/lote', 
    //     component: require('./view/Lote.vue').default,
    //     beforeEnter: auth        
    // },
    // { 
    //     path: '/kardex', 
    //     component: require('./view/Kardex.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/reorden', 
    //     component: require('./view/Reorden.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/salidas', 
    //     component: require('./view/Salidas.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/compra', 
    //     component: require('./view/Compra.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/lista-compra', 
    //     component: require('./view/ListaCompra.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/venta', 
    //     component: require('./view/Venta.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/lista-venta', 
    //     component: require('./view/ListaVenta.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/proveedor', 
    //     component: require('./view/Proveedor.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/producto', 
    //     component: require('./view/Producto.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/notificacion', 
    //     component: require('./view/Notificacion.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/usuario', 
    //     component: require('./view/Usuario.vue').default,
    //     beforeEnter: auth
    // },
    // { 
    //     path: '/contraseña_cambiar', 
    //     component: require('./view/CambiarPassword.vue').default,
    //     beforeEnter: auth
    // },
    { 
        path: '/login', 
        component: require('./view/Login.vue').default,
        meta:{
            layout: "empty",
        },
    },
    // { 
    //     path: '/passwordReset', 
    //     component: require('./view/ResetPassword.vue').default,
    //     meta:{
    //         layout: "empty",
    //     },
    // },
    // { 
    //     path: '/passwordNew/:token', 
    //     component: require('./view/NewPassword.vue').default,
    //     meta:{
    //         layout: "empty",
    //     },
    // },
];
var router=new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active',
    exact: true
});
export default router;