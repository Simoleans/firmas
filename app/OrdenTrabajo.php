<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    public $table = 'orden_trabajo';

    //protected $fillable = ['id_empresa'];

     public function empresa()
     {
     	return $this->belongsTo("App\Empresas", "id_empresa");
     }

     public function user()
     {
     	 return $this->belongsTo("App\User", "id_user");
     }
}
