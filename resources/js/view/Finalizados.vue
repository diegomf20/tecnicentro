<template>
    <div class="container-fluid">
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Lista de Reparaciones Finalizadas</div>
            <div class="form-padding">
                <table class="table table-striped">
                    <thead style="background-color:#DFF0D8; font-weight:bold;">
                        <tr>
                            <th class="div-table-cell">Nombre y Apellidos</th>
                            <th class="div-table-cell">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="reparacion in reparaciones">
                            <td>{{ (reparacion.cliente!=null)?reparacion.cliente.nombre+' '+ reparacion.cliente.apellido:''}}</td>
                            <td>
                                <router-link :to="'/resumen/'+reparacion.id" class="btn btn-info">
                                    Ver
                                </router-link>
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
            reparaciones: [],
            cuenta: cuenta
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/reparacion?data=Finalizado')
            .then(response=>{
                this.reparaciones=response.data;
            });
        }
    },
}
</script>