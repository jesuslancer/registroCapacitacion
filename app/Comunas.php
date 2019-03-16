<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunas extends Model
{
    use SoftDeletes;
    protected $table = 'area_accion.comunas';
}
