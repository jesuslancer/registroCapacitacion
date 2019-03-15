<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosFormativos extends Model
{
	use SoftDeletes;
    protected $table = 'datos_formativos';

    /**
     * DatosFormativos belongs to NivelEducativo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivelEducativo()
    {
    	// belongsTo(RelatedModel, foreignKey = nivelEducativo_id, keyOnRelatedModel = id)
    	return $this->belongsTo(NivelEducativo::class);
    }
    /**
     * DatosFormativos belongs to TituloCarrera.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tituloCarrera()
    {
    	// belongsTo(RelatedModel, foreignKey = tituloCarrera_id, keyOnRelatedModel = id)
    	return $this->belongsTo(TituloCarrera::class);
    }
}
