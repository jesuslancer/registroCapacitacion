<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parroquia extends Model
{
	use SoftDeletes;
    protected $table = 'ubicacion_geografica.parroquia';

    /**
     * Parroquia belongs to Municipio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
    	// belongsTo(RelatedModel, foreignKey = municipio_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Municipio::class);
    }
}
