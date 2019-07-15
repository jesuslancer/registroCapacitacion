<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consejos extends Model
{
    use SoftDeletes;
    protected $table = 'area_accion.consejos';
}
