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

Route::get('/', function () {
    return view('contenido/contenido');
});
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
//Mesas
Route::get('/Mesa','MesaController@index');
Route::post('/Mesa/registrar','MesaController@store');
Route::put('/Mesa/actualizar','MesaController@update');
Route::put('/Mesa/desactivar','MesaController@desactivar');
Route::put('/Mesa/activar','MesaController@activar');
