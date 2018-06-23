<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaPlatillo;
class CategoriaPlatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=CategoriaPlatillo::all();
        return $categorias;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->request;
        $categoria->condicion='1';
        $categoria->save();

    }

  
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->request;
        $categoria->condicion='1';
        $categoria->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desactivar(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion='0';
        $categoria->save();
    }
    public function activar(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion='1';
        $categoria->save();
    }
}
