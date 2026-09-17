<?php

namespace Tests\Feature\Http\Controller;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Services\SentimentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class SiteCommentControllerTeste extends TestCase
{
    use RefreshDatabase;

    protected $sentimentService;

    protected function setUp(): void
    {
        parent::setUp();

        config(['HUGGINGFACE_TOKEN' => 'fake-token']);
        config(['HUGGINGFACE_MODEL' => 'fake-model']);

        $this->sentimentService = Mockery::mock(SentimentService::class);
        $this->app->instance(SentimentService::class, $this->sentimentService);
    }

    /**
     * Tests that an authenticated user can successfully create a comment.
     * Mocks the SentimentService to return a positive label,
     * then asserts the comment is persisted in the database with correct data.
     */
    public function test_it_creates_a_comment_successfully()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->sentimentService
            ->shouldReceive('analyze')
            ->once()
            ->andReturn((object) ['label' => 'positive']);

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Ótimo post!',
            'post_id'     => $post->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'description' => 'Ótimo post!',
            'post_id'     => $post->id,
            'user_id'     => $user->id,
            'sentiment'   => 'positive',
        ]);
    }

    /**
     * Tests that submitting a comment with the same post_id, user_id and comment_id
     * updates the existing record instead of creating a duplicate.
     * Mocks the SentimentService to return a neutral label,
     * then asserts the comment was updated in the database.
     */
    public function test_it_updates_a_comment_if_already_exists()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Comment::factory()->create([
            'user_id'    => $user->id,
            'post_id'    => $post->id,
            'comment_id' => null,
        ]);

        $this->sentimentService
            ->shouldReceive('analyze')
            ->once()
            ->andReturn((object) ['label' => 'neutral']);

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Comentário editado',
            'post_id'     => $post->id,
            'comment_id'  => null,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'description' => 'Comentário editado',
            'post_id'     => $post->id,
            'user_id'     => $user->id,
            'sentiment'   => 'neutral',
        ]);
    }

    /**
     * Tests that an authenticated user can reply to an existing comment.
     * Creates a parent comment, mocks the SentimentService to return a positive label,
     * then asserts the reply is persisted in the database linked to the parent comment.
     */
    public function test_it_creates_a_reply_to_a_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $parentComment = Comment::factory()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        $this->sentimentService
            ->shouldReceive('analyze')
            ->once()
            ->andReturn((object) ['label' => 'positive']);

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Resposta ao comentário',
            'post_id'     => $post->id,
            'comment_id'  => $parentComment->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('comments', [
            'description' => 'Resposta ao comentário',
            'post_id'     => $post->id,
            'user_id'     => $user->id,
            'comment_id'  => $parentComment->id,
        ]);
    }

    /**
     * Tests that when the SentimentService throws an exception,
     * the controller handles the error gracefully by redirecting back
     * with a danger message and not persisting the comment in the database.
     */
    public function test_it_returns_error_when_sentiment_service_fails()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->sentimentService
            ->shouldReceive('analyze')
            ->once()
            ->andThrow(new \Exception('SentimentService API error'));

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Comentário com erro',
            'post_id'     => $post->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('danger');

        $this->assertDatabaseMissing('comments', [
            'description' => 'Comentário com erro',
        ]);
    }

    /**
     * Tests that an unauthenticated user is redirected to the login page
     * when attempting to store a comment.
     */
    public function test_it_requires_authentication_to_store_comment()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store'), [
            'description' => 'Comentário sem login',
            'post_id'     => $post->id,
        ]);

        $response->assertRedirect(route('login'));
    }

    /**
     * Tests that the description field is required when storing a comment.
     * Asserts that a validation error is returned when description is not provided.
     */
    public function test_it_requires_description()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'post_id' => $post->id,
        ]);

        $response->assertSessionHasErrors(['description']);
    }

    /**
     * Tests that the post_id must exist in the database when storing a comment.
     * Asserts that a validation error is returned when an invalid post_id is provided.
     */
    public function test_it_requires_valid_post_id()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Comentário',
            'post_id'     => 99999,
        ]);

        $response->assertSessionHasErrors(['post_id']);
    }

    /**
     * Tests that the comment_id must exist in the database when provided.
     * Asserts that a validation error is returned when an invalid comment_id is provided.
     */
    public function test_it_requires_valid_comment_id_when_provided()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Resposta',
            'post_id'     => $post->id,
            'comment_id'  => 99999,
        ]);

        $response->assertSessionHasErrors(['comment_id']);
    }

    /**
     * Tests that the user_id must exist in the database when provided.
     * Asserts that a validation error is returned when an invalid user_id is provided.
     */
    public function test_it_requires_valid_user_id_when_provided()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Comentário',
            'post_id'     => $post->id,
            'user_id'     => 99999,
        ]);

        $response->assertSessionHasErrors(['user_id']);
    }

    /**
     * Tests that a comment can be stored without providing optional fields (comment_id, user_id).
     * Asserts that no validation errors are returned and the comment is created successfully.
     */
    public function test_it_accepts_comment_without_optional_fields()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->sentimentService
            ->shouldReceive('analyze')
            ->once()
            ->andReturn((object) ['label' => 'positive']);

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'description' => 'Comentário simples',
            'post_id'     => $post->id,
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    /**
     * Tests that an authenticated user can successfully delete their own comment.
     * Asserts that the comment is soft deleted from the database.
     */
    public function test_it_deletes_a_comment_successfully()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)->delete(route('comments.destroy', $comment->id));

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertSoftDeleted('comments', [ // 👈 troca aqui
            'id' => $comment->id,
        ]);
    }

    /**
     * Tests that an authenticated user cannot delete another user's comment.
     * Asserts that a 403 Forbidden response is returned
     * and the comment remains in the database.
     */
    public function test_it_prevents_deleting_another_users_comment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)->delete(route('comments.destroy', $comment->id));

        $response->assertForbidden();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
        ]);
    }

    /**
     * Closes all Mockery mock objects after each test
     * to prevent memory leaks and mock interference between tests.
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}