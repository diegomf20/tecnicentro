<template>
    <div>
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                    <img src="assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles">{{cuenta.nombre}} - {{ cuenta.rol }}</span>
                </li>
                <li @click="exit()" class="tooltips-general exit-system-button" data-href="index.html" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
                <li class="desktop-menu-button hidden-xs" style="float: left !important;">
                    <i class="zmdi zmdi-swap"></i>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="all-tittles">Sistema De Reparacion - Herramientas Electricas</h1>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cuenta: cuenta
        }
    },
    methods: {
        exit(){
            var t=this;
            swal({
                title: "¿Estás seguro?",
                text: "Quieres salir del sistema y cerrar la sesión actual",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Si, salir",
                cancelButtonText: "No, cancelar",
                animation: "slide-from-top",
                closeOnConfirm: false 
            },function(){
                cuenta=null;
                local.removeItem('cuenta');
                t.$router.push({path: "/login"} );
            });
        }
    },
}
</script>