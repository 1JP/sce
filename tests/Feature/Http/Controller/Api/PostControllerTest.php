<?php

namespace Tests\Feature\Http\Controller\Api;

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
     * Test the index method to ensure it returns all posts in ascending order by name.
     * 
     * This test creates multiple posts out of order, sends a GET request to the index route,
     * and asserts that the returned posts are ordered by 'name' ascending.
     * It also checks that the response format matches the PostResource structure.
     */
    public function test_index_returns_posts_ordered(): void
    {
        $postB = Post::factory()->create(['name' => 'Bravo']);
        $postA = Post::factory()->create(['name' => 'Alpha']);
        $postC = Post::factory()->create(['name' => 'Charlie']);

        $response = $this->getJson(route('api.admin.posts.index'));

        $response->assertStatus(200);

        $responseData = $response->json('data');
        $names = array_column($responseData, 'name');
        $this->assertEquals(['Alpha', 'Bravo', 'Charlie'], $names);

        $this->assertArrayHasKey('id', $responseData[0]);
        $this->assertArrayHasKey('name', $responseData[0]);
        $this->assertArrayHasKey('description', $responseData[0]);
    }

    /**
     * Test the show method to ensure it returns a single post correctly.
     * 
     * This test creates a post, sends a GET request to the show route for that post,
     * and asserts that the response status is 200 and the returned data
     * matches the post's id, name, and description in the PostResource format.
     */
    public function test_show_returns_single_post(): void
    {
        $post = Post::factory()->create([
            'name' => 'Test Post',
            'description' => 'Test Description',
        ]);

        $response = $this->getJson(route('api.admin.posts.show', $post->id));

        $response->assertStatus(200);

        $responseData = $response->json('data');
        $this->assertEquals($post->id, $responseData['id']);
        $this->assertEquals($post->name, $responseData['name']);
        $this->assertEquals($post->description, $responseData['description']);
    }

    /**
     * Test the search method to ensure it filters posts correctly.
     * 
     * This test creates multiple posts with different names, statuses,
     * categories, and indicative ratings. It sends a GET request to the
     * search route with specific filters and asserts that all returned posts
     * match the search criteria. It also verifies that the posts are ordered
     * by 'name' ascending and that the response data matches the PostResource structure.
     */
    public function test_search_filters_posts_correctly(): void
    {
        // Create categories and ratings
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $rating1 = IndicativeRating::factory()->create();
        $rating2 = IndicativeRating::factory()->create();

        // Create posts with various combinations
        Post::factory()->create([
            'name' => 'Alpha Post',
            'active' => 1,
            'category_id' => $category1->id,
            'indicative_rating_id' => $rating1->id,
        ]);

        Post::factory()->create([
            'name' => 'Beta Post',
            'active' => 0,
            'category_id' => $category2->id,
            'indicative_rating_id' => $rating2->id,
        ]);

        Post::factory()->create([
            'name' => 'Gamma Post',
            'active' => 1,
            'category_id' => $category1->id,
            'indicative_rating_id' => $rating2->id,
        ]);

        // Send search request with filters
        $response = $this->getJson(route('api.admin.posts.search', [
            'search' => [
                'name' => 'Post',
                'status' => 1,
                'category_id' => $category1->id,
                'indicative_rating_id' => $rating1->id,
            ]
        ]));

        $response->assertStatus(200);

        $responseData = $response->json('data');

        // Assert all returned posts match the search filters
        foreach ($responseData as $post) {
            $this->assertStringContainsString('Post', $post['name']);           // Name filter
            $this->assertEquals(1, $post['active']);                            // Active filter
            $this->assertEquals($category1->id, $post['category_id']);          // Category filter
            $this->assertEquals($rating1->id, $post['indicative_rating_id']);   // Rating filter
        }

        // Assert the posts are ordered by name ascending
        $names = array_column($responseData, 'name');
        $sortedNames = $names;
        sort($sortedNames);
        $this->assertEquals($sortedNames, $names);

        // Verify resource structure
        if (!empty($responseData)) {
            $this->assertArrayHasKey('id', $responseData[0]);
            $this->assertArrayHasKey('name', $responseData[0]);
            $this->assertArrayHasKey('description', $responseData[0]);
        }
    }
}
