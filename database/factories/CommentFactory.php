<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id' => null,
            'comment_id' => null,
            'user_id' => null,
            'description' => fake()->text(),
            'sentiment'   => fake()->randomElement(['positive', 'negative', 'neutral']),
        ];
    }
}