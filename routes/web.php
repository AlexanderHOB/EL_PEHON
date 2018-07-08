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
        //Platillos
        Route::get('/platillo','PlatilloController@index');
        Route::post('/platillo/registrar','PlatilloController@store');
        Route::put('/platillo/actualizar','PlatilloController@update');
        Route::put('/platillo/desactivar','PlatilloController@desactivar');
        Route::put('/platillo/activar','PlatilloController@activar');
        //Roles
        Route::get('/rol','RolController@index');
        Route::get('/rol/selectRol','RolController@selectRol');
        //Mesas
        Route::get('/Mesa','MesaController@index');
        Route::post('/Mesa/registrar','MesaController@store');
        Route::put('/Mesa/actualizar','MesaController@update');
        Route::put('/Mesa/desactivar','MesaController@desactivar');
        Route::put('/Mesa/activar','MesaController@activar');
        //Clientes
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
        
        //user
        Route::get('/user','UserController@index');
        Route::post('/user/registrar','UserController@store');
        Route::put('/user/actualizar','UserController@update');
        Route::put('/user/desactivar','UserController@desactivar');
        Route::put('/user/activar','UserController@activar');
    });
    Route::group(['middleware'=>['Caja']],function(){
        //Clientes
        Route::get('/cliente','ClienteController@index');
        Route::post('/cliente/registrar','ClienteController@store');
        Route::put('/cliente/actualizar','ClienteController@update');
    });
    Route::group(['middleware'=>['Mozo']],function(){    
    });
    
    });

//Route::get('/home', 'HomeController@index')->name('home');