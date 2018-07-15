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
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == ''){
            $mesas=Mesa::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $mesas=Mesa::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }
        return[
            'pagination'    =>[
                'total'         =>$mesas->total(),
                'current_page'  =>$mesas->currentPage(),
                'per_page'      =>$mesas->perPage(),
                'last_page'     =>$mesas->lastPage(),
                'from'          =>$mesas->firstItem(),
                'to'            =>$mesas->lastItem(),
            ],
            'mesas' =>  $mesas
        ];
    }
    
    public function selectMesa(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $mesas=Mesa::where('numero','like','%'.$filtro .'%')
        ->select('id','numero','capacidad','descripcion')
        ->orderBy('id','asc')
        ->get();
        return ['mesas'=> $mesas];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
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
        if (!$request->ajax()) return redirect('/');
        $mesa = Mesa::findOrFail($request->id);
        $mesa->numero=$request->numero;
        $mesa->capacidad=$request->capacidad;
        $mesa->descripcion=$request->descripcion;
        $mesa->condicion='1';
        $mesa->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mesa = Mesa::findOrFail($request->id);
        $mesa->condicion='0';
        $mesa->save();
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $mesa = Mesa::findOrFail($request->id);
        $mesa->condicion='1';
        $mesa->save();
    }
}
