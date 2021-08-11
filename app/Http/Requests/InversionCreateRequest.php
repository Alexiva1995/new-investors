<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InversionCreateRequest extends FormRequest
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
            "fullname" => "required",
            "tipo_documento" => "required",
            "num_documento" => "required",
            "ciudad_residencia" => "required",
            "direccion_residencia" => "required",
            "celular" => "required",
            "email" => "required",
            "banco" => "required",
            "tipo_cuenta" => "required",
            "num_cuenta" => "required",
            "password" => "required",
            "invertido" => "required",
            //"tipo_interes" => "on",
            "fecha_consignacion" => "required",
            "referente" => "required",
            //"comprobante_consignacion" => "",
            "periodo_mes" => "required",
            "terminos" => "required",
        ];
    }
}
