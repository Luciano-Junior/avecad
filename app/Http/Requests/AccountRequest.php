<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'type' => ['required', 'max:1'],
            'amount' => ['required'],
            'due_date' => ['required', 'date'],
            'status' => ['required'],
            'associate_id' => ['integer', "nullable", "required_if:category_id,1"],
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'amount' => str_replace(',', '.', str_replace('.', '', $this->amount)), // Remove pontos e troca vírgula por ponto
        ]);
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo Descrição é obrigatório.',
            'type.required' => 'O campo Tipo é obrigatório.',
            'amount.required' => 'O campo Valor é obrigatório.',
            'due_date.required' => 'O campo Data do Vencimento é obrigatório.',
            'status.required' => 'O campo Status é obrigatório.',
            'associate_id.required_if' => 'O campo Associado é obrigatório quando a categoria é Mensalidade.',
        ];
    }
}
