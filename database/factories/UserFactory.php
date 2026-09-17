<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
