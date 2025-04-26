<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvarRendaRequest extends FormRequest
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
            'id_tiporenda' => 'required|integer',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'descricao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'id_tiporenda.required' => 'Tipo renda é obrigatório',
            'valor.required' => 'Valor é obrigatório',
            'data.required' => 'Data é obrigatório',
            'descricao.required' => 'Descrição é obrigatório',
        ];
    }
}
