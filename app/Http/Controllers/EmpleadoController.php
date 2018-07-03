<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empleado;
use App\Persona;

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
            $empleados=Empleado::join('personas','empleados.id','=','personas.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento','personas.direccion','personas.celular','personas.email',
            'empleados.tipo_empleado','empleados.salario','empleados.fecha_inicio','empleados.dias_laborados','empleados.condicion')
            ->orderBy('personas.id', 'desc')->paginate(5);
        }
        else{
            $empleados=Empleado::join('personas','empleados.id','=','persona.id')
            ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento','personas.direccion','personas.celular','personas.email',
            'empleados.tipo_empleado','empleados.salario','empleados.fecha_inicio','empleados.dias_laborados','empleados.condicion')
            ->where($criterio, 'like','%'.$buscar.'%')
            ->orderBy('personas.id', 'desc')->pginate(5);
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

        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->nombre=$request->nombre;
            $persona->tipo_documento=$request->tipo_documento;
            $persona->num_documento=$request->num_documento;
            $persona->direccion=$request->direccion;
            $persona->celular=$request->celular;
            $persona->email=$request->email;
            $persona->save();

            $empleado = new Empleado();
            $empleado->tipo_empleado=$request->tipo_empleado;
            $empleado->salario=$request->salario;
            $empleado->fecha_inicio=$request->fecha_inicio;
            $empleado->dias_laborados=$request->dias_laborados;
            $empleado->condicion='1';
            $empleado->id = $persona->id;
            $empleado->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
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

        try{
            DB::beginTransaction();
            $empleado = Empleado::findOrFail($request->id);
            $persona = Persona::findOrFail($empleado->id);

            $persona->nombre=$request->nombre;
            $persona->tipo_documento=$request->tipo_documento;
            $persona->num_documento=$request->num_documento;
            $persona->direccion=$request->direccion;
            $persona->celular=$request->celular;
            $persona->email=$request->email;
            $persona->save();

            $empleado->tipo_empleado=$request->tipo_empleado;
            $empleado->salario=$request->salario;
            $empleado->fecha_inicio=$request->fecha_inicio;
            $empleado->dias_laborados=$request->dias_laborados;
            $empleado->condicion='1';
            $empleado->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
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
