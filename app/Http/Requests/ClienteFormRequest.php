<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            "nome"        => "required",
            "tipo_pessoa" => "required",
            "cpf_cnpj"    => "required_if:tipo_pessoa,FISICA,JURIDICA",
            "email"       => "required|email"
        ];
    }
}
