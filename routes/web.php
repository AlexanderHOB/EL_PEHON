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
Route::get('/CategoriaPlatillo','CategoriaPlatilloController@index');
Route::post('/CategoriaPlatillo/registrar','CategoriaPlatilloController@store');
Route::put('/CategoriaPlatillo/actualizar','CategoriaPlatilloController@update');
Route::put('/CategoriaPlatillo/desactivar','CategoriaPlatilloController@desactivar');
Route::put('/CategoriaPlatillo/activar','CategoriaPlatilloController@activar');