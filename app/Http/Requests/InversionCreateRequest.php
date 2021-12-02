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
            "num_documento" => "required|integer",
            "ciudad_residencia" => "required",
            "direccion_residencia" => "required",
            "celular" => "required",
            "email" => "required|unique:users,email",
            "banco" => "required",
            "tipo_cuenta" => "required",
            "num_cuenta" => "required|integer",
            // "password" => "required",
            "invertido" => "required|integer",
            "tipo_interes" => "required",
            "comprobante_consignacion" => "required|mimes:jpg,jpeg,png,pdf",
            "fecha_consignacion" => "required",
            "referente" => "required",
            "periodo_mes" => "required",
            "terminos" => "required",
            "imagen64" => "required"
        ];
    }
}
