<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\IndicativeRating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'indicative_rating_id' => IndicativeRating::factory(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'note' => fake()->randomFloat(2,0,100),
        ];
    }
}
