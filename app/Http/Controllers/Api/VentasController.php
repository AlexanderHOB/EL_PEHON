<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\{Categoria,CategoriaPlatillo};
use App\Http\Resources\Api\{Categoria as CategoriaResource,CategoriaPlatillo as CategoriaPlatilloResource,VentaResource,VentaResourceDia,
IngresoResource,IngresoResourceDia};    
class VentasController extends Controller
{
    public function index()
    {
        
    }
    public function getCategorias(Request $request){
        
        $resultados=Categoria::select('categorias.nombre','categorias.descripcion')
                ->get();
                return CategoriaResource::collection($resultados);      
    }
    public function getCategoriaPlatillos(Request $request){
        $respuesta=CategoriaPlatillo::select('categorias_platillos.nombre',
        'categorias_platillos.descripcion')
        ->get();
        return CategoriaPlatilloResource::collection($respuesta);
    }
    public function getVentas(Request $request)
    {
        $ventas=DB::table('ventas as v')
        ->select(DB::raw('MONTH(v.fecha_hora) as mes'),
        DB::raw('YEAR(v.fecha_hora) as anio'),
        DB::raw('SUM(v.total) as total'))
        ->whereYear('v.fecha_hora',$anio)
        ->groupBy(DB::raw('MONTH(v.fecha_hora)'),DB::raw('YEAR(v.fecha_hora)'))
        ->get();
 
        return VentaResource::collection($ventas);      
 
    } 
    public function getVentasDia(Request $request)
    {
        $anio=date('Y');
        
        $ventas=DB::table('ventas as v')
        ->select(DB::raw('DAY(v.fecha_hora) as dia'),
        DB::raw('MONTH(v.fecha_hora) as mes'),
        DB::raw('SUM(v.total) as total'))
        ->whereYear('v.fecha_hora',$anio)
        ->groupBy(DB::raw('DAY(v.fecha_hora)'),DB::raw('MONTH(v.fecha_hora)'))
        ->get();
 
        return VentaResourceDia::collection($ventas);      
 
    }    
    public function getIngresos(Request $request)
    {
        $anio=date('Y');
        $ingresos=DB::table('ingresos as i')
        ->select(DB::raw('MONTH(i.fecha_hora) as mes'),
        DB::raw('YEAR(i.fecha_hora) as anio'),
        DB::raw('SUM(i.total) as total'))
        ->whereYear('i.fecha_hora',$anio)
        ->groupBy(DB::raw('MONTH(i.fecha_hora)'),DB::raw('YEAR(i.fecha_hora)'))
        ->get();
 
        return IngresoResource::collection($ingresos);      
 
    }
    public function getIngresosDia(Request $request)
    {
        $anio=date('Y');
        $ingresos=DB::table('ingresos as i')
        ->select(DB::raw('DAY(i.fecha_hora) as dia'),
        DB::raw('MONTH(i.fecha_hora) as mes'),
        DB::raw('SUM(i.total) as total'))
        ->whereYear('i.fecha_hora',$anio)
        ->groupBy(DB::raw('DAY(i.fecha_hora)'),DB::raw('MONTH(i.fecha_hora)'))
        ->get();
 
        return IngresoResourceDia::collection($ingresos);      
 
    }     
}
