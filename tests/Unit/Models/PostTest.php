<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\IndicativeRating;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @var IndicativeRating */
    protected $indicate;
    
    /** @var Category */
    protected $category;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->indicate = IndicativeRating::factory()->create();
        $this->category = Category::factory()->create();
    }

    /**
     * test create post
     */
    public function test_create_post(): void
    {
        $name = 'Test post';
        $description = fake()->text();
        $note = 9.0;

        $post = Post::factory()->create([
            'indicative_rating_id' => $this->indicate->id,
            'category_id' => $this->category->id,
            'user_id' => $this->user->id,
            'name' => $name,
            'description' => $description,
            'note' => $note
        ]);

        $this->assertEquals($post->indicative_rating_id, $this->indicate->id);
        $this->assertEquals($post->category_id, $this->category->id);
        $this->assertEquals($post->user_id, $this->user->id);
        $this->assertEquals($post->name, $name);
        $this->assertEquals($post->description, $description);
        $this->assertEquals($post->note, $note);
    }

    /**
     * test update post
     */
    public function test_update_post(): void
    {
        $name = 'Test update post';
        $description = fake()->text();
        $note = 10.0;

        $post = Post::factory()->create();

        $post->update([
            'indicative_rating_id' => $this->indicate->id,
            'category_id' => $this->category->id,
            'user_id' => $this->user->id,
            'name' => $name,
            'description' => $description,
            'note' => $note
        ]);

        $this->assertEquals($post->indicative_rating_id, $this->indicate->id);
        $this->assertEquals($post->category_id, $this->category->id);
        $this->assertEquals($post->user_id, $this->user->id);
        $this->assertEquals($post->name, $name);
        $this->assertEquals($post->description, $description);
        $this->assertEquals($post->note, $note);
    }

    /** 
     * test delete post 
     */
    public function test_delete_post():void
    {
        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);

        $post->delete();

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

    /** 
     * test not create post all wrong data
     */
    public function test_not_create_all_wrong_data_post(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Post::factory()->create([
            'indicative_rating_id' => fake()->randomDigit(),
            'category_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
            'name' => fake()->randomDigit(),
            'description' => fake()->randomDigit(),
            'note'=> fake()->name()
        ]);
    }
}
