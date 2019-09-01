<template>
    <div id="ticket">
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
                
            </table>
            <table class="table table-striped">
                <tr>
                    <td><b>Herramienta Reparada</b></td>
                    <td><b>Precio</b></td>
                </tr>
                <tr v-for="item in reparacion.detalles">
                    <td>
                        <b>{{ item.herramienta.nombre }}</b>
                        <p>
                            {{ item.diagnostico }}
                        </p>
                    </td>
                    <td>S/ {{ item.costo.toFixed(2) }}</td>
                </tr> 
                <tr>
                    <td> <b>Total</b> </td>
                    <td><b>S/ {{ total }}</b></td>
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
    computed: {
        total(){
            var total=0;
            for (let i = 0; i < this.reparacion.detalles.length; i++) {
                const element = this.reparacion.detalles[i];
                total+=element.costo;
            }
            return total.toFixed(2);
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