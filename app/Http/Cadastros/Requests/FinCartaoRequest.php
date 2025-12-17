<?php

namespace App\Http\Cadastros\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinCartaoRequest extends FormRequest
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
            'descricao' => 'required|string|max:100',
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
            'descricao.required' => 'O descrição é obrigatório.',
            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição pode ter no máximo 100 caracteres.',
        ];
    }
}
