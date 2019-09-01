<template>
    <div class="container-fluid">
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Resumen de Diagnóstico</div>
            <div class="form-padding">
                <table class="table-padding">
                    <tr>
                        <td><b>Herramienta:</b></td>
                        <td>{{ reparacion_herramienta.herramienta.nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Serie:</b></td>
                        <td>{{ reparacion_herramienta.serie }}</td>
                    </tr>
                    <tr>
                        <td><b>Días en reparar:</b></td>
                        <td>{{ reparacion_herramienta.dias }}</td>
                    </tr>
                    <tr>
                        <td><b>Precio de Reparación:</b></td>
                        <td>S/ {{ reparacion_herramienta.costo.toFixed(2) }}</td>
                    </tr>
                    <tr>
                        <td><b>Diagnóstico:</b></td>
                        <td>{{ reparacion_herramienta.diagnostico }}</td>
                    </tr>
                </table>
                <br>
                <legend><i class="zmdi zmdi-border-all"></i> &nbsp; Accesorios a Cambiar</legend>
                <table class="table table-striped">
                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                        <tr>
                            <th class="div-table-cell">Nombre de Accesorio</th>
                            <th class="div-table-cell">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detalle in reparacion_herramienta.detalles">
                            <td>{{ detalle.accesorio.nombre }}</td>
                            <td>{{ detalle.cantidad }}</td>
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
            reparacion_herramienta:null
        }
    },
     mounted() {
        axios.get(api_url+'/reparacion-herramienta/'+this.$route.params.id)
        .then(response=>{
            this.reparacion_herramienta=response.data;
        });
    },
}
</script>