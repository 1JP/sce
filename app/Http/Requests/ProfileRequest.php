<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            'password' => 'nullable|string|min:8',
            'cpf' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . Auth::user()->id
        ];

        return $rules;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf),
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

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser um texto.',

            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'Sua senha deve conter no mínimo 8 caracteres.',
        ];
    }
}
