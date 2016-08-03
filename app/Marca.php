<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marcas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombreMarca'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];



}
