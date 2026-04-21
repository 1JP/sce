<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['Admin', 'Root']);
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
            'category_type_id' => 'required|array',
            'category_type_id.*' => 'required|exists:category_types,id',
            'active' => 'nullable',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório.',
            'category_type_id.required' => 'A categoria de tipo é obrigatória.',
            'category_type_id.*.exists' => 'Um ou mais tipos de categoria são inválidos.',
        ];
    }
}
