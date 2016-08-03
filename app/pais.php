<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pais extends Model
{
    protected $table = 'pais';

    protected $fillable = ['Nombre'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
