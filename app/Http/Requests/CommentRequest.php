<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'description' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'comment_id' => 'nullable|exists:comments,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O comentário é obrigatória.',
            'description.string' => 'O comentário deve ser uma string.',
            'post_id.required' => 'O ID do post é obrigatório.',
            'post_id.exists' => 'O post especificado não existe.',
            'comment_id.exists' => 'O comentário especificado para resposta não existe.',
            'user_id.exists' => 'O usuário especificado não existe.',
        ];
    }
}
