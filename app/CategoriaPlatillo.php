<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaPlatillo extends Model
{
    protected $table ='categorias_platillos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'condicion'
        ];
}
