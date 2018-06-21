<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_cs extends Model
{
    protected $table='cliente_cs';

    protected $primaryKey='id_cliente_c';

    public $timestamps=false;


    protected $fillable =[
    	'fotografia',
    	'tipo_contrato',
        'direccion',
        'distrito',
        'edad',
        'sexo',
        'fecha_nacimiento',
        'correo_electronico',
        'telefono',
        'saldo_inicial',
        'id_cliente_independiente'
    ];

    protected $guarded =[

    ];
}
