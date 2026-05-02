<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Comment;
use App\Models\Link;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinkControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
        $this->user = User::factory()->create()->assignRole('Usuario');
    }

    /**
     * Ensures that a guest (unauthenticated) user receives a 401 Unauthorized
     * response when attempting to call the store endpoint.
     */
    public function test_unauthenticated_user_cannot_store_link(): void
    {
        $post = Post::factory()->create();
 
        $this->postJson(route('api.links.store'), ['post_id' => $post->id])
            ->assertUnauthorized();
    }
    
    /**
     * Verifies that an authenticated user can successfully link a post,
     * receiving a 200 response with countPost = 1 and the record persisted in the database.
     */
    public function test_authenticated_user_can_link_a_post(): void
    {
        $post = Post::factory()->create();
 
        $response = $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => $post->id]);
 
        $response->assertOk()
            ->assertJsonStructure(['countPost', 'countComment'])
            ->assertJson(['countPost' => 1, 'countComment' => 0]);
 
        $this->assertDatabaseHas('links', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
        ]);
    }
    
    /**
     * Verifies that calling store on an already linked post toggles it off,
     * removing the record from the database and returning countPost = 0.
     */
    public function test_authenticated_user_can_unlink_a_post(): void
    {
        $post = Post::factory()->create();
 
        Link::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $post->id,
        ]);
 
        $response = $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => $post->id]);
 
        $response->assertOk()
            ->assertJson(['countPost' => 0, 'countComment' => 0]);
 
        $this->assertDatabaseMissing('links', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
        ]);
    }
    
    /**
     * Ensures that countPost in the response reflects the total number of links
     * on the post from all users, not just the authenticated one.
     */
    public function test_count_post_reflects_all_users_links_on_post(): void
    {
        $post = Post::factory()->create();
 
        Link::factory()->count(3)->create([
            'post_id' => $post->id,
            'user_id' => User::factory()->create()->id,
        ]);
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => $post->id])
            ->assertOk()
            ->assertJson(['countPost' => 4]); // 3 existing + 1 new
    }
    
    /**
     * Verifies that an authenticated user can successfully link a comment,
     * receiving a 200 response with countComment = 1 and the record persisted in the database.
     */
    public function test_authenticated_user_can_link_a_comment(): void
    {
        $comment = Comment::factory()->create([
            'post_id' => Post::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ]);
 
        $response = $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => $comment->id]);
 
        $response->assertOk()
            ->assertJson(['countPost' => 0, 'countComment' => 1]);
 
        $this->assertDatabaseHas('links', [
            'user_id'    => $this->user->id,
            'comment_id' => $comment->id,
        ]);
    }
 
    /**
     * Verifies that calling store on an already linked comment toggles it off,
     * removing the record from the database and returning countComment = 0.
     */
    public function test_authenticated_user_can_unlink_a_comment(): void
    {
        $comment = Comment::factory()->create([
            'post_id' => Post::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ]);
 
        Link::factory()->create([
            'user_id'    => $this->user->id,
            'comment_id' => $comment->id,
        ]);
 
        $response = $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => $comment->id]);
 
        $response->assertOk()
            ->assertJson(['countPost' => 0, 'countComment' => 0]);
 
        $this->assertDatabaseMissing('links', [
            'user_id'    => $this->user->id,
            'comment_id' => $comment->id,
        ]);
    }
 
    /**
     * Ensures that countComment in the response reflects the total number of links
     * on the comment from all users, not just the authenticated one.
     */
    public function test_count_comment_reflects_all_users_links_on_comment(): void
    {
        $comment = Comment::factory()->create([
            'post_id' => Post::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ]);
 
        Link::factory()->count(2)->create([
            'comment_id' => $comment->id,
            'user_id'    => User::factory()->create()->id,
        ]);
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => $comment->id])
            ->assertOk()
            ->assertJson(['countComment' => 3]);
    }

    /**
     * Ensures that passing a non-integer value for post_id fails validation
     * and returns a 422 Unprocessable Entity response.
     */
    public function test_post_id_must_be_integer(): void
    {
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => 'abc'])
            ->assertUnprocessable();
    }

    /**
     * Ensures that passing a non-integer value for comment_id fails validation
     * and returns a 422 Unprocessable Entity response.
     */
    public function test_comment_id_must_be_integer(): void
    {
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => 'abc'])
            ->assertUnprocessable();
    }

    /**
     * Verifies that every successful response always includes both
     * countPost and countComment keys in the JSON payload.
     */
    public function test_response_always_contains_both_count_keys(): void
    {
        $post = Post::factory()->create();
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => $post->id])
            ->assertJsonStructure(['countPost', 'countComment']);
    }
 
    /**
     * Verifies that countComment is returned as 0 when only post_id is sent,
     * since no comment interaction was performed.
     */
    public function test_count_comment_is_zero_when_only_post_id_is_sent(): void
    {
        $post = Post::factory()->create();
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['post_id' => $post->id])
            ->assertJson(['countComment' => 0]);
    }
 
    /**
     * Verifies that countPost is returned as 0 when only comment_id is sent,
     * both on link and on subsequent unlink, since no post interaction was performed.
     */
    public function test_count_post_is_zero_when_only_comment_id_is_sent(): void
    {
        $comment = Comment::factory()->create([
            'post_id' => Post::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ]);
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => $comment->id])
            ->assertJson(['countPost' => 0]);
 
        $this->actingAs($this->user)
            ->postJson(route('api.links.store'), ['comment_id' => $comment->id])
            ->assertJson(['countPost' => 0]);
    }
}