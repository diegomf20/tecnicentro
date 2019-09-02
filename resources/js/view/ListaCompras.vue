<template>
        <div class="container-fluid">
            <div id="modal-nuevo" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                             <b>Detalle compra</b>
                        </div>
                        <div class="modal-body">
                            <label for="">Número Compra: {{compra.numcompra}} </label> <br>
                            <!-- <label for="">Proveedor: {{compra.proveedor['id']}} </label> <br> -->
                            <table class="table table-striped">
                                <thead style="background-color:#DFF0D8; font-weight:bold;">
                                    <tr>
                                        <th class="div-table-cell">Codigo</th>
                                        <th class="div-table-cell">Nombre</th>
                                        <th class="div-table-cell">cantidad</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="detalle in detalles">
                                        <td>{{ detalle.accesorio.codigo }}</td>
                                        <td>{{ detalle.accesorio.nombre }}</td>
                                        <td>{{ detalle.cantidad }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Lista de compras</div>
                <div class="form-padding">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <router-link to="/compras">
                                <a class="btn btn-primary"  role="button">
                                    Nuevo
                                </a>
                            </router-link>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead style="background-color:#DFF0D8; font-weight:bold;">
                            <tr>
                                <th class="div-table-cell">Número compra</th>
                                <th class="div-table-cell">Proveedor</th>
                                <th class="div-table-cell">Estado</th>    
                                <th class="div-table-cell">Detalles</th>    
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="compra in compras">
                                <td>{{ compra.numcompra }}</td>
                                <td>{{ compra.proveedor.nombre}}</td>
                                <td  v-if="compra.estado=='0'"><button @click="cambiarEstado(compra.id)" class="btn btn-success">
                                        enviado
                                    </button></td>
                                <td  v-if="compra.estado=='1'">Recibido</td>
                                <td>
                                    <button @click="abrirdetalle(compra.id)" class="btn btn-success">
                                        <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp;
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</template>
<script>
import { log } from 'util';
export default {
    data() {
        return {
            compras:[],
            detalles:[],
            compra:[],
        }
    },
    mounted() {
        this.listar();
    },
    methods: {
        listar(){
            axios.get(api_url+'/compra')
            .then(response=>{
                this.compras=response.data;
            });
        },
       
        abrirdetalle(id){
            axios.get(api_url+'/compra/'+id)
            .then(response=>{

                var respuesta=response.data;
                this.detalles=respuesta.detalles;
                this.compra=respuesta.compra;
                
            });
            $('#modal-nuevo').modal();
        },
        
        cambiarEstado(id){
            axios.post(api_url+'/compra/'+id+'?_method=PUT')
            .then(response=>{
                var respuesta=response.data;
                if (respuesta.status=="OK") {
                    this.listar();
                    swal({title: respuesta.data,icon: "success",timer: "2000"});
                }
                if(respuesta.status=='DANGER'){
                    swal({title: respuesta.data,icon: "error",timer: "4000"});
                }
            });
        },
        mostrarErrores(form, error){
            var errores=error;
            $('.has-error span').remove();
            var arrKeys=Object.keys(errores);
            for (let index = 0; index < arrKeys.length; index++) {
                var indexName=arrKeys[index];
                if(index==0){
                    $('#'+form+' [name='+indexName+']').focus().parents('div.form-group').addClass('has-error')
                        .append("<div class=text-center><span>"+errores[indexName]+"</span></div>");
                    }else{
                        $('#'+form+' [name='+indexName+']').parents('div.form-group').addClass('has-error')
                        .append("<div class=text-center><span>"+errores[indexName]+"</span></div>");
                }
            }
        },
        limpiarErrores() {
            $('.has-error span').remove();
        }
    },
}
</script>