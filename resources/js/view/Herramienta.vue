<template>
        <div class="container-fluid">
            <div id="modal-editar" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="zmdi zmdi-account-box"></i> EDITAR HERRAMIENTA<br>
                        </div>
                        <div class="modal-body">
                            <form id="form-editar" v-on:submit.prevent="update()" class="form-padding">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="group-material">
                                            <input name="nombre" v-model="herramienta_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre de la herramienta" required="" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del herramienta">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>
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
            <div class="row">
                <div class="col-sm-5">
                    <div class="container-flat-form">
                        <div class="title-flat-form title-flat-blue">Nueva herramienta</div>
                        <form id="form-nuevo" v-on:submit.prevent="guardar()" class="form-padding">
                            <div class="row">
                                <br>
                                <div class="col-xs-12">
                                    <div class="group-material">
                                        <input name="nombre" v-model="herramienta.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre de la herramienta" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del herramienta">
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
                            <div class="title-flat-form title-flat-blue">Lista de herramientas</div>
                            <div class="form-padding">
                                <table class="table table-striped">
                                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                                        <tr>
                                            <th class="div-table-cell">Codigo</th>
                                            <th class="div-table-cell">Nombre</th>
                                            <th class="div-table-cell">Estado</th>
                                            <th class="div-table-cell">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="herramienta in herramientas">
                                            <td>{{ herramienta.codigo }}</td>
                                            <td>{{ herramienta.nombre }}</td>
                                            <td>{{ (herramienta.estado=="0")? 'Activo': 'Inactivo' }}</td>
                                            <td class="text-center">
                                                <button @click="abrirEditar(herramienta.id)" class="btn btn-link  btn-sm">
                                                    <i class="zmdi zmdi-edit zmdi-hc-lg text-warning"></i>
                                                </button>
                                                <button @click="cambiarEstado(herramienta.id)" v-if="herramienta.estado=='0'" class="btn btn-link  btn-sm">
                                                    <i class="zmdi zmdi-dot-circle zmdi-hc-lg text-success"></i>
                                                </button>
                                                <button @click="cambiarEstado(herramienta.id)" v-else class="btn btn-link  btn-sm">
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

            herramienta: {
                nombre:"",
            },
            herramienta_edit: {
                nombre:"",
            },
            herramientas:[]
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/herramienta')
            .then(response=>{
                this.herramientas=response.data;
            });
        },
        abrir(){
            $('#modal-nuevo').modal();
        },
        guardar(){
             this.btn_bloquear=true;
            axios.post(api_url+'/herramienta',this.herramienta)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.limpiarErrores();
                    this.herramientas.push(respuesta.data);
                    this.herramienta={
                        nombre:"",
                    };
                    swal({
                        title: "Herramienta Registrada",
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
                 this.btn_bloquear=false;
            });
        },
        abrirEditar(id){
            axios.get(api_url+'/herramienta/'+id)
            .then(response=>{
                this.herramienta_edit=response.data;
            });
            $('#modal-editar').modal();
        },
        update(){
             this.btn_bloquear=true;
            axios.post(api_url+'/herramienta/'+this.herramienta_edit.id+'?_method=PUT',this.herramienta_edit)
            .then(response=>{
                this.error_editar=null;
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.limpiarErrores();
                    this.listar();
                    $('#modal-editar').modal('hide');
                    swal({title: "Herramienta Actualizada",icon: "success",timer: "2000"});
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
            axios.post(api_url+'/herramienta/'+id+'/estado')
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

    $('body').on('hidden.bs.modal', '#modal-editar', function(event) {
        $('.has-error span').remove();
        $('.has-error').removeClass("has-error");
    })
</script>