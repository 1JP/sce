<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class LinkTest extends TestCase
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
     * test create link
     */
    public function test_create_link(): void
    {
        $linkPost = Link::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
        ]);

        $this->assertEquals($linkPost->post_id, $this->post->id);
        $this->assertEquals($linkPost->user_id, $this->user->id);

        $linkComment = Link::factory()->create([
            'user_id' => $this->user->id,
            'comment_id' => $this->comment->id,
        ]);

        $this->assertEquals($linkComment->comment_id, $this->comment->id);
        $this->assertEquals($linkComment->user_id, $this->user->id);
    }

    /** 
     * test delete link 
     */
    public function test_delete_link():void
    {
        $linkComment = Link::factory()->create();

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
     * test not create link all wrong data
     */
    public function test_not_create_all_wrong_data_link(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Link::factory()->create([
            'post_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
        ]);

        Link::factory()->create([
            'comment_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
        ]);
    }
}
