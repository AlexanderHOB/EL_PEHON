<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platillos extends Model
{
    protected $table='platillos';

    protected $primaryKey='id_platillo';

    public $timestamps=false;


    protected $fillable =[
    	'nombre_platillo',
    	'precio_platillo',
        'medida',
        'id_area',
        'id_grupo_platillos'
    ];

    protected $guarded =[

    ];
}
