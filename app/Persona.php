<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable=[
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'celular',
        'email'
    ];
    
    public function empleado()
    {
        return $this->hasOne('App\Empleado');
    }
}
