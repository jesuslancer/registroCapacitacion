<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experiencias extends Model
{
    use SoftDeletes;
    protected $table = 'area_accion.experiencias';

    /**
     * Experiencias belongs to ExperienciaAgricola.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function experienciaAgricola()
    {
    	// belongsTo(RelatedModel, foreignKey = experienciaAgricola_id, keyOnRelatedModel = id)
    	return $this->belongsTo(ExperienciaAgricola::class);
    }
}
