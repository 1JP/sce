<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'rating' => 'required|numeric|min:0|max:10',
        ];
    }

    /**
     * Get custom error messages for validation failures.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'post_id.required' => 'O campo post_id é obrigatório.',
            'post_id.exists' => 'O post selecionado não existe.',
            'rating.required' => 'O campo rating é obrigatório.',
            'rating.numeric' => 'O campo rating deve ser um número.',
            'rating.min' => 'O campo rating deve ser no mínimo 0.',
            'rating.max' => 'O campo rating deve ser no máximo 10.',
        ];
    }
}
