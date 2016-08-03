<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class condicion extends Model
{
    protected $table = 'condicions';

    protected $fillable = ['Nombre'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
