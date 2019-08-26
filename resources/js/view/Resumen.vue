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
                    <tr>
                        <td><b>Herramienta:</b></td>
                        <td>{{ reparacion.herramienta.nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Modelo:</b></td>
                        <td>{{ reparacion.modelo }}</td>
                    </tr>
                    <tr>
                        <td><b>Serie:</b></td>
                        <td>{{ reparacion.serie }}</td>
                    </tr>
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
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            reparacion:null
        }
    },
    mounted() {
        axios.get(api_url+'/reparacion/'+this.$route.params.id)
        .then(response=>{
            this.reparacion=response.data;
        });
    },
}
</script>