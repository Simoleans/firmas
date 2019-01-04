<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenC extends Model
{
     public $table = 'orden_compra';

     protected $fillable = ['cod_seguimiento','id_user','id_proveedor','id_empresa','producto','precio_unt','cantidad'];
}
