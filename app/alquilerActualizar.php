<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class alquilerActualizar extends Model
{
    protected $table = 'alquilers';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['FechaDeEntregaPrevisto', 'pago'];

    public function estadoAlquiler() {
        return $this->belongsTo('alquilerdeAutos\estado_alquiler', 'idEstadoAlquiler');
    }

}
