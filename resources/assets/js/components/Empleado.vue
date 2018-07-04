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
                        <i class="fa fa-align-justify"></i> Empleados
                        <button type="button" @click="abrirModal('personas','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Documento</option>
                                      <option value="email">Email</option>
                                      <option value="celular">Celular</option>
                                      <option value="tipo_empleado">Tipo Empleado</option>
                                      <option value="salario">Salario</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary" @click="listarPersona(1,buscar,criterio)"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Tipo Documento</th>
                                    <th>Número</th>
                                    <th>Direccion</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Salario</th>
                                    <th>Fecha Contrato</th>
                                    <th>Días Laborados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('personas','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;

                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.tipo_documento"></td>
                                    <td v-text="persona.num_documento"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.celular"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.tipo_empleado"></td>
                                    <td v-text="persona.salario"></td>
                                    <td v-text="persona.fecha_inicio"></td>
                                    <td v-text="persona.dias_laborados"></td>
                                    
                                </tr>                                
                            </tbody>
                        </table>
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
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="email">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Tipo de Empleado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="tipo_empleado" class="form-control" placeholder="Tipo del Empleado">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Salario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="salario" class="form-control" placeholder="Salario del Empleado">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Fecha Contrato</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="fecha_inicio" class="form-control" placeholder="Fecha de Contrato del Empleado">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Días Laborados</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="dias_laborados" class="form-control" placeholder="Días Laborados por el Empleado">
                                        
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
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
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
                persona_id:0,
                nombre : '',
                tipo_documento:'DNI',
                num_documento:'',
                direccion:'',
                celular:'',
                email:'',
                tipo_empleado:'',
                salario:'',
                fecha_inicio:'',
                dias_laborados:'',               
                arrayPersona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' :0,
                    'current_page':0,
                    'per_page' :0,
                    'last_page':0,     
                    'from'     :0, 
                    'to'       :0,   
                },
                offset : 3,
                criterio:'nombre',
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
            listarPersona (page,buscar,criterio){
                let me=this;
                var url='/Empleado?page='+page+'&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    me.arrayPersona=respuesta.personas.data;
                    me.pagination=respuesta.pagination;
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
                me.listarPersona(page,buscar,criterio)
            },
            registrarPersona(){
                if (this.validarPersona()){
                    return;
                }
                
                let me = this;

                axios.post('/Empleado/registrar',{
                    'nombre': this.nombre,
                    'tipo_documento':this.tipo_documento,
                    'num_documento':this.num_documento,
                    'direccion':this.direccion,
                    'celular':this.celular,
                    'email': this.email,
                    'tipo_empleado': this.tipo_empleado,
                    'salario': this.salario,
                    'fecha_inicio': this.fecha_inicio,
                    'dias_laborados': this.dias_laborados
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

                axios.put('/Empleado/actualizar',{
                    'nombre': this.nombre,
                    'tipo_documento':this.tipo_documento,
                    'num_documento':this.num_documento,
                    'direccion':this.direccion,
                    'celular':this.celular,
                    'email': this.email,
                    'tipo_empleado': this.tipo_empleado,
                    'salario': this.salario,
                    'fecha_inicio': this.fecha_inicio,
                    'dias_laborados': this.dias_laborados,
                    'id':this.persona_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la Persona no puede estar vacío.");

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
                this.salario='';
                this.fecha_inicio='';
                this.dias_laborados='';
                this.errorPersona=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "personas":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Empleado';
                                this.nombre= '';
                                this.tipo_documento='DNI';
                                this.num_documento='';
                                this.direccion='';
                                this.celular='';
                                this.email='';
                                this.tipo_empleado='';
                                this.salario='';
                                this.fecha_inicio='';
                                this.dias_laborados='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Empleado';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre=data['nombre'];
                                this.tipo_documento=data['tipo_documento'];
                                this.num_documento=data['num_documento'];
                                this.direccion=data['direccion'];
                                this.celular=data['celular'];
                                this.email=data['email'];
                                this.tipo_empleado=data['tipo_empleado'];
                                this.salario=data['salario'];
                                this.fecha_inicio=data['fecha_inicio'];
                                this.dias_laborados=data['dias_laborados'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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
