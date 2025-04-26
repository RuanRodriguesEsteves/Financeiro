<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvarCartaoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'descricao' => 'required|string',
            'id_banco' => 'required|integer|exists:banco,id'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é obrigatório',
            'id_banco.required' => 'Banco é obrigatório',
            'id_banco.exists' => 'O banco selecionado é inválido',
        ];
    }
}
