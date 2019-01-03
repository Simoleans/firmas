<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
      protected $fillable = [ 'id',
          'id_user',
          'razon_social',
          'ciudad',
          'contacto',
          'rut_proveedor',
          'direccion_proveedor',
          'telefono_proveedor',
      ];
}
