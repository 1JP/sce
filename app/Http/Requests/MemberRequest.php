<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|string',
            'cpf' => 'string',
            'password' => 'string',
            'postal_code' => 'string',
            'birth_date' => 'date',
            'street' => 'string',
            'number' => 'string',
            'locality' => 'string',
            'city' => 'string',
            'region_code' => 'string',
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = 'required|string|email|unique:users,email';
        }
    
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required|string|email|unique:users,email,' . Auth::user()->id;
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => '***.***.***-**',
            'password' => '123457',
            'postal_code' => '35720000',
            'birth_date' => '1995-10-10',
            'street' => '*************',
            'number' => '180',
            'locality' => '*********',
            'city' => 'Matozinhos',
            'region_code' => 'MG'
        ]);
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser um texto.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'phone.required' => 'O telefone é obrigatório.',
            'phone.string' => 'O telefone deve ser um texto.',
        ];
    }
}
