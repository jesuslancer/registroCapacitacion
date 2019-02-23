<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parroquia extends Model
{
	use SoftDeletes;
    protected $table = 'ubicacion_geografica.parroquia';
}
