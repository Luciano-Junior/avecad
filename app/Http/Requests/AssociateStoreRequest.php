<?php

namespace App\Http\Requests;

use App\Models\Associate;
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
            'associate_surname' => ['nullable', 'string', 'max:50'],
            'associate_address' => ['nullable', 'string'],
            'associate_neighborhood' => ['nullable', 'string'],
            'associate_identity' => ['nullable', 'string', 'max:15', Rule::unique('associates', 'identity')->ignore($this->route('id'))],
            'associate_cpf' => ['nullable', 'string', 'digits:11', Rule::unique('associates', 'cpf')->ignore($this->route('id'))],
            'associate_admission_date' => ['nullable','date'],
            'associate_contact' => ['nullable','string'],
            'associate_family_contact' => ['nullable','string'],
            'associate_active' => ['nullable','boolean'],
            'category_associate_id' => ['nullable'],
            'vest_number' => ['nullable'],
            'occupation' => ['nullable'],
            'birth_date' => ['nullable','date'],
            'path_image' => ['nullable','image','max:2048'],
            'type_associate_id' => ['nullable', 'exists:type_associates,id']
        ];
    }

    public function messages(): array
    {
        return [
            'associate_name.required' => 'O campo Nome é obrigatório.',
            // 'associate_surname.required' => 'O campo Apelido é obrigatório.',
            // 'associate_address.required' => 'O campo Endereço é obrigatório.',
            // 'associate_neighborhood.required' => 'O campo Bairro é obrigatório.',
            // 'associate_identity.required' => 'O campo RG é obrigatório.',
            'associate_identity.unique' => 'Este RG já está cadastrado.',
            // 'associate_cpf.required' => 'O campo CPF é obrigatório.',
            // 'associate_cpf.digits' => 'O campo CPF deve conter exatamente 11 dígitos.',
            'associate_cpf.unique' => 'Este CPF já está cadastrado.',
            // 'associate_admission_date.required' => 'O campo Data de Admissao é obrigatório.',
            // 'associate_contact.required' => 'O campo Contato é obrigatório.',
            // 'associate_family_contact.required' => 'O campo Contato do Familiar é obrigatório.',
            // 'associate_active.required' => 'O campo Status é obrigatório.',
            // 'category_associate_id.required' => 'O campo Categoria é obrigatório.',
            // 'vest_number.required' => 'O campo Nº do Colete é obrigatório.',
            // 'occupation.required' => 'O campo Profissão é obrigatório.',
            // 'birth_date.required' => 'O campo Data de Nascimento é obrigatório.',
            // 'type_associate_id.required' => 'O campo Tipo é obrigatório.',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'associate_cpf' => $this->associate_cpf ? preg_replace('/\D/', '', $this->associate_cpf) : null, // Remove a máscara antes da validação
            'associate_identity' => $this->associate_identity ? preg_replace('/\D/', '', $this->associate_identity) : null, // Remove a máscara antes da validação
        ]);
    }

    public function validatedData(){
        $validated = $this->validated();

        return [
            'cpf' => $this->associate_cpf,
            'identity' => $this->associate_identity,
            'name' => $this->associate_name,
            'surname' => $this->associate_surname,
            'address' => $this->associate_address,
            'neighborhood' => $this->associate_neighborhood,
            'admission_date' => $this->associate_admission_date,
            'contact' => $this->associate_contact,
            'family_contact' => $this->associate_family_contact,
            'active' => $this->associate_active,
            'category_associate_id' => $this->category_associate_id,
            'vest_number' => $this->vest_number,
            'occupation' => $this->occupation,
            'birth_date' => $this->birth_date,
            'path_image' => $this->path_image,
            'type_associate_id' => $this->type_associate_id
        ];
    }
    
}
