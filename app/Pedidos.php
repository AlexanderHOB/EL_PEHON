<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table='pedidos';

    protected $primaryKey='id_pedido';

    public $timestamps=false;


    protected $fillable =[
    	'valor_total',
    	'fecha_pedido',
        'id_mesa',
        'id_cliente_independiente',
        'id_empleado'
    ];

    protected $guarded =[

    ];
}
