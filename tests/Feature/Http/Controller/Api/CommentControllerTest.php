<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Comment;
use App\Models\Deslink;
use App\Models\Link;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_comment_counts_grouped_by_month_for_given_year(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'description' => 'Primeiro comentário',
            'created_at' => '2026-01-15 12:00:00',
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'description' => 'Segundo comentário',
            'created_at' => '2026-02-15 12:00:00',
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'description' => 'Terceiro comentário',
            'created_at' => '2026-03-15 12:00:00',
        ]);

        Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'description' => 'Comentário do ano anterior',
            'created_at' => '2025-01-15 12:00:00',
        ]);

        $response = $this->getJson('/api/comments/chartline?year=2026');

        $response
            ->assertOk()
            ->assertJsonPath('year', 2026)
            ->assertJsonPath('labels.0', 'Janeiro')
            ->assertJsonPath('labels.1', 'Fevereiro')
            ->assertJsonPath('labels.2', 'Março')
            ->assertJsonPath('counts.0', 1)
            ->assertJsonPath('counts.1', 1)
            ->assertJsonPath('counts.2', 1);
    }

    public function test_it_returns_link_and_deslink_counts_grouped_by_month_for_given_year(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'description' => 'Comentário base',
            'created_at' => '2026-01-15 12:00:00',
        ]);

        Link::query()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => $comment->id,
            'created_at' => '2026-01-15 12:00:00',
        ]);

        Deslink::query()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => $comment->id,
            'created_at' => '2026-02-15 12:00:00',
        ]);

        $linkResponse = $this->getJson('/api/links/chartline?year=2026');
        $deslinkResponse = $this->getJson('/api/deslinks/chartline?year=2026');

        $linkResponse->assertOk()->assertJsonPath('year', 2026)->assertJsonPath('counts.0', 1);
        $deslinkResponse->assertOk()->assertJsonPath('year', 2026)->assertJsonPath('counts.1', 1);
    }
}
