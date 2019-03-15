<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosOcupacion extends Model
{
    use SoftDeletes;
    protected $table = 'datos_ocupacion';

    /**
     * DatosOcupacion belongs to Ocupacion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ocupacionClase()
    {
    	// belongsTo(RelatedModel, foreignKey = ocupacion_id, keyOnRelatedModel = id)
    	return $this->belongsTo(OcupacionClase::class);
    }
}
