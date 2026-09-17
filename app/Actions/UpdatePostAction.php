<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\PostLimitService;
use Illuminate\Validation\ValidationException;

class UpdatePostAction
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
     * Executes the post update logic.
     * Checks the post limit only if the category has changed.
     *
     * @param User  $user      The authenticated user updating the post.
     * @param Post  $post      The post being updated.
     * @param array $validated The validated data from the request.
     *
     * @throws ValidationException If the user has reached the post limit for the new category.
     *
     * @return Post The updated post.
     */
    public function execute(User $user, Post $post, array $validated): Post
    {
        $category = Category::find($validated['category_id']);

        // Only checks the limit if the category has changed
        if ($post->category_id !== $category->id) {
            if ($this->limitService->hasReachedLimit($user, $category)) {
                throw ValidationException::withMessages([
                    'category_id' => $this->limitService->getLimitMessage($category),
                ]);
            }
        }

        $post->update($validated);

        return $post->fresh();
    }
}