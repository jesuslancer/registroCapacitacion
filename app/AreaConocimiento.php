<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AreaConocimiento extends Model
{
	use SoftDeletes;
    protected $table = 'cesuv.area_conocimiento';
}
