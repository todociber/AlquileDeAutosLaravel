<?php

namespace alquilerdeAutos\Http\Requests;

use alquilerdeAutos\Http\Requests\Request;

class ModeloValidacionRequest extends Request
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
            'Nombre'=>'required|unique:modelos',
        ];
    }
}
