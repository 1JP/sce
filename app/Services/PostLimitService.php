<?php

namespace App\Services;

use App\Models\User;
use App\Models\Category;

class PostLimitService
{
    /**
     * Maps category names to their corresponding plan limit fields.
     *
     * @var array<string, string>
     */
    private const CATEGORY_LIMIT_MAP = [
        'Filme' => 'number_film',
        'Série' => 'number_serie',
        'Livro' => 'number_book',
    ];

    /**
     * Checks if the user has reached the post limit for a given category.
     *
     * @param User     $user     The authenticated user.
     * @param Category $category The category being checked.
     * 
     * @return bool Returns true if the limit has been reached, false otherwise.
     */
    public function hasReachedLimit(User $user, Category $category): bool
    {
        $limitField = self::CATEGORY_LIMIT_MAP[$category->name] ?? null;

        if (!$limitField) {
            return false;
        }

        $count = $user->posts()->where('category_id', $category->id)->count();
        $limit = $user->subscription->plan->{$limitField};

        return $count >= $limit;
    }

    /**
     * Returns the error message when the user has reached the post limit for a given category.
     *
     * @param Category $category The category that has reached its limit.
     * 
     * @return string The error message to be displayed to the user.
     */
    public function getLimitMessage(Category $category): string
    {
        return "Você já atingiu o limite de {$category->name}s para o seu plano.";
    }
}