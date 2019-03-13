<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosOcupacion extends Model
{
    use SoftDeletes;
    protected $table = 'datos_ocupacion';
}
