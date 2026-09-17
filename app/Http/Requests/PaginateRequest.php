<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends FormRequest
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
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1',
            'order_direction' => 'nullable|in:asc,desc',
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.integer' => 'O campo per_page deve ser um número inteiro.',
            'per_page.min' => 'O campo per_page deve ser no mínimo 1.',
            'per_page.max' => 'O campo per_page deve ser no máximo 100.',
            'page.integer' => 'O campo page deve ser um número inteiro.',
            'page.min' => 'O campo page deve ser no mínimo 1.',
            'order_direction.in' => 'O campo order_direction deve ser "ASC" ou "DESC".',
        ];
    }   
}
