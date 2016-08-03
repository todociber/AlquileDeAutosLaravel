<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class estado_alquiler extends Model
{
    protected $table = 'estado_alquilers';

    protected $fillable = ['Nombre'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
