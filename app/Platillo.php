<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    protected $fillable=[
        'idcategoria', 
        'codigo',
        'nombre',
        'precio',
        'descripcion',
        'condicion',
        'medida'
    ];
    public function categoriaPlatillo(){
        return $this->belongsTo('App\CategoriaPlatillo');
    }
}
