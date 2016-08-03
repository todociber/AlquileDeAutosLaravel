<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class alquiler extends Model
{
    protected $table = 'alquilers';

    protected $fillable = ['FechaDeRegistro','FechaDeEntregaPrevisto', 'pago', 'idVehiiculo', 'idEstadoAlquiler', 'idUsuario'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function vehiculo() {
        return $this->belongsTo('alquilerdeAutos\Vehiculo', 'idVehiculo');
    }

    public function scopeOfType($query, $id){
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }
    public function usuario() {
        return $this->belongsTo('alquilerdeAutos\User', 'idUsuario');
    }
    public function estado() {
        return $this->belongsTo('alquilerdeAutos\estado_alquiler', 'idEstadoAlquiler');
    }
}
