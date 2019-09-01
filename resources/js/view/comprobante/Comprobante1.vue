<template>
    <div id="ticket">
        <button class="btn btn-primary" @click="imprimir()">
            imprimir
        </button>
        <div class="form-padding">
            <table class="table table-striped">
                <tr>
                    <td><b>Fecha:</b></td>
                    <td>{{ reparacion.created_at }}</td>
                </tr>
                <tr>
                    <td><b>Cliente:</b></td>
                    <td>{{ reparacion.cliente.nombre+ ' '+reparacion.cliente.apellido }}</td>
                </tr>
                <tr>
                    <td><b>Servicio:</b></td>
                    <td>Diagnostico de su herramienta </td>
                </tr>
            </table>
            
            <table class="table table-striped">
                <tr>
                    <td><b>Herramienta</b></td>
                    <td><b>Serie</b></td>
                </tr>
                <tr v-for="item in reparacion.detalles">
                    <td>{{ item.herramienta.nombre }}</td>
                    <td>{{ item.serie }}</td>
                </tr>                
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            reparacion: null
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
        imprimir() {
            window.print();
        },
    },
}
</script>