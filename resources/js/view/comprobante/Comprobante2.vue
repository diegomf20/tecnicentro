<template>
    <div class="form-padding">
        <button class="btn btn-primary" @click="imprimir()">
            imprimir
        </button>
        <div class="form-padding">
            <table class="table table-striped">
                <tr>
                    <td><b>Fecha:</b></td>
                    <td>{{ reparacion.updated_at }}</td>
                </tr>
                <tr>
                    <td><b>Cliente:</b></td>
                    <td>{{ reparacion.cliente.nombre+ ' '+reparacion.cliente.apellido }}</td>
                </tr>
                <tr>
                    <td><b>Servicio:</b></td>
                    <td>Reparación de su herramienta </td>
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
                <tr style="height: 8px;">
                    <td> </td>
                    <td> </td>
                </tr> 
                <tr>
                    <td colspan="2">
                      <b> Piezas a usar en la reparación </b>
                    </td>
                </tr>             
                <tr>
                    <td> <b>Pieza</b> </td>
                    <td><b>Cantidad</b></td>
                </tr>
                <tr v-for="(item) in piezas">
                    <td>{{item.pieza.nombre}}</td>
                    <td>{{item.cantidad}}</td>
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