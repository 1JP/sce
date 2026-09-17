<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * Test creating a comment on a post
     */
    public function test_create_comment_on_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $this->assertNotNull($comment->id);
        $this->assertEquals($user->id, $comment->user_id);
        $this->assertEquals($post->id, $comment->post_id);
    }

    /**
     * Test creating a reply to a comment
     */
    public function test_create_reply_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $parent = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $reply = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment_id' => $parent->id,
        ]);

        $this->assertNotNull($reply->id);
        $this->assertEquals($parent->id, $reply->comment_id);
    }

    /**
     * Test updating a comment
     */
    public function test_update_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $newText = 'Comentário atualizado';

        $comment->update([
            'description' => $newText,
        ]);

        $this->assertEquals($newText, $comment->description);
    }

    /**
     * Test deleting a comment
     */
    public function test_delete_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $id = $comment->id;

        $comment->delete();

        $this->assertNull(Comment::find($id));
    }

    /**
     * Test creating comment requires user and post
     */
    public function test_cannot_create_comment_without_required_fields(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Comment::factory()->create([
            'user_id' => null,
            'post_id' => null,
        ]);
    }
}