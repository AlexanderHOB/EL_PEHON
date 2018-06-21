<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCuentas extends Model
{
    protected $table='estadocuentas';

    protected $primaryKey='id_estado_cuenta';

    public $timestamps=false;


    protected $fillable =[
    	'deuda_total',
    	'id_pedido',
        'saldo_final',
        'id_cliente_c'
    ];

    protected $guarded =[

    ];
}
