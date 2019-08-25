<template>
        <div class="container-fluid">
            <div id="modal-nuevo" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="zmdi zmdi-account-box"></i> NUEVO PROVEEDOR<br>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="guardar()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor.ruc" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el RUC" required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>RUC</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del proveedor" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del proveedor">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor.email" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el email" required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>email</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
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
                            <i class="zmdi zmdi-account-box"></i> EDITAR PROVEEDOR<br>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="update()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor_edit.ruc" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el RUC" required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>RUC</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre del proveedor" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del proveedor">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor_edit.email" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el email " required="" maxlength="50">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>email</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="group-material">
                                            <input v-model="proveedor_edit.numero" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Número" required="" maxlength="20" >
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Número</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Lista de proveedores</div>
                    <div class="form-padding">
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <button class="btn btn-primary" @click="abrir">Nuevo</button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead style="background-color:#DFF0D8; font-weight:bold;">
                                <tr>
                                    <th class="div-table-cell">RUC</th>
                                    <th class="div-table-cell">Nombre</th>
                                    <th class="div-table-cell">Email</th>
                                    <th class="div-table-cell">Número</th>
                                    <th class="div-table-cell">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="proveedor in proveedors">
                                    <td>{{ proveedor.ruc }}</td>
                                    <td>{{ proveedor.nombre }}</td>
                                    <td>{{ proveedor.email }}</td>
                                    <td>{{ proveedor.numero }}</td>
                                    <td>
                                        <button @click="abrirEditar(proveedor.id)" class="btn btn-success">
                                            Editar
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
            proveedor: {
                ruc:"",
                nombre:"",
                email:"",
                numero:"",
            },
            proveedor_edit: {
                ruc:"",
                nombre:"",
                email:"",
                numero:""
            },
            proveedors:[]
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/proveedor')
            .then(response=>{
                this.proveedors=response.data;
            });
        },
        abrir(){
            $('#modal-nuevo').modal();
        },
        guardar(){
            axios.post(api_url+'/proveedor',this.proveedor)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.limpiarErrores();
                    this.proveedors.push(respuesta.data);
                    this.proveedor={
                        ruc:"",
                        nombre:"",
                        email:"",
                        numero:"",
                    };
                    swal({
                        title: "proveedor Registrado",
                        icon: "success",
                        timer: "2000"
                    });
                }
                if(respuesta.status=='VALIDATION'){
                    this.mostrarErrores('form-nuevo', respuesta.data);
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        },
        abrirEditar(id){
            axios.get(api_url+'/proveedor/'+id)
            .then(response=>{
                this.proveedor_edit=response.data;
            });
            $('#modal-editar').modal();
        },
        update(){
            axios.post(api_url+'/proveedor/'+this.proveedor_edit.id+'?_method=PUT',this.proveedor_edit)
            .then(response=>{
                this.error_editar=null;
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.limpiarErrores();
                    this.listar();
                    $('#modal-editar').modal('hide');
                    swal({title: "proveedor Actualizado",icon: "success",timer: "2000"});
                }
                if (respuesta.status=="VALIDATION") {
                    this.mostrarErrores('form-editar', respuesta.data)
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        },
        cambiarEstado(id){
            axios.post(api_url+'/proveedor/'+id+'/estado')
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