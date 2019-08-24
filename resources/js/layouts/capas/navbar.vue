<template>
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand"></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
            
            <li class="nav-item dropdown">
                <a @click="actualizarNotificaciones()" class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">notifications</i>
                    <span class="notification" v-if="conteoSinLeer!=0">{{ conteoSinLeer }}</span>
                    <p class="d-lg-none d-md-block">
                        Some Actions
                    </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <div v-for="notificacion in notificaciones">
                        <router-link v-if="notificacion.tipo=='Stock'"  to="reorden"  class="dropdown-item">
                            {{ notificacion.descripcion }}
                        </router-link>
                        <router-link v-else-if="notificacion.tipo=='Vencimiento'"  to="lote"  class="dropdown-item">
                            {{ notificacion.descripcion }}
                        </router-link>
                    </div>
                    <div class="dropdown-divider"></div>
                    <router-link class="dropdown-item text-center" to="notificacion">
                        Ver más
                    </router-link>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ cuenta.nombre }}
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                        Account
                    </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                <!-- <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a> -->
                <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" @click="salir()">Log out</a>
                    <router-link tag="li" class="nav-item"  to="/contraseña_cambiar">
                        <a class="dropdown-item" >Cambiar contraseña</a>
                    </router-link>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            cuenta: cuenta,
            notificaciones: []
        }
    },
    computed: {
        conteoSinLeer(){
            var conteo=0
            for (let i = 0; i < this.notificaciones.length; i++) {
                const notificacion = this.notificaciones[i];
                if (notificacion.estado==0) {
                    conteo++;
                }
            }
            return conteo;
        }
    },
    mounted() {
        this.listarNotificaciones();
        var t=this;
        comun.$on('Notificacion', function (value) {
            t.listarNotificaciones();
        })
    },
    methods: {
        actualizarNotificaciones(){
            axios.post(api_url+'/notificacion?api_token='+cuenta.token)
            .then(response=>{
                this.listarNotificaciones();
            });
        },
        listarNotificaciones(){
            axios.get(api_url+'/notificacion?api_token='+cuenta.token)
            .then(response=>{
                this.notificaciones=response.data;
            });
        },
        salir(){
            var t=this;
            local.removeItem('cuenta');
            if(local.getItem('push')!==null){
                var token=local.getItem('push');
                local.removeItem('push');
                $.ajax({        
                    type : 'POST',
                    url : "https://iid.googleapis.com/iid/v1:batchRemove",
                    headers : {Authorization : 'key=AIzaSyCUpg8GjUxs56rQyDCO_yEu46Vmbxfpapg'},
                    contentType : 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({"to": "/topics/conoceatuconductor", "registration_tokens": [token]}),
                    success : function(response) {
                        local.removeItem('push');
                        t.$router.push({ path: '/login' }); 
                    }
                });
                navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for(let registration of registrations) {
                registration.unregister()
                } })
                Notification.permissions = 'default';
            }else{
                this.$router.push({ path: '/login' }); 
            }
        }
    },
}
</script>

