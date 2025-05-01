<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespesaRequest extends FormRequest
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
        //dd($this->all());
        return [
            'descricao' => 'required|string',
            'id_tipodespesa' => 'required|integer',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'id_mensalidadecartao' => 'nullable|integer|exists:mensalidadecartao,id'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é obrigatório',
            'id_tipodespesa.required' => 'Tipo despesa é obrigatório',
            'valor.required' => 'Valor é obrigatório',
            'data.required' => 'Data é obrigatório',
            'id_mensalidadecartao.exists' => 'A mensalidade cartão é inválida'
        ];
    }
}
