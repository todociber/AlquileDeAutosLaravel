<?php

namespace alquilerdeAutos\Http\Requests;

use alquilerdeAutos\Http\Requests\Request;

class VehiculoValidacionRequest extends Request
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
            'Kilometraje'=>'required',
            'PrecioPorHora'=>'required',
            'placa'=>'min:8|max:8|required|unique:vehiculos',
            'anio'=>'required',
        ];
    }
}
