<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';


    /**
     * Persona belongs to Parroquia.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parroquia()
    {
    	// belongsTo(RelatedModel, foreignKey = parroquia_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Parroquia::class);
    }
}
