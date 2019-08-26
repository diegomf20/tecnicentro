<template>
    <div class="container-fluid">
        <div class="modal fade" id="modal-documento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <iframe :src="url" frameborder="0" width="200" height="500"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Nota de Entrada</div>
            <form v-on:submit.prevent="guardar()" class="form-padding">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>Cliente</label>
                        <v-select v-model="nota.cliente" :options="clientes"></v-select>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>Herramienta</label>
                        <v-select  v-model="nota.herramienta" :options="herramientas"></v-select>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <input v-model="nota.modelo" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Modelo" required="" maxlength="20" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Modelo</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <input v-model="nota.serie" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Serie" required="" maxlength="20" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Serie</label>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p class="text-center">
                            <button type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url:"",
            clientes: [],
            herramientas:[],
            nota: {
                cliente: null,
                herramienta:null,
                modelo: null,
                serie: null
            }
        }
    },
    mounted() {
        axios.get(api_url+'/herramienta')
        .then(response=>{
            var lista_herramienta=response.data;
            for (let i = 0; i < lista_herramienta.length; i++) {
                const element = lista_herramienta[i];
                this.herramientas.push({
                    label: element.nombre,
                    id: element.id
                });
            }
        });
        axios.get(api_url+'/cliente')
        .then(response=>{
            var lista_cliente=response.data;
            for (let i = 0; i < lista_cliente.length; i++) {
                const element = lista_cliente[i];
                this.clientes.push({
                    label: element.nombre+" "+ element.apellido,
                    id: element.id
                });
            }
        });
    },
    methods: {
        guardar(){
            axios.post(api_url+'/nota',{
                cliente_id: this.nota.cliente.id,
                herramienta_id:this.nota.herramienta.id,
                modelo: this.nota.modelo,
                serie: this.nota.serie
            })
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    $('#modal-documento').modal();
                    this.url="comprobante1/"+respuesta.data.id;
                    this.nota={
                        cliente: null,
                        herramienta:null,
                        modelo: null,
                        serie: null
                    };
                    swal({
                        title: "Nota Registrada",
                        icon: "success",
                        timer: "2000"
                    });
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        }
    },
}
</script>