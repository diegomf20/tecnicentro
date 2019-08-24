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
        path: '/usuario', 
        component: require('./view/contactos/Usuario.vue').default,
        beforeEnter: auth
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
    exact: true
});
export default router;