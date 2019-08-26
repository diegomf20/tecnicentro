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
                    <!-- </div> -->
                        <div  class="col-sm-8">
                            <div class="form-padding" >
                                <h4><b> ITEMS PARA REPARACION</b></h4>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="">Seleccionar Pieza</label>
                                        <v-select v-model="itemMomentaneo.pieza" :options="piezas"></v-select>
                                    </div>
                                    <div class="col-md-3 col-lg-2 form-group">
                                        <label for="">Cantidad</label>
                                        <input v-model="itemMomentaneo.cantidad" type="number" class="form-control" min="1">
                                    </div>
                                    <div class="col-md-3 col-lg-2 form-group text-center">
                                        <label for="">.</label>
                                        <a @click="agregarItem()" class="btn btn-info">Agregar Item</a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Quitar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,index) in diagnostico.items">
                                                <td>{{ item.nombre}}</td>
                                                <td>
                                                    <input type="number" class="form-control" v-model="item.cantidad">                                    
                                                </td>
                                                <td>
                                                    <button @click="eliminarItem(index)" type="button" class="btn btn-danger btn-link btn-sm">
                                                        <i class="zmdi zmdi zmdi-delete zmdi-hc-fw"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr v-if="diagnostico.items.length==0">
                                                <td class="text-center" colspan="6">Sin Items de compra</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 form-group " >
                            <label for="">Descripción</label>
                            <textarea v-model="diagnostico.descripcion" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <button :disabled="btn_bloquear" type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>                        
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
            /**
             * bloquear el btn guardar
             */
            btn_bloquear:false,

            reparacion:null,
            diagnostico: {
                descripcion:null,
                dias: 1,
                costo: 0,
                 items: [],
            },

            piezas: [],
            
            itemMomentaneo:{
                pieza: null,
                cantidad: 1,
            }
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

         axios.get(api_url+'/pieza')
        .then(response=>{
            for (let i = 0; i < response.data.length; i++) {
                var pieza = response.data[i];
                this.piezas.push({
                    label: pieza.codigo+" - "+pieza.nombre,
                    codigo: pieza.codigo,
                    nombre: pieza.nombre,
                    id: pieza.id
                });
            }
        });
    },
    methods: {
        guardar(){
             this.btn_bloquear=
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
                 this.btn_bloquear=false;
            });
        },
        eliminarItem(index){
            this.diagnostico.items.splice(index, 1);
        },
        agregarItem(){
            this.diagnostico.items.push({
                pieza_id: this.itemMomentaneo.pieza.id,
                codigo: this.itemMomentaneo.pieza.codigo,
                nombre: this.itemMomentaneo.pieza.nombre,
                cantidad: this.itemMomentaneo.cantidad,
            });
            this.itemMomentaneo={
                pieza: null,
                cantidad: 1,
            };
        },
    },
}
</script>