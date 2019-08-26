<template>
    <div>
        <table class="table table-striped">
            <thead style="background-color:#DFF0D8; font-weight:bold;">
                <tr>
                    <th class="div-table-cell">Nombre y Apellidos</th>
                    <th class="div-table-cell">Herramienta</th>
                    <th class="div-table-cell">Modelo</th>
                    <th class="div-table-cell">Serie</th>
                    <th class="div-table-cell">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="reparacion in reparaciones">
                    <td>{{ (reparacion.cliente!=null)?reparacion.cliente.nombre+' '+ reparacion.cliente.apellido:''}}</td>
                    <td>{{ reparacion.herramienta.nombre}}</td>
                    <td>{{ reparacion.modelo}}</td>
                    <td>{{ reparacion.serie}}</td>
                    <td>
                        <router-link :to="'/resumen/'+reparacion.id" class="btn btn-info">
                            Ver
                        </router-link>
                        <router-link :to="'/diagnosticar/'+reparacion.id" v-if="reparacion.estado=='0'&&cuenta.rol=='Tecnico'" class="btn btn-warning">
                            Diagnosticar
                        </router-link>
                        <a @click="aprobar(reparacion.id)" v-if="reparacion.estado=='1'&&cuenta.rol!='Tecnico'" class="btn btn-warning">
                            Aprobar Reparación
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
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
            axios.get(api_url+'/reparacion')
            .then(response=>{
                this.reparaciones=response.data;
            });
        },
        aprobar(id){
            var t=this;
            swal({
                title: "Aprobar",
                text: "¿Estás seguro de Aprobar Reparación?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                animation: "slide-from-top",
                closeOnConfirm: false 
            },function(){ 
                axios.post(api_url+'/reparacion/'+id+'/aprobar')
                .then(response=>{
                    var respuesta=response.data;
                    if(respuesta.status=='OK'){
                        t.listar();
                        swal({
                            title: "Aprobado para Reparación",
                            icon: "success",
                            timer: "2000"
                        });
                    }
                });
            });
        }
    },
}
</script>