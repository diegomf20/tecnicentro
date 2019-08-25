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
    { 
        path: '/comprobante1/:id', 
        component: require('./view/comprobante/Comprobante1.vue').default,
        meta:{
            layout: "empty",
        },
    },
    { 
        path: '/nota', 
        component: require('./view/Nota.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/herramienta', 
        component: require('./view/Herramienta.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/pieza', 
        component: require('./view/Pieza.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/usuario', 
        component: require('./view/contactos/Usuario.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/cliente', 
        component: require('./view/contactos/Cliente.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/proveedor', 
        component: require('./view/contactos/Proveedor.vue').default,
        // beforeEnter: auth
    },
    { 
        path: '/login', 
        component: require('./view/Login.vue').default,
        meta:{
            layout: "empty",
        },
    },
];
var router=new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active',
    // exact: true
});
export default router;