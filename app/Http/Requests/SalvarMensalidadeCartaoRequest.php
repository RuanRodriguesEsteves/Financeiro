<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalvarMensalidadeCartaoRequest extends FormRequest
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
            'valor' => 'required|numeric',
            'datafechamento' => 'required|date',
            'datavencimento' => 'required|date|after_or_equal:datafechamento',
            'mesreferencia' => 'required|date',
            'id_cartao' => 'required|integer|exists:cartao,id'
        ];
        
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Descrição é obrigatório',
            'valor.required' => 'Valor é obrigatório',
            'datafechamento.required' => 'Data fechamento é obrigatório',
            'datavencimento.required' => 'Data vencimento é obrigatório',
            'datavencimento.after_or_equal' => 'Data vencimento precisa ser maior ou igual a data de fechamento',
            'mesreferencia.required' => 'Mês referência é obrigatório',
            'id_cartao.required' => 'Cartão é obrigatório',
            'id_cartao.exists' => 'O cartão selecionado é inválido'
        ];
    }
}
