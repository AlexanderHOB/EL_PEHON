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
                        <i class="fa fa-align-justify"></i> Pedidos
                        <button type="button" @click="abrirModal('pedido','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="tipo_comprobate">Tipo Comprobante</option>
                                      <option value="num_comprobante">Numero Comprobante</option>
                                      <option value="fecha_pedido">Fecha-Hora</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPedido(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary" @click="listarPedido(1,buscar,criterio)"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Usuario</th>
                                    <th>Empleado</th>
                                    <th>Tipo Comprobante</th>
                                    <th>Serie Comprobante</th>
                                    <th>Numero Comprobante</th>
                                    <th>Fecha Hora</th>
                                    <th>Total</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pedido in arrayPedido" :key="pedido.id">
                                    <td>
                                        <button type="button" @click="abrirModal('pedido','actualizar',pedido)" class="btn btn-success btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                        <template v-if="pedido.estado=='Registrado'">
                                            <button type="button" class="btn btn-danger btn sm" @click="desactivarPedido(pedido.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                
                                    </td>
                                    <td v-text="pedido.usuario"></td>
                                    <td v-text="pedido.nombre"></td>
                                    <td v-text="pedido.tipo_comprobante"></td>
                                    <td v-text="pedido.serie_comprobante"></td>
                                    <td v-text="pedido.num_comprobante"></td>
                                    <td v-text="pedido.fecha_pedido"></td>
                                    <td v-text="pedido.total"></td>
                                    <td v-text="pedido.impuesto"></td>
                                    <td v-text="pedido.estado"></td>
                                    
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page>1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page-1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                
                                <li class="page-item" v-if="pagination.current_page<pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page+1,buscar,criterio)">Sig</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la persona">
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <select  v-model="tipo_documento" class="form-control">
                                            <option value="DNI">DNI</option>
                                            <option value="RUC">RUC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Número de Documento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="num_documento" class="form-control" placeholder="Numero de Documento">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Direccion">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Celular</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="celular" class="form-control" placeholder="Celular">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="email">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrol">
                                            <option value="0">Seleccione un rol</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                        </select>                                
                                     </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Nombre de Usuario">
                                        
                                </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="Password">
                                        
                                    </div>
                                </div>
                                
                                <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
                            <h4 class="modal-title">Eliminar Empleado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar al Empleado?</p>
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
        data (){
            return {
                pedido_id:0,
                idempleado:0,
                nombre:'',
                tipo_comprobante:'Boleta',
                serie_comprobate:'',
                num_comprobante:'',
                impuesto:0.18,
                total:0.0,              
                arrayPedido : [],
                arrayDetalle:[],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPedido : 0,
                errorMostrarMsjPedido : [],
                pagination : {
                    'total' :0,
                    'current_page':0,
                    'per_page' :0,
                    'last_page':0,     
                    'from'     :0, 
                    'to'       :0,   
                },
                offset : 3,
                criterio:'num_comprobante',
                buscar:''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //calculate los elementos de paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from =this.pagination.current_page - this.offset;
                if(from<1){
                    from=1;
                }
                var to = from+(this.offset*2);
                if (to >= this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArray =[];
                while(from<= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarPedido (page,buscar,criterio){
                let me=this;
                var url='/pedido?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    me.arrayPedido=respuesta.pedidos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me = this;
                var url='/rol/selectRol';
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    me.arrayRol=respuesta.roles;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me=this;
                //Actualizar la Página Actual
                me.pagination.current_page=page;
                //Enviar la peticion para visualizar la pagina
                me.listarPedido(page,buscar,criterio)
            },
            registrarPersona(){
                if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.post('/user/registrar',{
                    'nombre': this.nombre,
                    'tipo_documento':this.tipo_documento,
                    'num_documento':this.num_documento,
                    'direccion':this.direccion,
                    'celular':this.celular,
                    'email': this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol': this.idrol
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona(){
                if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.put('/user/actualizar',{
                    'nombre': this.nombre,
                    'tipo_documento':this.tipo_documento,
                    'num_documento':this.num_documento,
                    'direccion':this.direccion,
                    'celular':this.celular,
                    'email': this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol': this.idrol,
                    'id':this.persona_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
desactivarUsuario(id){
               swal({
                title: 'Esta seguro de desactivar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarUsuario(id){
               swal({
                title: 'Esta seguro de activar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la Persona no puede estar vacío.");
                if (!this.usuario) this.errorMostrarMsjPersona.push("El nombre de la usuario no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjPersona.push("La contraseña no puede estar vacío.");
                if (this.idrol==0) this.errorMostrarMsjPersona.push("Debe seleccionar un rol para el usuario.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.tipo_documento='DNI';
                this.num_documento='';
                this.direccion='';
                this.nombre='';
                this.celular='';
                this.email='';
                this.tipo_empleado='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.errorPersona=0;
            },
            abrirModal(modelo, accion, data = []){
                this.selectRol();
                switch(modelo){
                    case "personas":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.nombre= '';
                                this.tipo_documento='DNI';
                                this.num_documento='';
                                this.direccion='';
                                this.celular='';
                                this.email='';
                                this.usuario='';
                                this.password='';
                                this.idrol=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Cliente';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre=data['nombre'];
                                this.tipo_documento=data['tipo_documento'];
                                this.num_documento=data['num_documento'];
                                this.direccion=data['direccion'];
                                this.celular=data['celular'];
                                this.email=data['email'];
                                this.usuario=data['usuario']
                                this.password=data['password'];
                                this.idrol=data['idrol'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarPedido(1,this.buscar,this.criterio);
        }
    }
    
</script>
<style>    
    .modal-content{
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
        color: red !important;
        font-weight: bold;
    }
</style>
