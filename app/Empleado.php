<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table ='empleados';

    protected $fillable = [
        'tipo_empleado',
        'salario',
        'fecha_inicio',
        'dias_laborados'.
        'condicion'
        ];
}
