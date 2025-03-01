<?php

namespace App\Services;

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
}
