<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class color extends Model
{
    protected $table = 'colors';

    protected $fillable = ['Nombre'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
