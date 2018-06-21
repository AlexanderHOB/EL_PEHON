<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table='areas';

    protected $primaryKey='id_area';

    public $timestamps=false;


    protected $fillable =[
    	'tipo_area'
    ];

    protected $guarded =[

    ];
}
