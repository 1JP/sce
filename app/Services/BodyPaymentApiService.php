<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class BodyPaymentApiService
{

    /**
     * Create a plan body for a payment system.
     * This function generates an array with details for creating a plan, such as the amount, payment method, and description.
     *
     * @param int $value The value of the plan (though not used in this function).
     * @param string $name The name of the plan.
     * @param string $decription The description of the plan.
     * @return array The body data used to create a payment plan.
     */
    public function bodyCreatePlan(Int $value, String $name, String $decription)
    {
        return [
            "amount" => [
                "currency" => "BRL",
                "value" => $value
            ],
            "interval" => [
                "unit" => "MONTH",
                "length" => 1
            ],
            "trial" => [
                "enabled" => false,
                "hold_setup_fee" => false
            ],
            "payment_method" => [
                "CREDIT_CARD"
            ],
            "name" => $name,
            "description" => $decription
        ];

    }

    public function bodyCreateCustomer(array $data)
    {
        $body = [
            "address" => [
                "street" => $data['street'],
                "number" => $data['number'],
                "locality" => $data['locality'],
                "city" => $data['city'],
                "region_code" => $data['region_code'],
                "postal_code" => $data['postal_code'],
                "country" => "BRA"
            ],
            "billing_info" => [
                [
                    "card" => [
                        "holder" => [
                            "phone" => [
                                "country" => "55",
                                "area" => $data['area'],
                                "number" => $data['phone']
                            ],
                            "name" => $data['name'],
                            "birth_date" => $data['birth_date'],
                            "tax_id" => $data['cpf']
                        ],
                        "number" => $data['number_card'],
                        "security_code" => $data['cvv'],
                        "exp_year" => $data['year'],
                        "exp_month" => $data['month']
                    ],
                    "type" =>"CREDIT_CARD"
                ]
            ],
            "name" => $data['name'],
            "email" => 'joaopedro@gmail.com',//Auth::user()->email,
            "birth_date" => $data['birth_date'],
            "tax_id" => $data['cpf'],
            "phones" => [
                [
                    "country" => "55",
                    "area" => $data['area'],
                    "number" => $data['phone']
                ]
            ]
        ];

        return $body;
    }
}
