<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OcupacionSeccion extends Model
{
    use SoftDeletes;
    protected $table = 'ocupacion.ocupacion_seccion';
}
