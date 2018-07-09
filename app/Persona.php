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
    public function provedor()
    {
        return $this->hasOne('App\Proveedor');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }

}
