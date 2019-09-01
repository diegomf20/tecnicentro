<template>
    <div class="container-fluid">
        <div class="modal fade" id="modal-documento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <iframe :src="url" frameborder="0" width="300" height="500"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Lista de Reparaciones Pendientes</div>
            <div class="form-padding">
                <table class="table table-striped">
                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                        <tr>
                            <th class="div-table-cell">Código</th>
                            <th class="div-table-cell">Nombre y Apellidos</th>
                            <th class="div-table-cell">Estado</th>
                            <th class="div-table-cell">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="reparacion in reparaciones">
                            <td>{{ reparacion.codigo }}</td>
                            <td>{{ (reparacion.cliente!=null)?reparacion.cliente.nombre+' '+ reparacion.cliente.apellido:''}}</td>
                            <td>{{ stringEstado(reparacion.estado)}}</td>
                            <td>
                                <router-link :to="'/resumen/'+reparacion.id" class="btn btn-info">
                                    Ver
                                </router-link>
                                <router-link :to="'/diagnosticar/'+reparacion.id" v-if="reparacion.estado=='0'&&cuenta.rol=='Tecnico'" class="btn btn-warning">
                                    Diagnosticar
                                </router-link>
                                <a @click="aprobar(reparacion.id)" v-if="reparacion.estado=='1'&&cuenta.rol!='Tecnico'" class="btn btn-warning">
                                    Aprobar Reparación
                                </a>
                                <a @click="reparar(reparacion.id)" v-if="reparacion.estado=='2'&&cuenta.rol=='Tecnico'" class="btn btn-warning">
                                    Finalizar Reparación
                                </a>
                                <a @click="cobrar(reparacion.id)" v-if="reparacion.estado=='3'&&cuenta.rol!='Tecnico'" class="btn btn-warning">
                                    Cobrar
                                </a>
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
            reparaciones: [],
            cuenta: cuenta,
            url:''
        }
    },
    mounted() {
        this.listar();
    },
    computed: {
        
    },
    methods: {
        stringEstado(est){
            var estado="";
            switch (est) {
                case '0':
                    estado="Ingresado";
                    break;
                case '1':
                    estado="Diagnosticado";
                    break;
                case '2':
                    estado="Aprobado";
                    break;
                case '3':
                    estado="Reparado";
                    break;
                case '4':
                    estado="Finalizado";
                    break;
                default:
                    break;
            }
            return estado;
        },
        listar(){
            axios.get(api_url+'/reparacion')
            .then(response=>{
                this.reparaciones=response.data;
            });
        },
        aprobar(id){
            var t=this;
            swal({
                title: "Aprobar",
                text: "¿Estás seguro de Aprobar Reparación?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                animation: "slide-from-top",
                closeOnConfirm: false 
            },function(){ 
                axios.post(api_url+'/reparacion/'+id+'/aprobar')
                .then(response=>{
                    var respuesta=response.data;
                    if(respuesta.status=='OK'){
                        t.listar();
                        $('#modal-documento').modal();
                        t.url="comprobante2/"+id;
                        swal({
                            title: "Aprobado para Reparación",
                            icon: "success",
                            timer: "2000"
                        });
                    }
                });
            });
        },
        reparar(id){
            var t=this;
            swal({
                title: "Reparar",
                text: "¿Estás seguro de Finalizar Reparación?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                animation: "slide-from-top",
                closeOnConfirm: false 
            },function(){ 
                axios.post(api_url+'/reparacion/'+id+'/reparar')
                .then(response=>{
                    var respuesta=response.data;
                    if(respuesta.status=='OK'){
                        t.listar();
                        swal({
                            title: "Reparación Terminada",
                            icon: "success",
                            timer: "2000"
                        });
                    }
                });
            });
        },
        cobrar(id){
            var t=this;
            swal({
                title: "Cobrar",
                text: "Cobrar por servicio",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                animation: "slide-from-top",
                closeOnConfirm: false 
            },function(){ 
                axios.post(api_url+'/reparacion/'+id+'/cobrar')
                .then(response=>{
                    var respuesta=response.data;
                    if(respuesta.status=='OK'){
                        $('#modal-documento').modal();
                        t.url="comprobante3/"+id;
                        t.listar();
                        swal({
                            title: "Cobro realizado",
                            icon: "success",
                            timer: "2000"
                        });
                    }
                });
            });
        },
    },
}
</script>