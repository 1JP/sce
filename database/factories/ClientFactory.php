<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::create();

        $areaCode = function () {
            $ddds = ['11', '21', '31', '41', '51', '61', '71', '81', '91'];
            return $ddds[array_rand($ddds)];
        };

        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'street' => $faker->streetName(),
            'number' => $faker->buildingNumber(),
            'locality' => $faker->streetName(),
            'city' => $faker->city(),
            'region_code' => 'MG',
            'postal_code' => '99999999',
            'complement' => $faker->secondaryAddress(),
            'birth_date' => $faker->date(),
            'cpf' => fake()->unique()->text(11),
            'country' => '55',
            'area' => $areaCode(),
            'phone' => preg_replace('/\D/', '', $faker->phoneNumber()),
            'customer_id' => fake()->text(100),
            'cvv' => fake()->randomDigit(),
        ];
    }
}
