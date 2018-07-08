<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoPlatillo extends Model
{
    protected $table='pedido_platillos';
     protected $fillable=[
        'idpedido',
        'idplatillo',
        'cantidad',
        'precio'
     ];

     
}
