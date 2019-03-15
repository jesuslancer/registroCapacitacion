<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Municipio extends Model
{
	use SoftDeletes;
    protected $table = 'ubicacion_geografica.municipio';
    /**
     * Municipio belongs to Estado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
    	// belongsTo(RelatedModel, foreignKey = estado_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Estado::class);
    }
    
}
