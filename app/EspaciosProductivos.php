<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspaciosProductivos extends Model
{
    use SoftDeletes;
    protected $table = 'area_accion.espacios_productivos';

    /**
     * EspaciosProductivos belongs to Parroquia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parroquia()
    {
    	// belongsTo(RelatedModel, foreignKey = parroquia_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Parroquia::class);
    }
}
