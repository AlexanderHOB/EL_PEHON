<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Mesas
                <button type="button" @click="abrirModal('mesas', 'registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                              <option value="numero">Número</option>
                              <option value="capacidad">Capacidad</option>
                              <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarMesa(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarMesa(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Número</th>
                            <th>Capacidad</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mesa in arrayMesa" :key="mesa.id">
                            <td>
                                <button type="button" @click="abrirModal('mesas', 'actualizar', mesa)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="mesa.condicion">
                                    <button type="button" class="btn btn-danger btn sm" @click="desactivarMesa(mesa.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-info btn sm" @click="activarMesa(mesa.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>
                            </td>
                            <td v-text="mesa.numero"></td>
                            <td v-text="mesa.capacidad"></td>
                            <td v-text="mesa.descripcion"></td>
                            <td>
                                <div v-if="mesa.condicion">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Inactivo</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Número</label>
                            <div class="col-md-9">
                                <input type="number" v-model="numero" class="form-control" placeholder="Número de Mesa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Capacidad</label>
                            <div class="col-md-9">
                                <input type="number" v-model="capacidad" class="form-control" placeholder="Ingresar Capacidad">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="email" v-model="descripcion" class="form-control" placeholder="Ingresar Descripción">
                            </div>
                        </div>
                        <div v-show="errorMesa" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjMesa" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMesa()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMesa()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
 <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Mesa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la mesa?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {
        data(){
            return {
                mesa_id: 0,
                numero: '',
                capacidad: '',
                descripcion: '',
                arrayMesa: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorMesa: 0,
                errorMostrarMsjMesa: [],
                pagination: {
                    'total': 0,  
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0, 
                    'from': 0, 
                    'to': 0,
                },
                offset : 3,
                criterio : 'numero',
                buscar: ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2)
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            listarMesa(page, buscar, criterio){
                let me = this;
                var url ='/Mesa?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMesa = respuesta.mesas.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page, buscar, criterio){
                let me = this;
                //Actualiza la Pagina actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar la data en esa pagina
                me.listarMesa(page, buscar, criterio);
            },
            registrarMesa(){
                if(this.validarMesa()){
                    return;
                }
                let me =this;
                axios.post('/Mesa/registrar', {
                    'numero': this.numero,
                    'capacidad': this.capacidad,
                    'descripcion': this.descripcion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarMesa(1, '', 'numero');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarMesa(){
                if(this.validarMesa()){
                    return;
                }
                let me =this;
                axios.put('/Mesa/actualizar', {
                    'numero': this.numero,
                    'capacidad': this.capacidad,
                    'descripcion': this.descripcion,
                    'id': this.mesa_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarMesa(1, '', 'numero');
                }).catch(function(error){
                    console.log(error);
                });
            },
            desactivarMesa(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Estas Seguro de Desactivar esta Mesa?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, desactivalo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me =this;
                    axios.put('/Mesa/desactivar', {
                        'id': id
                    }).then(function(response){
                        me.listarMesa(1, '', 'numero');
                        swalWithBootstrapButtons(
                            'Desactivado!',
                            'El registro ha sido desactivado con éxito.',
                            'success'
                        )
                    }).catch(function(error){
                        console.log(error);
                    });
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Cancelado',
                    'Tu registro sigue activo',
                    'error'
                    )
                }
                })
            },
            activarMesa(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Estas Seguro de Desactivar esta Mesa?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, activalo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me =this;
                    axios.put('/Mesa/activar', {
                        'id': id
                    }).then(function(response){
                        me.listarMesa(1, '', 'numero');
                        swalWithBootstrapButtons(
                            'Activado!',
                            'El registro ha sido activado con éxito.',
                            'success'
                        )
                    }).catch(function(error){
                        console.log(error);
                    });
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Cancelado',
                    'Tu registro sigue desactivado',
                    'error'
                    )
                }
                })
            },
            validarMesa(){
                this.errorMesa=0;
                this.errorMostrarMsjMesa=[];

                if(!this.numero) this.errorMostrarMsjMesa.push("El Número de la Mesa no puede estar vacio");
                if(!this.capacidad) this.errorMostrarMsjMesa.push("La capacidad de la Mesa no puede estar vacio");
                if(this.errorMostrarMsjMesa.length) this.errorMesa = 1;
                return this.errorMesa;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.numero = '';
                this.capacidad = '';
                this.descripcion = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "mesas":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Mesa';
                                this.numero = '';
                                this.capacidad = '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Mesa";
                                this.tipoAccion = 2;
                                this.mesa_id = data['id'];
                                this.numero = data['numero'];
                                this.capacidad = data['capacidad'];
                                this.descripcion = data['descripcion'];
                                break;  
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarMesa(1, this.buscar, this.criterio);
        }
    }
</script>
<style>
    .modal-conten{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red;
        font-weight: bold;
    }
</style>
