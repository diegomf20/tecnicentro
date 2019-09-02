<template>
    <div class="container-fluid">
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Resumen de Reparación</div>
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
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-border-all"></i> &nbsp; Detalles de Herramientas ingresadas</legend>
                </div>
                <table class="table table-striped">
                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                        <tr>
                            <th class="div-table-cell">Herramienta</th>
                            <th class="div-table-cell">Serie</th>
                            <th class="div-table-cell">Diagnóstico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detalle in reparacion.detalles">
                            <td>{{ detalle.herramienta.nombre }}</td>
                            <td>{{ detalle.serie}}</td>
                            <td>
                                <router-link v-if="detalle.estado=='1'" class="btn-danger btn" :to="'/diagnostico/'+detalle.id">
                                    Diagnóstico
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-12" v-if="reparacion.diagnostico!=null">
                        <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Diagnostico</legend><br>
                        <table class="table-padding">
                            <tr>
                                <td><b>Tiempo de reparación (días):</b></td>
                                <td>{{ reparacion.diagnostico.dias }}</td>
                            </tr>
                            <tr>
                                <td><b>Costo:</b></td>
                                <td>{{ reparacion.diagnostico.costo }}</td>
                            </tr>
                            <tr>
                                <td><b>Descripcion:</b></td>
                                <td>{{ reparacion.diagnostico.descripcion }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- <div class="col-xs-12" v-if="piezas.length!=0">
                        <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Piezas</legend><br>
                        <table class="table-padding">
                           <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item) in piezas">
                                    <td>{{item.pieza.nombre}}</td>
                                    <td>{{item.cantidad}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            reparacion:null,
            piezas:null,
        }
    },
    mounted() {
        axios.get(api_url+'/reparacion/'+this.$route.params.id)
        .then(response=>{
            var respuesta=response.data;
            this.reparacion=respuesta.reparacion;
        });
    },
}
</script>