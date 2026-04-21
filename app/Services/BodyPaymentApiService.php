<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class BodyPaymentApiService
{
    private bool $sandbox;

    public function __construct() {
        $sandboxBody = Setting::where('name', 'sandbox-payment')->first();
        $this->sandbox = $sandboxBody->body == "1";
    }

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
                "enabled" => $this->sandbox,
                "hold_setup_fee" => $this->sandbox
            ],
            "payment_method" => [
                "CREDIT_CARD"
            ],
            "name" => $name,
            "description" => $decription
        ];

    }

    /**
     * Build the request payload for creating a customer in the payment gateway.
     *
     * This method assembles the customer's address, billing information (credit card details),
     * and personal data into the expected API format.
     *
     * Expected keys in $data:
     * - street, number, locality, city, region_code, postal_code
     * - area, phone
     * - name, birth_date, cpf
     * - number_card, cvv, year, month
     *
     * @param array $data Customer input data
     * @return array Formatted request body
     */
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
            "email" => Auth::user()->email,
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

    /**
     * Build the request payload for creating a subscription.
     *
     * This method retrieves the selected plan and formats the required data
     * into the structure expected by the payment API, including plan reference,
     * customer identification, and payment method (credit card).
     *
     * Expected keys in $data:
     * - plan_id
     * - customer_id
     * - cvv
     *
     * @param array $data Subscription input data
     * @return array Formatted request body
     */
    public function bodyCreateSubscription(array $data)
    {
        $plan = Plan::find($data['plan_id']);

        $body = [
            "plan" => [
                "id" => $plan->customer_id
            ],
            "customer" => [
                "id" => $data['customer_id']
            ],
            "payment_method" => [
                [
                    "type" => "CREDIT_CARD",
                    "card" => [
                        "security_code" => $data['cvv']
                    ]
                ]
            ]
        ];

        return $body;
    }
}
