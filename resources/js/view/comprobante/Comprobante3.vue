<template>
    <div>
        <button @click="imprimir()">
            imprimir
        </button>
        Aqui va el comprobante de Cobranza
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
            this.reparacion=response.data;
        });
    },
    methods: {
        imprimir() {
            window.print();
        },
    },
}
</script>