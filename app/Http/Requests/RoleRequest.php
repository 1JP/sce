<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('Root');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'guard_name' => 'string|max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'guard_name' => 'web',
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'guard_name.required' => 'O campo guard name é obrigatório.',
            'guard_name.string' => 'O campo guard name deve ser uma string.',
            'guard_name.max' => 'O campo guard name deve ter no máximo 255 caracteres.',
        ];
    }
}
