<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\PostLimitService;
use Illuminate\Validation\ValidationException;

class PostAction
{
    /**
     * Service responsible for checking post limits based on the user's plan.
     *
     * @var PostLimitService
     */
    private readonly PostLimitService $limitService;

    /**
     * Class constructor to initialize the service for PostLimitService.
     *
     * @param PostLimitService $limitService The service used to check post limits.
     */
    public function __construct(PostLimitService $limitService)
    {
        $this->limitService = $limitService;
    }

    /**
     * Executes the post creation logic.
     * Checks if the user has reached the post limit for the given category before creating.
     *
     * @param User  $user      The authenticated user creating the post.
     * @param array $validated The validated data from the request.
     *
     * @throws ValidationException If the user has reached the post limit for the category.
     * 
     * @return Post The newly created post.
     */
    public function execute(User $user, array $validated): Post
    {
        $category = Category::find($validated['category_id']);

        if ($this->limitService->hasReachedLimit($user, $category)) {
            throw ValidationException::withMessages([
                'category_id' => $this->limitService->getLimitMessage($category),
            ]);
        }

        return $user->posts()->create($validated);
    }
}