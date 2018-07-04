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
<<<<<<< HEAD
        'dias_laborados'
=======
        'dias_laborados',   
        'condicion'
>>>>>>> 8700e072751284091db0c1a28b61ee8c40250b4a
        ];

        public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
