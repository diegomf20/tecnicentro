<template>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Nueva compra</div>
        <div class="form-padding">
            <form id="" class="row">
                <div class="col-md-3 form-group">
                    <label for="">Documento</label>
                    <input v-model="compra.documento" type="text" class="form-control">
                </div>
                <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                        <label class="">Proveedor</label>
                        <v-select :options="proveedores" @input="seleccionarProveedor"></v-select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-flat-form">
        <div class="form-padding">
            <h4><b> ITEMS DE COMPRA</b></h4>
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
                    <button @click="agregarItem()" class="btn btn-info">Agregar Item</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in compra.items">
                            <td>{{ item.codigo}}</td>
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
                        <tr v-if="compra.items.length==0">
                            <td class="text-center" colspan="6">Sin Items de compra</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="text-center col-12">
                    <button @click="guardar()" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
<style>
    .title-flat-form{
        margin-bottom:0px;
    }
    .container-flat-form{
        padding-bottom: 0px;
    }    

</style>
<script>
export default {
    data() {
        return {
            proveedores:[],
            piezas: [],
            compra:{
                proveedor_id:null,
                documento: null,
                items: [],
            },
            itemMomentaneo:{
                pieza: null,
                cantidad: 1,
            }
        }
    },
    
    mounted() {
        axios.get(api_url+'/proveedor')
        .then(response=>{
            for (let i = 0; i < response.data.length; i++) {
                var proveedor = response.data[i];
                this.proveedores.push({
                    label: proveedor.ruc+" - "+proveedor.nombre,
                    id: proveedor.id
                });
            }
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
        seleccionarProveedor(value){
            if(value==null){
                this.compra.proveedor_id=null;
            }else{
                this.compra.proveedor_id=value.id;
            }
        },
        eliminarItem(index){
            this.compra.items.splice(index, 1);
        },
        agregarItem(){
            this.compra.items.push({
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
        guardar(){
            axios.post(api_url+'/compra',this.compra)
            .then(response=>{
                var respuesta=response.data;
                if(respuesta.status=="OK"){
                    swal({
                        title: "Compra Registrada",
                        icon: "success",
                        timer: "2000"
                    });
                    this.compra={
                        proveedor_id:null,
                        documento: null,
                        total: 0,
                        items: [],
                    };
                }
                if (respuesta.status=="ERROR") {
                    swal({
                        title: respuesta.data,
                        icon: "error",
                        timer: "4000"
                    });
                }
            });
        }
    },
}
</script>
