<template>
    <div class="login-container full-cover-background">
    <div class="form-container">
        <p class="text-center" style="margin-top: 17px;">
           <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
       </p>
       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">inicia sesión con tu cuenta</h4>
       
       <form id="form-login" v-on:submit.prevent="ingresar">
            <div class="group-material-login">
              <input v-model="validacion.usuario" type="text" class="material-login-control" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Nombres</label>
            </div><br>
            <div class="group-material-login">
              <input v-model="validacion.password" type="password" class="material-login-control" required="" maxlength="70">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
            </div>
            <div class="group-material">
                <select class="material-control-login">
                    <option value="" disabled="" selected="">Tipo de usuario</option>
                    <option value="Student">Secretaria</option>
                    <option value="Teacher">Tecnico</option>
                    <option value="Admin">Administrador</option>
                </select>
            </div>
            <button class="btn-login" type="submit">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
        </form>
    </div>   
  </div>
                
</template>
<script>
export default {
    data() {
        return {
            validacion:{
                usuario: null,
                password: null     
            }
        }
    },
    methods: {
        ingresar(){
            axios.post(api_url+'/login',this.validacion)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=="OK"){
                    cuenta=respuesta.data;
                    local.setItem('cuenta',JSON.stringify(respuesta.data));
                    this.$router.push({path: "/home"} );
                    $.notify({
                        message: 'Bienvenido a Gestión de Empresa' 
                    },{
                        placement: {
                            from: "botoon",
                            align: "right"
                        },
                        timer: 500,
                        type: 'info'
                    });
                }
                if (respuesta.status=="WARNING") {
                    swal({
                        title: respuesta.data,
                        icon: "warning",
                        timer: "4000"
                    });
                }
            });
        }
    },
}
</script>