<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'account_id' => ['nullable'],
            'type' => ['required', 'max:1'],
            'amount' => ['required'],
            'transaction_date' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo Descrição é obrigatório.',
            'type.required' => 'O campo Tipo é obrigatório.',
            'amount.required' => 'O campo Valor é obrigatório.',
            'transaction_date.required' => 'O campo Data da Movimentação é obrigatório.',
        ];
    }
}
