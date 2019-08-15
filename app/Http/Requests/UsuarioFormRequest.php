<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
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
            "nome"   => "required",
            "email"  => "required|email",
            "senha"  => "required_if:codigo,",
            "grupos" => "required"
        ];
    }

    public function messages()
    {
        return [
            "senha.required_if" => "Senha obrigatória para novo usuário.",
            "grupos.required"   => "Selecione pelo menos um grupo."
        ];
    }
}
