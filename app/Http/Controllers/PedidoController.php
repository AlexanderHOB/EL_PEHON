<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Pedido, DetallePedido};
use Illuminate\Support\Facades\DB;
class PedidoController extends Controller
{
    public function index(Request $request )
    {

        if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio=$request->criterio;
        if($buscar==''){
            $pedidos = Pedido::join('personas','pedidos.idcliente','=','personas.id')
            ->join('users','pedidos.idusuario','=','users.id')
            ->join('mesas','pedidos.idmesa','=','mesas.id')
            ->select('pedidos.id','pedidos.tipo_comprobante','pedidos.serie_comprobante','pedidos.num_comprobante',
            'pedidos.fecha_hora','pedidos.impuesto','pedidos.total','pedidos.estado',
            'personas.nombre','users.usuario','mesas.numero')
            ->orderBy('pedidos.id','desc')->paginate(10);
        }else{
            $pedidos = Pedido::join('personas','pedidos.idcliente','=','personas.id')
            ->join('users','pedidos.idusuario','=','users.id')
            ->join('mesas','pedidos.idmesa','=','mesas.id')
            ->select('pedidos.id','pedidos.tipo_comprobante','pedidos.serie_comprobante','pedidos.num_comprobante',
            'pedidos.fecha_hora','pedidos.impuesto','pedidos.total','pedidos.estado',
            'personas.nombre','users.usuario','mesas.numero')
            ->where('pedidos.'.$criterio,'like','%'.$buscar.'%')
            ->orderBy('pedidos.id','desc')->paginate(5);
        }
        
        return [
            'pagination' => [
                'total' =>          $pedidos->total(),
                'current_page'=>    $pedidos->currentPage(),
                'per_page'=>        $pedidos->perPage(),
                'last_page'=>       $pedidos->lastPage(),
                'from' =>           $pedidos->firstItem(),
                'to' =>             $pedidos->lastItem()
            ],
            'pedidos' => $pedidos
        ];
        
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
        $pedido = Pedido::join('personas','pedidos.idcliente','=','personas.id')
        ->join('users','pedidos.idusuario','=','users.id')
        ->select('pedidos.id','pedidos.tipo_comprobante','pedidos.serie_comprobante',
        'pedidos.num_comprobante','pedidos.fecha_hora','pedidos.impuesto','pedidos.total',
        'pedidos.estado','personas.nombre','users.usuario','mesas.numero')
        ->where('pedidos.id','=',$id)
        ->orderBy('pedidos.id', 'desc')->take(1)->get();
         
        return [
            'pedido' => $pedido
        ];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
        $detalles = DetallePedido::join('platillos','detalle_pedidos.idplatillos','=','platillos.id')
        ->select('detalle_pedidos.cantidad','detalle_pedidos.precio',
        'platillo.nombre as platillo')
        ->where('detalle_pedidos.idpedido','=',$id)
        ->orderBy('detalle_pedidos.id', 'desc')->get();
         
        return [
            'detalles' => $detalles
        ];
    }
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $mytime=Carbon::now('America/Lima');
            $pedido = new Pedido();
            $pedido->idcliente=$request->idcliente;
            $pedido->idusuario=\Auth::user()->id;
            $pedido->idmesa=$request->idmesa;
            $pedido->tipo_comprobante=$request->tipo_comprobante;
            $pedido->serie_comprobante=$request->serie_comprobante;
            $pedido->num_comprobante=$request->num_comprobante;
            $pedido->fecha_hora=$mytime->toDateString();
            $pedido->impuesto=$request->impuesto;
            $pedido->total=$request->total;
            $pedido->estado='Registrado';
            $pedido->save();

            $detalles = $request->data; //Array de detalles
            //Recorro todo los elementos
            foreach ($detalles as $ep=>$det)
            {
                $detalle=new PedidoPlatillo();
                $detalle->idpedido=$pedido->id;
                $detalle->idplatillo=$det['idplatillo'];
                $detalle->cantidad=$det['cantidad'];
                $detalle->precio=$det['precio'];
                $detalle->save();
            }
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
        

    }
   
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $pedido = Pedido::findOrFail($request->id);
        $pedido->condicion = 'Terminado';
        $pedido->save();
    }
}
