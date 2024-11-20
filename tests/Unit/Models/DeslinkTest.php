<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Deslink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class DeslinkTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    protected $post;

    /** @var User */
    protected $user;

    /** @var Comment */
    protected $comment;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create();
        $this->comment = Comment::factory()->create();

    }

    /**
     * test create deslink
     */
    public function test_create_deslink(): void
    {
        $linkPost = Deslink::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $this->assertEquals($linkPost->post_id, $this->post->id);
        $this->assertEquals($linkPost->user_id, $this->user->id);

        $linkComment = Deslink::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' => $this->comment->id,
        ]);

        $this->assertEquals($linkComment->comment_id, $this->comment->id);
        $this->assertEquals($linkComment->user_id, $this->user->id);
    }

    /** 
     * test delete deslink 
     */
    public function test_delete_deslink():void
    {
        $linkComment = Deslink::factory()->create();

        $this->assertDatabaseHas('links', [
            'user_id' => $linkComment->user_id,
            'comment_id' => $linkComment->comment_id,
        ]);

        $linkComment->delete();

        $this->assertDatabaseMissing('links', [
            'user_id' => $linkComment->user_id,
            'comment_id' => $linkComment->comment_id,
        ]);

    }

    /** 
     * test not create deslink all wrong data
     */
    public function test_not_create_all_wrong_data_deslink(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Deslink::factory()->create([
            'post_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
        ]);

        Deslink::factory()->create([
            'comment_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
        ]);
    }
}
