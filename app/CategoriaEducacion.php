<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoriaEducacion extends Model
{
	use SoftDeletes;
    protected $table = 'cesuv.categoria_educacion';
}
