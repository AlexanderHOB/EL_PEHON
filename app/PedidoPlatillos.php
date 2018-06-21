<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoPlatillos extends Model
{
    protected $table='pedidoplatillos';


    public $timestamps=false;


    protected $fillable =[
    	'id_pedido',
    	'id_platillo',
        'cantidad',
        'precio_unitario'
    ];

    protected $guarded =[

    ];
}
