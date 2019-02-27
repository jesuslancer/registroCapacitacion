<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitucionEducativa extends Model
{
    use SoftDeletes;
    protected $table = 'institucion_educativa.institucion_educativa';
}
