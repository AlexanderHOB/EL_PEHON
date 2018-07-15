<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Gestionar a los Invitados
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
   
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('dashboard','DashboardController');
    //Notificaciones
    Route::post('/notification/get','NotificationController@get');

    Route::group(['middleware'=>['Administrador']],function(){
        //Empleados
        Route::get('/empleado','EmpleadoController@index');
        Route::post('/empleado/registrar','EmpleadoController@store');
        Route::put('/empleado/actualizar','EmpleadoController@update');
        Route::put('/empleado/desactivar','EmpleadoController@desactivar');
        Route::put('/empleado/activar','EmpleadoController@activar');
         //Categorias Platillos
        Route::get('/CategoriaPlatillo','CategoriaPlatilloController@index');
        Route::post('/CategoriaPlatillo/registrar','CategoriaPlatilloController@store');
        Route::put('/CategoriaPlatillo/actualizar','CategoriaPlatilloController@update');
        Route::put('/CategoriaPlatillo/desactivar','CategoriaPlatilloController@desactivar');
        Route::put('/CategoriaPlatillo/activar','CategoriaPlatilloController@activar');
        Route::get('/Categoria/selectCategoria','CategoriaPlatilloController@selectCategoria');
        //Categoria Articulos
        Route::get('/categoria','CategoriaController@index');
        Route::post('/categoria/registrar','CategoriaController@store');
        Route::put('/categoria/actualizar','CategoriaController@update');
        Route::put('/categoria/desactivar','CategoriaController@desactivar');
        Route::put('/categoria/activar','CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        //Articulo
        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo','ArticuloController@buscarArticulo');
        Route::get('/articulo/buscarArticuloVenta','ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticulo','ArticuloController@listarArticulo');
        Route::get('/articulo/listarArticuloVenta','ArticuloController@listarArticuloVenta');
        Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');
        //Platillos
        Route::get('/platillo','PlatilloController@index');
        Route::post('/platillo/registrar','PlatilloController@store');
        Route::put('/platillo/actualizar','PlatilloController@update');
        Route::put('/platillo/desactivar','PlatilloController@desactivar');
        Route::put('/platillo/activar','PlatilloController@activar');
        Route::get('/platillo/buscarPlatillo','PlatilloController@buscarPlatillo');
        Route::get('/platillo/listarPlatillo','PlatilloController@listarPlatillo');
        
        //Roles
        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');
        //Mesas
        Route::get('/Mesa','MesaController@index');
        Route::post('/Mesa/registrar','MesaController@store');
        Route::put('/Mesa/actualizar','MesaController@update');
        Route::put('/Mesa/desactivar','MesaController@desactivar');
        Route::put('/Mesa/activar','MesaController@activar');
        Route::get('/mesa/selectMesa','MesaController@selectMesa');
        //Clientes
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
        Route::get('/cliente/selectCliente','ClienteController@selectCliente');
        //Proveedores
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        //user
        Route::get('/user','UserController@index');
        Route::post('/user/registrar','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::put('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');
        //Ingreso
        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');
        //Ventas
        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta_pdf');
        //Pedidos
        Route::get('/pedido', 'PedidoController@index');
        Route::post('/pedido/registrar', 'PedidoController@store');
        Route::put('/pedido/desactivar', 'PedidoController@desactivar');
        Route::get('/pedido/obtenerCabecera', 'PedidoController@obtenerCabecera');
        Route::get('/pedido/obtenerDetalles', 'PedidoController@obtenerDetalles');
        Route::get('/pedido/obtenerPedidos', 'PedidoController@obtenerPedidos');
     /*-------------INTERFAZ DE APIS---------------*/  
        Route::get('/reporteCategoria', function () {
        return view('api.categorias');
        });
       
    });
    Route::group(['middleware'=>['Caja']],function(){
        //Clientes
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
        Route::get('/cliente/selectCliente','ClienteController@selectCliente');
        //Route::get('/articulo/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');

        
    });
    Route::group(['middleware'=>['Mozo']],function(){    
    });
    
    });

//Route::get('/home', 'HomeController@index')->name('home');
