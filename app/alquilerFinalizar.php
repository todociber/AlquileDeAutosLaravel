<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class alquilerFinalizar extends Model
{
    protected $table = 'alquilers';

    protected $fillable = ['FechaDeEntrega', 'pago', 'idEstadoAlquiler'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
