<template>
        <div class="container-fluid">
            <div id="modal-editar" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="zmdi zmdi-account-box"></i> EDITAR PIEZA<br>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="update()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="group-material">
                                            <input v-model="pieza_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre de la pieza" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del pieza">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
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
            <div class="row">
                <div class="col-sm-5">
                    <div class="container-flat-form">
                        <div class="title-flat-form title-flat-blue">Nueva pieza</div>
                        <form v-on:submit.prevent="guardar()" class="form-padding">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="group-material">
                                        <input v-model="pieza.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre de la pieza" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del pieza">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nombre</label>
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
                <div class="col-sm-7">
                    <div class="container-flat-form">
                        <div class="title-flat-form title-flat-blue">Lista de piezas</div>
                            <div class="form-padding">
                                <table class="table table-striped">
                                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                                        <tr>
                                            <th class="div-table-cell">Codigo</th>
                                            <th class="div-table-cell">Nombre</th>
                                            <th class="div-table-cell">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="pieza in piezas">
                                            <td>{{ pieza.codigo }}</td>
                                            <td>{{ pieza.nombre }}</td>
                                            <td>
                                                <button @click="abrirEditar(pieza.id)" class="btn btn-success">
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
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            pieza: {
                nombre:"",
            },
            pieza_edit: {
                nombre:"",
            },
            piezas:[]
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/pieza')
            .then(response=>{
                this.piezas=response.data;
            });
        },
        abrir(){
            $('#modal-nuevo').modal();
        },
        guardar(){
            axios.post(api_url+'/pieza',this.pieza)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.limpiarErrores();
                    this.piezas.push(respuesta.data);
                    this.pieza={
                        nombre:"",
                    };
                    swal({
                        title: "pieza Registrada",
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
            axios.get(api_url+'/pieza/'+id)
            .then(response=>{
                this.pieza_edit=response.data;
            });
            $('#modal-editar').modal();
        },
        update(){
            axios.post(api_url+'/pieza/'+this.pieza_edit.id+'?_method=PUT',this.pieza_edit)
            .then(response=>{
                this.error_editar=null;
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.limpiarErrores();
                    this.listar();
                    $('#modal-editar').modal('hide');
                    swal({title: "pieza Actualizada",icon: "success",timer: "2000"});
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
            axios.post(api_url+'/pieza/'+id+'/estado')
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