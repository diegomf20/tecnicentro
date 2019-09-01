<template>
    <div class="container-fluid">
        <div class="modal fade" id="modal-documento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <iframe :src="url" frameborder="0" width="300" height="500"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-flat-form">
            <div class="title-flat-form title-flat-blue">Nota de Entrada</div>
            <div class="form-padding">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>Cliente</label>
                        <v-select v-model="nota.cliente" :options="clientes"></v-select>
                    </div>
                    <div class="col-xs-12 col-sm-5 text-right nuevo" style="margin: 10px;">
                        <router-link to="/cliente">
                            <a href="" class="btn btn-info" role="button"> Cliente Nuevo</a>
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <legend><i class="zmdi zmdi-border-all"></i> &nbsp; Detalles de Nota</legend>
                    </div>
                    <div class="col-xs-12 col-sm-6 form-group">
                        <label>Herramienta</label>
                        <v-select  v-model="pre_item.herramienta" :options="herramientas"></v-select>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="group-material">
                            <input v-model="pre_item.serie" type="text" class="tooltips-general material-control" placeholder="Escribe aquí el Serie" required="" maxlength="20" >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Serie</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <button class="btn btn-success" @click="add()">Agregar a Nota</button>
                    </div>
                    <div class="col-xs-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre de Herramienta</th>
                                    <th>Serie</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in nota.detalles">
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.serie}}</td>
                                    <td>
                                        <button @click="eliminar(index)" class="btn btn-sm btn-danger">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12">
                        <p class="text-center">
                            <button :disabled="nota.detalles.length==0" @click="guardar()" type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style >
    @media (min-width: 768px){
        .nuevo {
           text-align: center !important;
        }
    }

</style>
<script>
export default {
    data() {
        return {
            url:"",
            clientes: [],
            herramientas:[],
            pre_item:{
                herramienta: null,
                serie: null
            },
            nota: {
                cliente: null,
                detalles: []
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
        eliminar(index){
            this.nota.detalles.splice(index,1);
        },
        add(){
            this.nota.detalles.push({
                herramienta_id: this.pre_item.herramienta.id,
                nombre: this.pre_item.herramienta.label,
                serie: this.pre_item.serie
            });
            this.pre_item={
                herramienta:null,
                serie: ''
            };
        },
        guardar(){
            //  this.btn_bloquear=true;
            axios.post(api_url+'/nota',{
                cliente_id: this.nota.cliente.id,
                detalles:this.nota.detalles
            })
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=='OK'){
                    $('#modal-documento').modal();
                    this.url="comprobante1/"+respuesta.data.id;
                    this.nota={
                        cliente: null,
                        detalles:  []
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
                //  this.btn_bloquear=false;
            });
        }
    },
}
</script>