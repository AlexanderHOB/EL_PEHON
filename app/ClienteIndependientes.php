<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteIndependientes extends Model
{
    protected $table='clienteindependientes';

    protected $primaryKey='id_cliente_independiente';

    public $timestamps=false;


    protected $fillable =[
    	'tipo_cliente',
    	'nombre',
        'apellido',
        'ruc',
        'dni'
    ];

    protected $guarded =[

    ];
}
