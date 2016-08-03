<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class vehiculo extends Model
{

    protected $table = 'Vehiculos';

    protected $fillable = ['Kilometraje', 'PrecioPorHora','placa','anio' , 'idColor','idModelo','idCondicion'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function scopeOfType($query, $idModelo){
        if (trim($idModelo)!="")
        {
            $query->where('idModelo', $idModelo);
        }
    }

    public function scopeOfType2($query, $idVehiculo){
        if (trim($idVehiculo)!="")
        {
            $query->where('id', $idVehiculo);
        }
    }

    public function scopeOfType3($query, $idVehiculo){
        if (trim($idVehiculo)!="")
        {
            $query->where('id', $idVehiculo)
                ->where('idCondicion', '1')
            ;
        }
    }



    public function color() {
        return $this->belongsTo('alquilerdeAutos\Color', 'idColor');
    }

    public function modelo() {
        return $this->belongsTo('alquilerdeAutos\Modelo', 'idModelo');
    }

    public function condicion() {
        return $this->belongsTo('alquilerdeAutos\Condicion', 'idCondicion');
    }




}
