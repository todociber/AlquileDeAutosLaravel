<?php

namespace alquilerdeAutos\Http\Requests;

use alquilerdeAutos\Http\Requests\Request;

class UsuarioValidacionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'PrimerNombre'=>'required',
                'SegundoNombre'=>'required',
                'PrimerApellido'=>'required',
                'SegundoApellido'=>'required',
                'genero'=>'required',
                'nDocumento'=>'min:9|max:15|required|unique:clientes',
                'EstadoD'=>'required',
                'DireccionEspecifica'=>'required',
                'CodigoPostal'=>'required',
                'FechaDeNacimiento'=>'required',
                'idPaisUser'=>'required',
                'Telefono'=>'min:8|max:8|required|unique:clientes',

        ];
    }
}
