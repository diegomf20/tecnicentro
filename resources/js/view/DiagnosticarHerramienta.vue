<template>
    <div class="container-fluid">
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Herramienta a Diagnosticar</div>
            <div class="form-padding">
                <table class="table-padding">
                    <tr>
                        <td><b>Herramienta:</b></td>
                        <td>{{ detalle_seleccionado.herramienta.nombre }}</td>
                    </tr>
                    <tr>
                        <td><b>Serie:</b></td>
                        <td>{{ detalle_seleccionado.serie }}</td>
                    </tr>
                </table>
                <br>
                <form class="row">
                    
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>Descripción de diagnóstico</label>
                        <textarea v-model="detalle_seleccionado.diagnostico" class="form-control"></textarea>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="group-material">
                            <input v-model="detalle_seleccionado.costo" type="number" class="tooltips-general material-control" placeholder="Escribe aquí el Precio" required="" maxlength="5"  step="any">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Precio del Servicio:</label>
                        </div>
                    </div>
                    <div class="col-xs-6  col-sm-3">
                        <div class="group-material">
                            <input v-model="detalle_seleccionado.dias" type="number" class="tooltips-general material-control" placeholder="Escribe el Tiempo (Días)" required="" step="any">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Días:</label>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12">
                        <legend><i class="zmdi zmdi-border-all"></i> &nbsp; Lista de accesorios a cambiar</legend>
                    </div>
                    <div class="col-xs-12 col-sm-7 form-group">
                        <label>Seleccionar Accesorio</label>
                        <v-select  v-model="pre_detalle.accesorio" :options="accesorios"></v-select>
                    </div>
                    <div class="col-sm-3">
                        <div class="group-material">
                            <input v-model="pre_detalle.cantidad" type="text" class="tooltips-general material-control" placeholder="Escribe la cantidad" required="">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Cantidad:</label>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-2">
                        <button @click="agregar" class="btn btn-success">
                            Agregar Accesorio
                        </button>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-striped">
                            <thead style="background-color:#DFF0D8; font-weight:bold;">
                                <tr>
                                    <th class="div-table-cell">Accesorio</th>
                                    <th class="div-table-cell">Cantidad</th>
                                    <th class="div-table-cell">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(detalle,index) in detalles">
                                    <td>{{ detalle.nombre }}</td>
                                    <td>{{ detalle.cantidad }}</td>
                                    <td>
                                        <button @click="eliminarItem(index)" type="button" class="btn btn-danger btn-link btn-sm">
                                            <i class="zmdi zmdi-delete zmdi-hc-lg text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button @click="guardar()" class="btn btn-primary">
                            GUARDAR
                        </button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>
<script>
export default {
    data() {
        return {
            detalle_seleccionado: null,
            accesorios:[],
            pre_detalle: {
                accesorio:null,
                cantidad: 0
            },
            detalles:[]
        }
    },
    mounted() {
        axios.get(api_url+'/accesorio')
        .then(response=>{
            for (let i = 0; i < response.data.length; i++) {
                var accesorio = response.data[i];
                this.accesorios.push({
                    label: accesorio.codigo+" - "+accesorio.nombre+" - "+accesorio.modelo ,
                    id: accesorio.id
                });
            }
        });
        axios.get(api_url+'/reparacion-herramienta/'+this.$route.params.id)
        .then(response=>{
            this.detalle_seleccionado=response.data;
        });
    },
    methods: {
        agregar(){
            if (Number(this.pre_detalle.cantidad)>0) {
                this.detalles.push({
                    cantidad: Number(this.pre_detalle.cantidad),
                    accesorio_id: Number(this.pre_detalle.accesorio.id),
                    nombre: this.pre_detalle.accesorio.label
                });
                this.pre_detalle={
                    accesorio: null,
                    cantidad: 0
                }
            } else {
                swal({title: 'Cantidad al menos debe ser 1',icon: "error",timer: "4000"});
            }
        },
        guardar(){
            this.detalle_seleccionado.detalles=this.detalles;
            
            if (Number(this.detalle_seleccionado.costo)<=0 || this.detalle_seleccionado.detalles.length==0 ) {
                let aux=this.detalle_seleccionado.detalles.length==0?'Diagnostico no contiene Items': 'Precio al menos debe ser 1';
                swal({title: aux,icon: "error",timer: "4000"});
                
            } else {
                 axios.post(api_url+'/reparacion-herramienta/'+this.$route.params.id,this.detalle_seleccionado)
                .then(response=>{
                    var respuesta=response.data;
                    
                    if(respuesta.status=='OK'){
                        swal({
                            title: respuesta.data,
                            icon: "success",
                            timer: "2000"
                        });
                        if(respuesta.accesorio.length!=0){
                            let accesorio='';
                            for (let i = 0; i < respuesta.accesorio.length; i++) {
                                const item = respuesta.accesorio[i];
                                accesorio='Producto: '+item['nombre']+', cant faltante: '+item['cantidad']+ "\n";
                                accesorio+=accesorio;
                            }
                            swal("Accesorios faltantes", accesorio);
                        }

                        this.$router.push({path: "/diagnosticar/"+this.detalle_seleccionado.reparacion_id} );
                    }
                    if(respuesta.status=='DANGER'){
                        swal({title: respuesta.data,icon: "error",timer: "4000"});
                    }
                    this.btn_bloquear=false;
                });
            }
        },
        eliminarItem(index){
            this.detalles.splice(index, 1);
        },
    },
}
</script>