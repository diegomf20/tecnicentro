<template>
    <div class="ticket" >
        <div class="text-center">
            <button class="oculto-impresion btn-success btn btn-sm" @click="imprimir()">Imprimir</button>
        </div>
        <p class="centrado">Tecnicentro
            <br>RUC: 12345678901
            <br>Augusto B. Leguia 1231
            <br>{{(reparacion.created_at) }}
            <br>
        </p>
        <p>
            Clt: {{ reparacion.cliente.nombre+ ' '+reparacion.cliente.apellido }}
        </p>
        <p>
            Serv: Reparación de su herramienta
        </p>

        <table>
            <thead>
                <tr>
                    <th class="producto">Herramienta Reparada</th>
                    <th class="precio">Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in reparacion.detalles">
                    <td class="producto">
                        <b>{{ item.herramienta.nombre }}</b>
                        <p>
                            {{ item.diagnostico }}
                        </p>
                    </td>
                    <td class="precio text-right">S/ {{ item.costo.toFixed(2) }}</td>
                </tr>
                <tr>
                    <td> <b>Total</b> </td>
                    <td class="text-right"><b>S/ {{ total }}</b></td>
                </tr> 
            </tbody>
        </table>
        <br>
        <p class="centrado">¡GRACIAS POR CONFIAR EN NOSOTROS!</p>
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