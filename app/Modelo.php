<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class modelo extends Model
{
    protected $table = 'modelos';

    protected $fillable = ['Nombre', 'idMarca'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function marca() {
        return $this->belongsTo('alquilerdeAutos\Marca', 'idMarca');

    }
}
