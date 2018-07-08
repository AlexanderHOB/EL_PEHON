<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable=[
        'idempleado',
        'idusuario',
        'fecha_pedido',
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
}
