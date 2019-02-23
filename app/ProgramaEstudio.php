<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProgramaEstudio extends Model
{
	use SoftDeletes;
    protected $table = 'cesuv.programa_estudio';
}
