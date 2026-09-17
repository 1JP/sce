<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class PostImageTest extends TestCase
{
    use RefreshDatabase;

    /** @var Post */
    protected $post;

    public function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
    }

    /**
     * test create post image
     */
    public function test_create_post_image(): void
    {
        $name = 'Test post';

        $post = PostImage::factory()->create([
            'post_id' => $this->post->id,
            'name' => $name,
        ]);

        $this->assertEquals($post->post_id, $this->post->id);
        $this->assertEquals($post->name, $name);
    }

    /**
     * test update post image
     */
    public function test_update_post_image(): void
    {
        $name = 'Test update post';

        $post = PostImage::factory()->create();
        $post->update([
            'name' => $name,
        ]);
        
        $this->assertEquals($post->name, $name);
    }

    /** 
     * test delete post image
     */
    public function test_delete_post_image():void
    {
        $post = PostImage::factory()->create();

        $this->assertDatabaseHas('post_images', [
            'id' => $post->id,
        ]);

        $post->delete();

        $this->assertDatabaseMissing('post_images', [
            'id' => $post->id,
        ]);
    }

    /** 
     * test not create post all wrong data
     */
    public function test_not_create_all_wrong_data_post(): void
    {
        $this->expectException(InvalidArgumentException::class);

        PostImage::factory()->create([
            'post_id' => fake()->randomDigit(),
            'name' => fake()->randomDigit(),
        ]);
    }
}
