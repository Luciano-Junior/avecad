<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categorie_name' => ['required', 'string', 'max:50'],
            'categorie_description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'categorie_name.required' => 'O campo Nome é obrigatório.',
            'categorie_name.max' => 'O campo Nome permite no máximo 50 caracteres.',
            'categorie_description.required' => 'O campo Descrição é obrigatório.',
        ];
    }
}
