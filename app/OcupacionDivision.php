<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OcupacionDivision extends Model
{
    use SoftDeletes;
    protected $table = 'ocupacion.ocupacion_division';
	
}
