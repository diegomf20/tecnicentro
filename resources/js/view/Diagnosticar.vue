<template>
    <div class="container-fluid">
        <div id="modal-diagnosticar" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="zmdi zmdi-account-box"></i> Diagnosticar Herramienta<br>
                    </div>
                    <div class="modal-body" v-if="detalle_seleccionado!=null">
                        <!-- <form v-on:submit.prevent="update()" class="form-padding">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="group-material">
                                        <input v-model="herramienta_edit.nombre" type="text" class="tooltips-general material-control" placeholder="Escribe aquí nombre de la herramienta" required="" maxlength="5" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del herramienta">
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
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Diagnosticar</div>
            <div class="form-padding">
                <table class="table-padding">
                    <tr>
                        <td><b>Fecha de Ingreso:</b></td>
                        <td>{{ reparacion.created_at }}</td>
                    </tr>
                    <tr>
                        <td><b>Cliente:</b></td>
                        <td>{{ reparacion.cliente.nombre+ ' '+reparacion.cliente.apellido }}</td>
                    </tr>
                </table>
                <br>
                <table class="table table-striped">
                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                        <tr>
                            <th class="div-table-cell">Herramienta</th>
                            <th class="div-table-cell">Serie</th>
                            <th class="div-table-cell">Diagnóstico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(detalle,index) in reparacion.detalles">
                            <td>{{ detalle.herramienta.nombre }}</td>
                            <td>{{ detalle.serie}}</td>
                            <td>
                                <!-- {{detalle.estado}} -->
                                <div v-if="detalle.estado=='0'">
                                    <router-link class="btn btn-danger"  :to="'/diagnosticar-herramienta/'+detalle.id">
                                        Diagnosticar
                                    </router-link>
                                </div>
                                <div v-if="detalle.estado=='1'">
                                    Diagnósticado
                                </div>
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
            reparacion:null,
            detalle_seleccionado: null,
        }
    },
    mounted() {
        axios.get(api_url+'/reparacion/'+this.$route.params.id)
        .then(response=>{
            var respuesta=response.data;
            this.reparacion=respuesta.reparacion;
            this.piezas=respuesta.piezas;
            // this.reparacion=response.data;
        });

         
    },
    methods: {
        
    },
}
</script>