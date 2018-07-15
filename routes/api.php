<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:api','cors'])->group(function(){
            Route::get('reporteCategoria','Api\VentasController@getCategorias');
            Route::get('reporteCategoriaPlatillos','Api\VentasController@getCategoriaPlatillos');
            Route::get('reporteVentas','Api\VentasController@getVentas');
            Route::get('reporteVentasDia','Api\VentasController@getVentasDia');
            Route::get('reporteIngresos','Api\VentasController@getIngresos');
            Route::get('reporteIngresosDia','Api\VentasController@getIngresosDia');
            
        });
        /*Route::namespace('Api')->group(function(){
            Route::get('reporteCategoria','VentasController@getCategorias');
            Route::get('reporteCategoriaPlatillos','VentasController@getCategoriaPlatillos');
            Route::get('reporteVentas','VentasController@getVentas');
            Route::get('reporteVentasDia','VentasController@getVentasDia');
            Route::get('reporteIngresos','VentasController@getIngresos');
            Route::get('reporteIngresosDia','VentasController@getIngresosDia');

        });*/

