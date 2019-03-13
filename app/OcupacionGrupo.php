<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OcupacionGrupo extends Model
{
    use SoftDeletes;
    protected $table = 'ocupacion.ocupacion_grupo';
    
}
