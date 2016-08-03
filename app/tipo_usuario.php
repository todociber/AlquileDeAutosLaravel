<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_usuario extends Model
{
    protected $table = 'tipo_usuarios';

    protected $fillable = ['Nombre'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
