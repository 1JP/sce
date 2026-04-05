<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            // PAYMENTS
            'payments.url_sanbox_payment' => ['required', 'url'],
            'payments.url_prod_payment' => ['required', 'url'],
            'payments.token_payment' => ['required', 'string'],
            'payments.public_key_payment' => ['required', 'string'],

            // COMPANY
            'company.name' => ['required', 'string', 'max:255'],
            'company.cnpj' => ['required', 'string', 'max:18'],
            'company.email' => ['required', 'email'],
            'company.facebook' => ['nullable', 'url'],
            'company.twitter' => ['nullable', 'url'],
            'company.youtube' => ['nullable', 'url'],
            'company.instagram' => ['nullable', 'url'],

            // ADDRESS
            'address.cep' => ['required', 'string', 'max:9'],
            'address.street' => ['required', 'string'],
            'address.number' => ['required', 'string'],
            'address.complement' => ['nullable', 'string'],
            'address.neighborhood' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.state' => ['required', 'string', 'size:2'],

            // OUTROS
            'site.description' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->company && isset($this->company['cnpj'])) {
            $this->merge([
                'company' => array_merge($this->company, [
                    'cnpj' => preg_replace('/\D/', '', $this->company['cnpj'])
                ])
            ]);
        }
    }

    public function messages(): array
    {
        return [
            // COMPANY
            'company.name.required' => 'A razão social é obrigatória.',
            'company.cnpj.required' => 'O CNPJ é obrigatório.',
            'company.email.required' => 'O e-mail é obrigatório.',
            'company.email.email' => 'Informe um e-mail válido.',

            // ADDRESS
            'address.cep.required' => 'O CEP é obrigatório.',
            'address.street.required' => 'O endereço é obrigatório.',
            'address.number.required' => 'O número é obrigatório.',
            'address.neighborhood.required' => 'O bairro é obrigatório.',
            'address.city.required' => 'A cidade é obrigatória.',
            'address.state.required' => 'O estado é obrigatório.',
            'address.state.size' => 'O estado deve ter 2 caracteres.',

            // PAYMENTS
            'payments.url_prod_payment.required' => 'A URL de produção é obrigatória.',
            'payments.url_sanbox_payment.required' => 'A URL de sandbox é obrigatória.',
            'payments.token_payment.required' => 'O token é obrigatório.',
            'payments.public_key_payment.required' => 'A chave pública é obrigatória.',

            // OUTROS
            'site.description.required' => 'A descrição é obrigatória.',
        ];
    }
}
