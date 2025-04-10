<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'plan_id' => 'required|exists:plans,id',
            'name' => 'required|string',
            'year' => 'required|string',
            'cpf' => 'required|string',
            'number_card' => 'required|string',
            'month' => 'required|string',
            'cvv' => 'required|integer',
            'birth_date' => 'required|string',
            'phone' => 'required|string',
            'postal_code' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'locality' => 'required|string',
            'city' => 'required|string',
            'region_code' => 'required|string',
            'country' => 'nullable|string',
            'area' => 'nullable|string',
            'complement' => 'nullable|string',
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
            'number_card' => preg_replace('/\D/', '', $this->number_card),
            'phone' => $number,
            'cvv' => (int)$this->cvv,
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
            'plan_id.required' => 'O plano é obrigatória.',
            'plan_id.exists' => 'O plano selecionado é inválido.',

            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',

            'phone.required' => 'O telefone é obrigatório.',
            'phone.string' => 'O telefone deve ser um texto.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser um texto.',
            
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

            'year.required' => 'O ano é obrigatório.',
            'year.string' => 'O ano deve ser um texto.',

            'month.required' => 'O ano é obrigatório.',
            'month.string' => 'O ano deve ser um texto.',

            'number_card.required' => 'O número do cartão é obrigatório.',
            'number_card.string' => 'O número do cartão deve ser um texto.',

            'cvv.required' => 'O código de segurança é obrigatório.',
        ];
    }
}
