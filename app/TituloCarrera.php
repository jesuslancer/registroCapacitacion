<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TituloCarrera extends Model
{
	use SoftDeletes;
    protected $table = 'cesuv.titulo_carrera';
}
