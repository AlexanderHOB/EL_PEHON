<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoPlatillos extends Model
{
    protected $table='grupoplatillos';

    protected $primaryKey='id_grupo_platillos';

    public $timestamps=false;


    protected $fillable =[
    	'clasificacion'
    ];

    protected $guarded =[

    ];
}
