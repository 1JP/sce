<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Deslink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeslinkTest extends TestCase
{
    use RefreshDatabase;

    protected $post;
    protected $user;
    protected $comment;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();

        $this->comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);
    }

    /**
     * Test the creation of a Deslink for both post and comment, ensuring that the correct relationships are established.
     */
    public function test_create_deslink(): void
    {
        $linkPost = Deslink::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $this->assertEquals($this->post->id, $linkPost->post_id);
        $this->assertEquals($this->user->id, $linkPost->user_id);

        $linkComment = Deslink::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' => $this->comment->id,
        ]);

        $this->assertEquals($this->comment->id, $linkComment->comment_id);
        $this->assertEquals($this->user->id, $linkComment->user_id);
    }

    /**
     * Test the deletion of a Deslink, ensuring that the record is removed from the database.
     */
    public function test_delete_deslink(): void
    {
        $link = Deslink::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'comment_id' => $this->comment->id,
        ]);

        $this->assertDatabaseHas('deslinks', [
            'id' => $link->id,
        ]);

        $link->delete();

        $this->assertDatabaseMissing('deslinks', [
            'id' => $link->id,
        ]);
    }

    /**
     * Test that a Deslink cannot be created with invalid data.
     */
    public function test_not_create_all_wrong_data_deslink(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Deslink::factory()->create([
            'post_id' => 999999,
            'user_id' => 999999,
        ]);
    }
}