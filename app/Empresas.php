<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
     protected $fillable = [
         'id_user',
          'r_social',
          'ciudad',
          'contacto',
          'rut',
          'direccion',
          'telefono',
          'logo',
    ];
}
