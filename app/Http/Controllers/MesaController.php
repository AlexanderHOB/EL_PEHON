<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas=Mesa::all();
        return $mesas;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mesa = new Mesa();
        $mesa->numero=$request->numero;
        $mesa->capacidad=$request->capacidad;
        $mesa->descripcion=$request->descripcion;
        $mesa->condicion='1';
        $mesa->save();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id);
        $mesa->numero=$request->numero;
        $mesa->capacidad=$request->capacidad;
        $mesa->descripcion=$request->descripcion;
        $mesa->condicion='1';
        $mesa->save();
    }
    public function desactivar(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id);
        $mesa->condicion='0';
        $mesa->save();
    }
    public function activar(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id);
        $mesa->condicion='1';
        $mesa->save();
    }
}
