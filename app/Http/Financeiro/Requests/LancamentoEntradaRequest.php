<?php

namespace App\Http\Financeiro\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LancamentoEntradaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'users_id'         => 'usuário',
            'descricao'        => 'descrição',
            'valor'            => 'valor',
            'forma_pagamento'  => 'forma de pagamento',
            'tipo_lancamento'  => 'tipo de lançamento',
            'numero_parcela'   => 'número da parcela',
            'data_vencimento'  => 'data de vencimento',
            'data_pagamento'   => 'data de pagamento',
            'status'           => 'status',
            'cartao_credito'   => 'cartão de crédito',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'users_id' => 'required|integer|exists:users,id',
            'descricao' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string|in:PIX,DEB,DIN,BOL,VAL',
            'tipo_lancamento' => 'required|string|max:255',
            'numero_parcela' => 'nullable|integer|min:1',
            'data_vencimento' => 'required|date',
            'data_pagamento' => 'nullable|date|after_or_equal:data_vencimento',
            'status' => 'required|string|in:A,P,C',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'users_id.required' => 'O usuário é obrigatório.',
            'users_id.integer'  => 'O usuário deve ser um número inteiro.',
            'users_id.exists'   => 'O usuário informado não existe.',

            'descricao.string'  => 'A descrição deve ser um texto.',
            'descricao.max'     => 'A descrição pode ter no máximo 500 caracteres.',

            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric'  => 'O valor deve ser numérico.',
            'valor.min'      => 'O valor deve ser maior ou igual a zero.',

            'forma_pagamento.required' => 'A forma de pagamento é obrigatória.',
            'forma_pagamento.string'   => 'A forma de pagamento deve ser um texto.',
            'forma_pagamento.in'       => 'A forma de pagamento deve ser PIX, DEB, DIN, BOL ou VAL.',

            'tipo_lancamento.required' => 'O tipo de lançamento é obrigatório.',
            'tipo_lancamento.string'   => 'O tipo de lançamento deve ser um texto.',
            'tipo_lancamento.max'      => 'O tipo de lançamento pode ter no máximo 255 caracteres.',

            'numero_parcela.integer' => 'O número da parcela deve ser um inteiro.',
            'numero_parcela.min'     => 'O número da parcela deve ser no mínimo 1.',

            'data_vencimento.required' => 'A data de vencimento é obrigatória.',
            'data_vencimento.date'     => 'A data de vencimento deve ser uma data válida.',

            'data_pagamento.date' => 'A data de pagamento deve ser uma data válida.',
            'data_pagamento.after_or_equal' =>
                'A data de pagamento deve ser igual ou posterior à data de vencimento.',

            'status.required' => 'O status é obrigatório.',
            'status.string'   => 'O status deve ser um texto.',
            'status.in'       => 'O status deve ser A (Aberto), P (Pago) ou C (Cancelado).',
        ];
    }
}
