<?php

namespace App\Http\Requests;

use App\Models\Associate;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssociateStoreRequest extends FormRequest
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
            'associate_name' => ['required', 'string', 'max:255'],
            'associate_surname' => ['required', 'string', 'max:50'],
            'associate_address' => ['required', 'string'],
            'associate_neighborhood' => ['required', 'string'],
            'associate_identity' => ['required', 'string', 'max:15', 'unique:associates,identity'],
            'associate_cpf' => ['required', 'string', 'digits:11', 'unique:associates,cpf'],
            'associate_admission_date' => ['required','date'],
            'associate_contact' => ['required','string'],
            'associate_family_contact' => ['required','string'],
        ];
    }

    public function messages(): array
    {
        return [
            'associate_name.required' => 'O campo Nome é obrigatório.',
            'associate_surname.required' => 'O campo Apelido é obrigatório.',
            'associate_address.required' => 'O campo Endereço é obrigatório.',
            'associate_neighborhood.required' => 'O campo Bairro é obrigatório.',
            'associate_identity.required' => 'O campo RG é obrigatório.',
            'associate_identity.unique' => 'Este RG já está cadastrado.',
            'associate_cpf.required' => 'O campo CPF é obrigatório.',
            'associate_cpf.digits' => 'O campo CPF deve conter exatamente 11 dígitos.',
            'associate_cpf.unique' => 'Este CPF já cadastrado.',
            'associate_admission_date.required' => 'O campo Data de Admissao é obrigatório.',
            'associate_contact.required' => 'O campo Contato é obrigatório.',
            'associate_family_contact.required' => 'O campo Contato do Familiar é obrigatório.',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'associate_cpf' => preg_replace('/\D/', '', $this->associate_cpf), // Remove a máscara antes da validação
            'associate_identity' => preg_replace('/\D/', '', $this->associate_identity), // Remove a máscara antes da validação
        ]);
    }
}
