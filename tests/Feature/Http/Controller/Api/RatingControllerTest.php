<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Post;
use App\Models\PostRating;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([RolesSeeder::class]);
        $this->user = User::factory()->create()->assignRole('Usuario');
    }

    /** 
     * Test that the unauthenticated user cannot store a rating.
     */
    public function test_unauthenticated_user_cannot_store_rating(): void
    {
        $post = Post::factory()->create();

        $this->postJson(route('api.ratings.store'), [
            'post_id' => $post->id,
            'rating' => 8,
        ])->assertUnauthorized();
    }

    /* 
     * Test that the authenticated user can store a rating.
     */
    public function test_authenticated_user_can_store_rating(): void
    {
        $post = Post::factory()->create();

        $response = $this->actingAs($this->user)
            ->postJson(route('api.ratings.store'), [
                'post_id' => $post->id,
                'rating' => 8,
            ]);

        $response->assertOk()
            ->assertJson([
                'average_rating' => 7.1,
                'note' => 8,
                'message' => 'Avaliação salva com sucesso.',
            ]);

        $this->assertDatabaseHas('post_ratings', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
            'rating' => 8,
        ]);
    }

    /** 
     * Test that the authenticated user can update their existing rating.
     */
    public function test_authenticated_user_can_update_existing_rating(): void
    {
        $post = Post::factory()->create();

        PostRating::create([
            'user_id' => $this->user->id,
            'post_id' => $post->id,
            'rating' => 5,
        ]);

        $response = $this->actingAs($this->user)
            ->postJson(route('api.ratings.store'), [
                'post_id' => $post->id,
                'rating' => 9,
            ]);

        $response->assertOk()
            ->assertJson([
                'average_rating' => 7.2,
                'note' => 9,
            ]);

        $this->assertDatabaseHas('post_ratings', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
            'rating' => 9,
        ]);

        $this->assertDatabaseMissing('post_ratings', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
            'rating' => 5,
        ]);
    }

    /**
     *  Test that the user can get their rating for a post.
     * */
    public function test_user_can_get_their_rating_for_a_post(): void
    {
        $post = Post::factory()->create();

        $rating = PostRating::create([
            'user_id' => $this->user->id,
            'post_id' => $post->id,
            'rating' => 6,
        ]);

        $response = $this->actingAs($this->user)
            ->getJson(route('api.ratings.get', [
                'user' => $this->user->id,
                'post' => $post->id,
            ]));

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $rating->id,
                    'post_id' => $post->id,
                    'user_id' => $this->user->id,
                    'rating' => 6,
                ],
            ]);
    }

    /**
     *  Test that the rating must be between 0 and 10. 
     * */
    public function test_rating_must_be_between_0_and_10(): void
    {
        $post = Post::factory()->create();

        $this->actingAs($this->user)
            ->postJson(route('api.ratings.store'), [
                'post_id' => $post->id,
                'rating' => 11,
            ])
            ->assertUnprocessable();
    }
}
