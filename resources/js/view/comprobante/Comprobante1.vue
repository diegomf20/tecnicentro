<template>
    <div class="ticket">
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
            Serv: Diagnostico de su herramienta
        </p>

        <table width="100%">
            <thead>
                <tr>
                    <th >Herramienta</th>
                    <th >Serie</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in reparacion.detalles">
                    <td>{{ item.herramienta.nombre }}</td>
                    <td>{{ item.serie }}</td>
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