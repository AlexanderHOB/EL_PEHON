<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

class EmpleadoController extends Controller
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
            $empleados=Empleado::orderBy('id', 'desc')->paginate(5);
        }
        else{
            $empleados=Empleado::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(5);
        }
        return[
            'pagination'    =>[
                'total'         =>$empleados->total(),
                'current_page'  =>$empleados->currentPage(),
                'per_page'      =>$empleados->perPage(),
                'last_page'     =>$empleados->lastPage(),
                'from'          =>$empleados->firstItem(),
                'to'            =>$empleados->lastItem(),
            ],
            'empleados' =>  $empleados
        ];
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
        $empleado = new Empleado();
        $empleado->tipo_empleado=$request->tipo_empleado;
        $empleado->salario=$request->salario;
        $empleado->fecha_inicio=$request->fecha_inicio;
        $empleado->dias_laborados=$request->dias_laborados;
        $empleado->condicion='1';
        $empleado->save();

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
        $empleado = Empleado::findOrFail($request->id);
        $empleado->tipo_empleado=$request->tipo_empleado;
        $empleado->salario=$request->salario;
        $empleado->fecha_inicio=$request->fecha_inicio;
        $empleado->dias_laborados=$request->dias_laborados;
        $empleado->condicion='1';
        $empleado->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion='0';
        $empleado->save();
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion='1';
        $empleado->save();
    }
}
