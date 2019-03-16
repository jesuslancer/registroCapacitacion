<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otros extends Model
{
    use SoftDeletes;
    protected $table = 'area_accion.otros';
}
