<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table='mesas';

    protected $primaryKey='id_mesa';

    public $timestamps=false;


    protected $fillable =[
    	'numero_mesa',
    	'capacidad_mesa',
        'ubicacion_mesa',
        'id_empleado'
    ];

    protected $guarded =[

    ];
}
