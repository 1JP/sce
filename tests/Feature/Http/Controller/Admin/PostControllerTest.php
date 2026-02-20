<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Category;
use App\Models\IndicativeRating;
use App\Models\Post;
use RahulHaque\Filepond\Facades\Filepond;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class, SettingSeeder::class]);
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * Test the store method to ensure a post is created correctly with Filepond images.
     * 
     * This test fakes the public storage to avoid writing real files,
     * mocks the Filepond class to simulate moving a temporary file,
     * sends a POST request to create a post with a category, indicative rating,
     * and a simulated Filepond temporary ID for the image,
     * and then asserts that both the post and the associated image record
     * are correctly stored in the database.
     */
    public function test_store_post(): void
    {
        Storage::fake('public');

        $category = Category::factory()->create();
        $indicative_rating = IndicativeRating::factory()->create();

        Mockery::mock('alias:' . Filepond::class)
            ->shouldReceive('field')
            ->andReturnSelf()
            ->shouldReceive('moveTo')
            ->andReturn([
                'location' => 'posts/post_1_0.jpg'
            ]);

        $this->post(route('admin.posts.store'), [
            'name' => 'Teste post',
            'description' => fake()->text(),
            'category_id' => $category->id,
            'indicative_rating_id' => $indicative_rating->id,
            'images' => [
                'fake-temp-id-123'
            ],
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'Teste post',
            'user_id' => $this->user->id,
        ]);
        
        $post = Post::first();
        
        $this->assertDatabaseHas('post_images', [
            'post_id' => $post->id,
            'name' => 'posts/post_1_0.jpg',
        ]);
    }

    /**
     * Test the update method to ensure a post can be edited correctly with Filepond images.
     * 
     * This test fakes the public storage to avoid writing real files,
     * creates a post with a category and indicative rating,
     * mocks the Filepond class to simulate moving a temporary image file,
     * sends a PUT request to update the post with new name, description, category,
     * indicative rating, and a simulated Filepond temporary ID for the image,
     * and then asserts that both the updated post and the new image record
     * are correctly stored in the database.
     */
    public function test_edit_post(): void
    {
        Storage::fake('public');

        $post = Post::factory()->create([
            'name' => 'Teste update post',
            'description' => fake()->text(),
            'user_id' => $this->user->id,
            'category_id' => Category::factory()->create(['name' => 'Teste'])->id,
            'indicative_rating_id' => IndicativeRating::factory()->create(['name' => 'Teste'])->id,
        ]);

        $category = Category::factory()->create();
        $indicative_rating = IndicativeRating::factory()->create();

        Mockery::mock('alias:' . Filepond::class)
            ->shouldReceive('field')
            ->andReturnSelf()
            ->shouldReceive('moveTo')
            ->andReturn([
                'location' => 'posts/post_1_0.jpg'
            ]);

        $this->put(route('admin.posts.update', $post->id), [
            'name' => 'Teste post',
            'description' => fake()->text(),
            'category_id' => $category->id,
            'indicative_rating_id' => $indicative_rating->id,
            'images' => [
                'fake-temp-id-123'
            ],
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => 'Teste post',
            'user_id' => $this->user->id,
            'category_id' => $category->id,
            'indicative_rating_id' => $indicative_rating->id,
        ]);
        
        $post = Post::first();
        
        $this->assertDatabaseHas('post_images', [
            'post_id' => $post->id,
            'name' => 'posts/post_1_0.jpg',
        ]);
    }

    /**
     * Test the destroy method to ensure a post can be soft deleted correctly.
     * 
     * This test creates a post, sends a DELETE request to remove it,
     * and then asserts that the post is soft deleted in the database.
     * Soft deletion means the post record still exists but has a deleted_at timestamp.
     */
    public function test_destroy_post(): void
    {
        $post = Post::factory()->create();

        $this->delete(route('admin.posts.destroy', $post->id));
        
        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }

    /**
     * Clean up after each test.
     *
     * This method closes any Mockery mocks to prevent
     * leftover mock objects from affecting other tests,
     * and then calls the parent tearDown method to perform
     * any additional framework cleanup.
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
