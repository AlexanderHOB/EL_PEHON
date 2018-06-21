<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table='empleados';

    protected $primaryKey='id_empleado';

    public $timestamps=false;


    protected $fillable =[
    	'tipo_empleado',
    	'salario',
        'fecha_contrato',
        'dias_laborales',
        'fecha_fin_contrato',
        'id_cliente_independiente'
    ];

    protected $guarded =[

    ];
}
