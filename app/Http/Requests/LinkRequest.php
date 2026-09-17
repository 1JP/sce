<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'post_id' => 'nullable|integer|exists:posts,id',
            'comment_id' => 'nullable|integer|exists:comments,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */    
    public function messages(): array
    {        
        return [
            'post_id.exists' => 'O post especificado não existe.',
            'comment_id.exists' => 'O comentário especificado para resposta não existe.',
        ];
    }   
}
