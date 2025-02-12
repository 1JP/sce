<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\User;
use Database\Seeders\CategoryTypeSeeder;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var CategoryType */
    protected $categoryType;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([CategoryTypeSeeder::class, RolesSeeder::class]);
        $this->categoryType = CategoryType::first();
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * test search category
     */
    public function test_search_category(): void
    {
        $categories = Category::factory()->count(3)->create(['active' => true]);
        $name = $categories[0]->name;
        $categories[0]->categoryTypes()->attach($this->categoryType->id);
        
        $searchName = $this->get(route('api.admin.categories.search'), [
            'search' => [
                'name' => $name
            ]
        ]);

        $searchName->assertOk();
        $searchName->assertJsonFragment([
            'name' => $name,
        ]);

        $searchActive = $this->get(route('api.admin.categories.search'), [
            'search' => [
                'status' => 1
            ]
        ]);

        $this->assertCount($categories->count(), $searchActive->json()['data']);

        $searchCategoryType = $this->get(route('api.admin.categories.search'), [
            'search' => [
                'category_type_id' => $this->categoryType->id
            ]
        ]);

        $this->assertCount(1, $searchCategoryType->json());

    }
}
