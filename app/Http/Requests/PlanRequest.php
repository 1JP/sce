<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'description' => 'required|string',
            'number_film' => 'required|integer',
            'number_serie' => 'required|integer',
            'number_book' => 'required|integer',
            'value' => 'required|string',
            'active' => 'nullable'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'number_film' => (int)$this->number_film,
            'number_serie' => (int)$this->number_serie,
            'number_book' => (int)$this->number_book,
            'value' => str_replace(['.', ','], ['', '.'], $this->value)
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
            'name.required' => 'O nome do plano é obrigatório.',
            'description.required' => 'A descrição do plano é obrigatório.',
            'number_film.required' => 'O número de filmes é obrigatório.',
            'number_serie.required' => 'O número de series é obrigatório.',
            'number_book.required' => 'O número de livros é obrigatório.',
            'value.required' => 'O valor é obrigatório.',
        ];
    }
}
