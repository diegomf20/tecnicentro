<template>
        <div class="container-fluid">
            <div id="modal-nuevo" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="zmdi zmdi-account-box"></i> NUEVO CLIENTE<br>
                        </div>
                        <div class="modal-body">
                            <form id="form-nuevo" v-on:submit.prevent="guardar()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="dni" v-model="cliente.dni" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el DNI" required="" maxlength="8" v-on:keyup="consulta()">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>DNI</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="nombre" v-model="cliente.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del cliente" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del cliente"  >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="apellido" v-model="cliente.apellido" type="text" class="tooltips-general material-control" placeholder="Escribe aquí los apellidos " required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el apellido del cliente" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellidos</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="direccion" v-model="cliente.direccion" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el dirección " required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Direccion</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="numero" v-model="cliente.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;" :disabled="btn_bloquear"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
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
                            <i class="zmdi zmdi-account-box"></i> EDITAR cliente<br>
                        </div>
                        <div class="modal-body">
                            <form id="form-editar" v-on:submit.prevent="update()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="dni" v-model="cliente_edit.dni" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el DNI" required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>DNI</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="nombre" v-model="cliente_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del cliente" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del cliente">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="apellido" v-model="cliente_edit.apellido" type="text" class="tooltips-general material-control" placeholder="Escribe aquí los apellidos " required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el apellido del cliente">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Apellidos</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="direccion" v-model="cliente_edit.direccion" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el dirección " required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Direccion</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input name="numero" v-model="cliente_edit.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;" :disabled="btn_bloquear"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Lista de clientes</div>
                <div class="form-padding">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-primary" @click="abrir">Nuevo</button>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead style="background-color:#DFF0D8; font-weight:bold;">
                            <tr>
                                <th class="div-table-cell">DNI</th>
                                <th class="div-table-cell">Nombre</th>
                                <th class="div-table-cell">Apellido</th>
                                <th class="div-table-cell">Dirección</th>
                                <th class="div-table-cell">Número</th>
                                <th class="div-table-cell">Estado</th>
                                <th class="div-table-cell">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in clientes">
                                <td>{{ cliente.dni }}</td>
                                <td>{{ cliente.nombre }}</td>
                                <td>{{ cliente.apellido }}</td>
                                <td>{{ cliente.direccion }}</td>
                                <td>{{ cliente.numero }}</td>
                                <td>{{ (cliente.estado=="0")? 'Activo': 'Inactivo' }}</td>
                                <td class="text-center">
                                    <button @click="abrirEditar(cliente.id)" class="btn btn-link  btn-sm">
                                        <i class="zmdi zmdi-edit zmdi-hc-lg text-warning"></i>
                                    </button>
                                    <button @click="cambiarEstado(cliente.id)" v-if="cliente.estado=='0'" class="btn btn-link  btn-sm">
                                        <i class="zmdi zmdi-dot-circle zmdi-hc-lg text-success"></i>
                                    </button>
                                    <button @click="cambiarEstado(cliente.id)" v-else class="btn btn-link  btn-sm">
                                        <i class="zmdi zmdi-circle-o zmdi-hc-lg text-success"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            /**
             * Bloquear campo de nombre y apellidos
             */
            bloquear: true,

            cliente: {
                dni:"",
                nombre:"",
                apellido:"",
                direccion:"",
                numero:"",
            },
            cliente_edit: {
                dni:"",
                nombre:"",
                apellido:"",
                direccion:"",
                numero:"",
            },
            clientes:[]
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/cliente')
            .then(response=>{
                this.clientes=response.data;
            });
        },
        consulta(){
            if (this.cliente.dni.length==8) {
                    axios.get(api_url+'/cliente/consulta?&dni='+this.cliente.dni)
                    .then(response=>{
                        var resultado=response.data;
                        
                        if(resultado.length!=undefined){
                            // this.bloquear=false;                        
                            this.cliente.nombre="";
                            this.cliente.apellido="";
                        }else{
                            this.cliente.nombre=resultado.nombres;
                            this.cliente.apellido=resultado.apellidoPaterno+' '+resultado.apellidoMaterno;
                            // this.bloquear=true;                        
                        }
                    });
            }else{
                // this.bloquear=false;                        
                this.cliente.nombre="";
                this.cliente.apellido="";
            }
        },
        abrir(){
            $('#modal-nuevo').modal();
        },
        guardar(){
            this.btn_bloquear=true;
            axios.post(api_url+'/cliente',this.cliente)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.limpiarErrores();
                    this.clientes.push(respuesta.data);
                    this.cliente={
                        dni:"",
                        nombre:"",
                        apellido:"",
                        direccion:"",
                        numero:"",
                    };
                    swal({
                        title: "cliente Registrado",
                        icon: "success",
                        timer: "2000"
                    });
                    $('#modal-nuevo').modal('hide');
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
            axios.get(api_url+'/cliente/'+id)
            .then(response=>{
                this.cliente_edit=response.data;
            });
            $('#modal-editar').modal();
        },
        update(){
            this.btn_bloquear=true;
            axios.post(api_url+'/cliente/'+this.cliente_edit.id+'?_method=PUT',this.cliente_edit)
            .then(response=>{
                this.error_editar=null;
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.limpiarErrores();
                    this.listar();
                    $('#modal-editar').modal('hide');
                    swal({title: "cliente Actualizado",icon: "success",timer: "2000"});
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
            axios.post(api_url+'/cliente/'+id+'/estado')
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
                    $('#'+form+' [name='+indexName+']').focus().parents('div.group-material').addClass('has-error')
                        .append("<div class=text-center><span class=error>"+errores[indexName]+"</span></div>");
                    }else{
                        $('#'+form+' [name='+indexName+']').parents('div.group-material').addClass('has-error')
                        .append("<div class=text-center><span class=error>"+errores[indexName]+"</span></div>");
                }
            }
        },
        limpiarErrores() {
            $('.has-error span').remove();
            $('.has-error').removeClass("has-error");
        }
    },
}
    $('body').on('hidden.bs.modal', '#modal-editar, #modal-nuevo', function(event) {
        $('.has-error span').remove();
        $('.has-error').removeClass("has-error");
    })
</script>