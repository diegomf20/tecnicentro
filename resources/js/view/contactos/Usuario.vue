<template>
        <div class="container-fluid">
            <div id="modal-nuevo" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <!-- <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4> -->
                            <i class="zmdi zmdi-account-box"></i> NUEVO USUARIO<br>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="guardar()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del usuario" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del usuario">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario.apellido" type="text" class="tooltips-general material-control" placeholder="Escribe aquí los apellidos " required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el apellido del usuario">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellidos</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario.usuario" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el usuario " required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el usuario">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario.password" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el password " required="" maxlength="20">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <select v-model="usuario.rol" class="form-control">
                                            <option value="Administrador">Administrador</option>
                                            <option value="Secretaria">Secretaria</option>
                                            <option value="Tecnico">Tecnico</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button :disabled="btn_bloquear" type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modal-editar" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="zmdi zmdi-account-box"></i> NUEVO USUARIO<br>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="update()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del usuario" required="" maxlength="70"> 
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario_edit.apellido" type="text" class="tooltips-general material-control" placeholder="Escribe aquí los apellidos " required="" maxlength="70">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellidos</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario_edit.usuario" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el usuario " required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario_edit.password" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el password " required="" maxlength="20">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="usuario_edit.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <select v-model="usuario_edit.rol" class="form-control">
                                            <option value="Administrador">Administrador</option>
                                            <option value="Secretaria">Secretaria</option>
                                            <option value="Tecnico">Tecnico</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button :disabled="btn_bloquear" type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Lista de Usuarios</div>
                    <div class="form-padding">
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <button class="btn btn-primary" @click="abrir">Nuevo</button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead style="background-color:#DFF0D8; font-weight:bold;">
                                <tr>
                                    <th class="div-table-cell">Nombre</th>
                                    <th class="div-table-cell">Apellido</th>
                                    <th class="div-table-cell">Usuario</th>
                                    <th class="div-table-cell">Número</th>
                                    <th class="div-table-cell">Rol</th>
                                    <th class="div-table-cell">Estado</th>
                                    <th class="div-table-cell">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in usuarios">
                                    <td>{{ user.nombre }}</td>
                                    <td>{{ user.apellido }}</td>
                                    <td>{{ user.usuario }}</td>
                                    <td>{{ user.numero }}</td>
                                    <td>{{ user.rol }}</td>
                                    <td>{{ (user.estado=="0")? 'Activo': 'Inactivo' }}</td>
                                    <td>
                                        <button @click="abrirEditar(user.id)" class="btn btn-link  btn-sm">
                                            <i class="zmdi zmdi-edit zmdi-hc-lg text-warning"></i>
                                        </button>
                                        <button @click="cambiarEstado(user.id)" v-if="user.estado=='0'" class="btn btn-link  btn-sm">
                                            <i class="zmdi zmdi-dot-circle zmdi-hc-lg text-success"></i>
                                        </button>
                                        <button @click="cambiarEstado(user.id)" v-else class="btn btn-link  btn-sm">
                                            <i class="zmdi zmdi-circle-o zmdi-hc-lg text-success"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            /**
             * bloquear el btn guardar
             */
            btn_bloquear:false,

            usuario: {
                nombre:"",
                apellido:"",
                usuario:"",
                password:"",
                numero:"",
                rol:"",
            },
            usuario_edit: {
                nombre:"",
                apellido:"",
                usuario:"",
                password:"",
                numero:"",
                rol:"",
            },
            usuarios:[]
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/user')
            .then(response=>{
                this.usuarios=response.data;
            });
        },
        abrir(){
            $('#modal-nuevo').modal();
        },
        guardar(){
            this.btn_bloquear=true;
            axios.post(api_url+'/user',this.usuario)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.limpiarErrores();
                    this.usuarios.push(respuesta.data);
                    this.usuario={
                        dni:"",
                        nombre:"",
                        apellido:"",
                        numero:"",
                        email:"",
                        rol:"",
                        password:"",
                    };
                    swal({
                        title: "Usuario Registrado",
                        icon: "success",
                        timer: "2000"
                    });
                    $('#modal-nuevo').modal('hide')
                }
                if(respuesta.status=='VALIDATION'){
                    this.mostrarErrores('form-nuevo', respuesta.data);
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
                this.btn_bloquear=false;
            });
        },
        abrirEditar(id){
            axios.get(api_url+'/user/'+id)
            .then(response=>{
                this.usuario_edit=response.data;
            });
            $('#modal-editar').modal();
        },
        update(){
            this.btn_bloquear=true;
            axios.post(api_url+'/user/'+this.usuario_edit.id+'?_method=PUT',this.usuario_edit)
            .then(response=>{
                this.error_editar=null;
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.limpiarErrores();
                    this.listar();
                    $('#modal-editar').modal('hide');
                    swal({title: "Usuario Actualizado",icon: "success",timer: "2000"});
                }
                if (respuesta.status=="VALIDATION") {
                    this.mostrarErrores('form-editar', respuesta.data)
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
                this.btn_bloquear=false;
            });
        },
        cambiarEstado(id){
            axios.post(api_url+'/user/'+id+'/estado')
            .then(response=>{
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.listar();
                    swal({title: respuesta.data,icon: "success",timer: "2000"});
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        },
        mostrarErrores(form, error){
            var errores=error;
            $('.has-error span').remove();
            var arrKeys=Object.keys(errores);
            for (let index = 0; index < arrKeys.length; index++) {
                var indexName=arrKeys[index];
                if(index==0){
                    $('#'+form+' [name='+indexName+']').focus().parents('div.form-group').addClass('has-error')
                        .append("<div class=text-center><span>"+errores[indexName]+"</span></div>");
                    }else{
                        $('#'+form+' [name='+indexName+']').parents('div.form-group').addClass('has-error')
                        .append("<div class=text-center><span>"+errores[indexName]+"</span></div>");
                }
            }
        },
        limpiarErrores() {
            $('.has-error span').remove();
        }
    },
}
</script>