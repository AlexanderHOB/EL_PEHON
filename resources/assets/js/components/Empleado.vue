<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Empleados
                <button type="button" @click="abrirModal('empleado', 'registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio">
                              <option value="tipo_empleado">Tipo</option>
                              <option value="salario">Salario</option>
                              <option value="fecha_inicio">Fecha Contrata</option>
                              <option value="dias_laborados">Días Laborados</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarEmpleado(1, buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarEmpleado(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Tipo</th>
                            <th>Salario</th>
                            <th>Fecha Contrata</th>
                            <th>Días Laborados</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="empleado in arrayEmpleado" :key="empleado.id">
                            <td>
                                <button type="button" @click="abrirModal('empleado', 'actualizar', empleado)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="empleado.condicion">
                                    <button type="button" class="btn btn-danger btn sm" @click="desactivarEmpleado(empleado.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-info btn sm" @click="activarEmpleado(empleado.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>
                            </td>
                            <td v-text="empleado.tipo_empleado"></td>
                            <td v-text="empleado.salario"></td>
                            <td v-text="empleado.fecha_inicio"></td>
                            <td v-text="empleado.dias_laborados"></td>
                            <td>
                                <div v-if="empleado.condicion">
                                    <span class="badge badge-success">Contratado</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Despedido</span>
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
                            <label class="col-md-3 form-control-label" for="text-input">Tipo</label>
                            <div class="col-md-9">
                                <input type="text" v-model="tipo_empleado" class="form-control" placeholder="Tipo de Empleado">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="capacidad-input">Salario</label>
                            <div class="col-md-9">
                                <input type="capacidad" v-model="salario" class="form-control" placeholder="Ingresar Salario del Empleado">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Fecha Contrata</label>
                            <div class="col-md-9">
                                <input type="email" v-model="fecha_inicio" class="form-control" placeholder="Ingresar Fecha Contrata del Empleado">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Días Laborados</label>
                            <div class="col-md-9">
                                <input type="email" v-model="dias_laborados" class="form-control" placeholder="Ingresar Días Laborados del Empleado">
                            </div>
                        </div>
                        <div v-show="errorEmpleado" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjEmpleado" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEmpleado()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEmpleado()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</main>
</template>

<script>
    export default {
        data(){
            return {
                empleado_id: 0,
                tipo_empleado: '',
                salario: '',
                fecha_inicio: '',
                dias_laborados: '',
                arrayEmpleado: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorEmpleado: 0,
                errorMostrarMsjEmpleado: [],
                pagination: {
                    'total': 0,  
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0, 
                    'from': 0, 
                    'to': 0,
                },
                offset : 3,
                criterio : 'salario',
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
            listarEmpleado(page, buscar, criterio){
                let me = this;
                var url ='/Empleado?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEmpleado = respuesta.empleados.data;
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
                me.listarEmpleado(page, buscar, criterio);
            },
            registrarEmpleado(){
                if(this.validarEmpleado()){
                    return;
                }
                let me =this;
                axios.post('/Empleado/registrar', {
                    'tipo_empleado': this.tipo_empleado,
                    'salario': this.salario,
                    'fecha_inicio': this.fecha_inicio,
                    'dias_laborados': this.dias_laborados
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEmpleado(1, '', 'salario');
                }).catch(function(error){
                    console.log(error);
                });
            },
            actualizarEmpleado(){
                if(this.validarEmpleado()){
                    return;
                }
                let me =this;
                axios.put('/Empleado/actualizar', {
                    'tipo_empleado': this.tipo_empleado,
                    'salario': this.salario,
                    'fecha_inicio': this.fecha_inicio,
                    'dias_laborados': this.dias_laborados,
                    'id': this.empleado_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEmpleado(1, '', 'salario');
                }).catch(function(error){
                    console.log(error);
                });
            },
            desactivarEmpleado(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Estas Seguro de Despedir a este Empleado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, despidelo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me =this;
                    axios.put('/Empleado/desactivar', {
                        'id': id
                    }).then(function(response){
                        me.listarEmpleado(1, '', 'salario');
                        swalWithBootstrapButtons(
                            'Despedido!',
                            'El empleado ha sido despedido con éxito.',
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
                    'Tu empleado sigue trabajando',
                    'error'
                    )
                }
                })
            },
            activarEmpleado(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Estas Seguro de Contratar a este Empleado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, contratalo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me =this;
                    axios.put('/Empleado/activar', {
                        'id': id
                    }).then(function(response){
                        me.listarEmpleado(1, '', 'salario');
                        swalWithBootstrapButtons(
                            'Contratado!',
                            'El empleado ha sido contratado con éxito.',
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
                    'Tu empleado sigue despedido',
                    'error'
                    )
                }
                })
            },
            validarEmpleado(){
                this.errorEmpleado=0;
                this.errorMostrarMsjEmpleado=[];

                if(!this.tipo_empleado) this.errorMostrarMsjEmpleado.push("El Tipo del Empleado no puede estar vacio");
                if(!this.salario) this.errorMostrarMsjEmpleado.push("El salario del Empleado no puede estar vacio");
                if(!this.fecha_inicio) this.errorMostrarMsjEmpleado.push("La fecha de contrata del Empleado no puede estar vacio");
                if(!this.dias_laborados) this.errorMostrarMsjEmpleado.push("Los días laborados del Empleado no puede estar vacio");
                if(this.errorMostrarMsjEmpleado.length) this.errorEmpleado = 1;
                return this.errorEmpleado;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.tipo_empleado = '';
                this.salario = '';
                this.fecha_inicio = '';
                this.dias_laborados = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "empleado":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Empleado';
                                this.tipo_empleado = '';
                                this.salario = '';
                                this.fecha_inicio = '';
                                this.dias_laborados = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Empleado";
                                this.tipoAccion = 2;
                                this.empleado_id = data['id'];
                                this.tipo_empleado = data['tipo_empleado'];
                                this.salario = data['salario'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.dias_laborados = data['dias_laborados'];
                                break;  
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.listarEmpleado(1, this.buscar, this.criterio);
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
