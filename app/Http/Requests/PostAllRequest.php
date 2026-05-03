<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAllRequest extends FormRequest
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
            'per_page' => 'nullable|integer|min:30|max:120',
            'order_direction' => 'nullable|string|in:asc,desc',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'per_page' => $this->per_page ?? 30,
            'order_direction' => $this->order_direction ?? 'asc',
        ]);
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'per_page.integer' => 'O campo per_page deve ser um número inteiro.',
            'per_page.min' => 'O campo per_page deve ser no mínimo 30.',
            'per_page.max' => 'O campo per_page deve ser no máximo 120.',
            'order_direction.string' => 'O campo order_direction deve ser uma string.',
            'order_direction.in' => 'O campo order_direction deve ser "asc" ou "desc".',
        ];
    }
}
