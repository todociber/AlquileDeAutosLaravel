<?php

namespace alquilerdeAutos;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class cliente extends Model
{
    use SoftDeletes;


    protected $table = 'clientes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['PrimerNombre','SegundoNombre','PrimerApellido', 'SegundoApellido', 'genero', 'nDocumento', 'EstadoD', 'DireccionEspecifica', 'CodigoPostal', 'FechaDeNacimiento','Telefono', 'idPaisUser', 'idTipoUsuario'];


    public function pais() {
        return $this->belongsTo('alquilerdeAutos\pais', 'idPaisUser');

    }

    public function tipoUsuario() {
        return $this->belongsTo('alquilerdeAutos\tipo_usuario', 'idTipoUsuario');
    }

    public function scopeOfType($query, $id){
        if (trim($id)!="")
        {
            $query->where('id', $id);
        }
    }

    protected $dates = ['deleted_at'];
}
