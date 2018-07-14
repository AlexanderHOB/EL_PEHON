<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable=[
        'idcliente',
        'idusuario',
        'idmesa',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total',
        'estado'
    ];
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    public function proveedor(){
        return $this->belongsTo('App\Empleado');
    }
    public function mesa(){
        return $this->belongsTo('App\Mesa');
    }
}
