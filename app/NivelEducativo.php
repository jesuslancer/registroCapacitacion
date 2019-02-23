<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NivelEducativo extends Model
{
	use SoftDeletes;
    protected $table = 'cesuv.nivel_educativo';
}
