<?php

namespace App\Http\Cadastros\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinReceitaRequest extends FormRequest
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
            'descricao' => 'descrição',
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
            'users_id'  => 'required|int',
            'valor' => 'required',
            'data_recebimento' => 'required|date',
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
            'users_id.required' => 'O campo descrição é obrigatório.',
            'users_id.string' => 'O campo descrição deve ser um inteiro.',
            'valor.required' => 'O campo valor é obrigatório.',
            'data_recebimento.data_recebimento' => 'O campo data de recebimento é obrigatório.',
            'data_recebimento.date' => 'O campo data de recebimento deve ser uma data válida.',
        ];
    }
}
