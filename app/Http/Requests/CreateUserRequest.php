<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required|string',
            'cpf' => 'required|string',
            'password' => 'nullable|string|min:8',
            'postal_code' => 'required|string',
            'birth_date' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'locality' => 'required|string',
            'city' => 'required|string',
            'region_code' => 'required|string',
            'country' => 'nullable|string',
            'area' => 'nullable|string',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $phone = preg_replace('/\D/', '', $this->phone);
        $area = substr($phone, 0, 2);
        $number = substr($phone, 2);

        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf),
            'phone' => $number,
            'postal_code' => preg_replace('/\D/', '', $this->postal_code),
            'country' => '55',
            'area' => $area
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

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser um texto.',

            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'Sua senha deve conter no mínimo 8 caracteres.',
            
            'postal_code.required' => 'O CEP é obrigatório.',
            'postal_code.string' => 'O CEP deve ser um texto.',

            'street.required' => 'A rua é obrigatória.',
            'street.string' => 'A rua deve ser um texto.',

            'number.required' => 'O número é obrigatório.',
            'number.string' => 'O número deve ser um texto.',

            'locality.required' => 'O bairro é obrigatório.',
            'locality.string' => 'O bairro deve ser um texto.',

            'city.required' => 'A cidade é obrigatória.',
            'city.string' => 'A cidade deve ser um texto.',

            'region_code.required' => 'O estado é obrigatório.',
            'region_code.string' => 'O estado deve ser um texto.',

            'birth_date.required' => 'A data de nascimento é obrigatório.',
            'birth_date.string' => 'A data de nascimento deve ser um texto.',
        ];
    }
}
