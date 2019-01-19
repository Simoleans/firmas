<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actas extends Model
{
     public $table = 'actas';

     protected $fillable = ['codigo','id_empresa','id_user'];
}
