<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CervejaFormRequest extends FormRequest
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
            "sku"                => "required|sku",
            "nome"               => "required",
            "descricao"          => "min:1|max:50",
            "valor"              => "required|min:0.01|max:9999999.99",
            "teor_alcoolico"     => "required|max:100.00",
            "comissao"           => "required|max:100.00",
            "quantidade_estoque" => "required|max:999",
            "origem"             => "required",
            "sabor"              => "required",
            "codigo_estilo"      => "required"
        ];
    }

    public function messages()
    {
        return [
            "sku.sku" => "SKU deve ser informado no formato correto (exemplo: XX9999)."
        ];
    }
}
