<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenC extends Model
{
     protected $fillable = [
          'nombre',
          'email',
          'rut_user',
          'ciudad_user',
          'telefono_user',
          'direccion_user',
    ];
}
