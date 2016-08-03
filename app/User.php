<?php

namespace alquilerdeAutos;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['PrimerNombre','SegundoNombre','Primer Apellido', 'SegundoApellido', 'genero', 'nDocumento', 'EstadoD', 'DireccionEspecifica', 'CodigoPostal', 'FechaDeNacimiento', 'idPaisUser', 'idTipoUsuario', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];


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
}
