<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    protected $post;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
    }

    /**
     * test create comment
     */
    public function test_create_comment(): void
    {
        $description = fake()->text(100);

        $commentPost = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'comment' => $description,
        ]);

        $this->assertEquals($commentPost->post_id, $this->post->id);
        $this->assertEquals($commentPost->user_id, $this->user->id);
        $this->assertEquals($commentPost->comment, $description);

        $descriptionComment = fake()->text(100);

        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' => $commentPost->id,
            'comment' => $descriptionComment,
        ]);

        $this->assertEquals($comment->user_id, $this->user->id);
        $this->assertEquals($comment->comment_id, $commentPost->id);
        $this->assertEquals($comment->comment, $descriptionComment);
    }

    /**
     * test update comment
     */
    public function test_update_comment(): void
    {
        $description = fake()->text(100);

        $commentPost = Comment::factory()->create();
        $commentPost->update([
            'comment' => $description,
        ]);

        $this->assertEquals($commentPost->comment, $description);

        $descriptionComment = fake()->text(100);

        $comment = Comment::factory()->create();
        $comment->update([
            'comment' => $descriptionComment,
        ]);

        $this->assertEquals($comment->comment, $descriptionComment);
    }

    /** 
     * test delete post 
     */
    public function test_delete_post():void
    {
        $comment = Comment::factory()->create();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
        ]);

        $comment->delete();

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }

    /** 
     * test not create comment all wrong data
     */
    public function test_not_create_all_wrong_data_comment(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Comment::factory()->create([
            'post_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
            'description' => fake()->randomDigit(),
        ]);

        Comment::factory()->create([
            'comment_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
            'description' => '',
        ]);
    }
}
