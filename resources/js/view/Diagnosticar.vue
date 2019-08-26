<template>
    <div class="container-fluid">
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Diagnosticar</div>
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
                <br>
                <form v-on:submit.prevent="guardar()">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input v-model="diagnostico.dias" type="number" class="tooltips-general material-control" placeholder="Escribe aquí el DNI" required="" maxlength="50">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Tiempo de reparación (días)</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input v-model="diagnostico.costo" type="number" class="tooltips-general material-control" placeholder="Escribe aquí el DNI" required="" maxlength="50">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Costo</label>
                            </div>
                        </div>
                        <div class="col-sm-8 form-group">
                            <label for="">Descripción</label>
                            <textarea v-model="diagnostico.descripcion" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            reparacion:null,
            diagnostico: {
                descripcion:null,
                dias: 1,
                costo: 0
            }
        }
    },
    mounted() {
        axios.get(api_url+'/reparacion/'+this.$route.params.id)
        .then(response=>{
            this.reparacion=response.data;
        });
    },
    methods: {
        guardar(){
            axios.post(api_url+'/reparacion/'+this.$route.params.id+'/diagnosticar',this.diagnostico)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    this.diagnostico={
                        descripcion:null,
                        dias: 1,
                        costo: 0,
                    };
                    swal({
                        title: "Diagnosticado",
                        icon: "success",
                        timer: "2000"
                    });
                    this.$router.push({path: "/reparaciones"} );
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        }
    },
}
</script>