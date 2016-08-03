<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiculoEstado extends Model
{
    protected $table = 'Vehiculos';

    protected $fillable = ['idCondicion'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
