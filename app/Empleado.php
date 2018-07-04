<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table ='empleados';

    protected $fillable = [
        'id',
        'tipo_empleado',
        'salario',
        'fecha_inicio',
        'dias_laborados',   
        'condicion'
        ];
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
