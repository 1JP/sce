<?php

namespace Tests\Feature\Http\Controller\Admin;

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
     * test create category
     */
    public function test_create_category(): void
    {
        $this->post(route('admin.categorias.store'), [
            'name' => 'Filme Test',
            'category_type_id' => [$this->categoryType->id]
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Filme Test',
        ]);

        $category = Category::where('name', 'Filme Test')->first();

        $this->assertDatabaseHas('category_types_categories', [
            'category_type_id' => $this->categoryType->id,
            'category_id' => $category->id
        ]);
    }

    /** 
     * test update category 
     */
    public function test_update_category(): void
    {
        $category = Category::factory()->create([
            'active' => true
        ]);
        
        $category->categoryTypes()->attach($this->categoryType->id);
        $categoryType = CategoryType::factory()->create();

        $this->patch(route('admin.categorias.update', $category->id), [
            'name' => 'Filme Test',
            'category_type_id' => [$categoryType->id]
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Filme Test',
        ]);
        
        $categoryUpdate = Category::where('name', 'Filme Test')->first();
        
        $this->assertEquals($categoryUpdate->active, 0);

        $this->assertDatabaseHas('category_types_categories', [
            'category_type_id' => $categoryType->id,
            'category_id' => $category->id
        ]);
    }

    /** 
     * test delete category 
     */
    public function test_delete_category():void
    {
        $category = Category::factory()->create();
        $category->categoryTypes()->attach($this->categoryType->id);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);

        $this->delete(route('admin.categorias.destroy', $category->id));

        $category->delete();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);

        $this->assertDatabaseMissing('category_types_categories', [
            'category_type_id' => $this->categoryType->id,
            'category_id' => $category->id
        ]);
    }

    /** 
     * test not create category all wrong data
     */
    public function test_not_create_all_wrong_data_user(): void
    {
        $response = $this->post(route('admin.categorias.store'), [
            'name' => '',
            'active' => fake()->boolean(),
            'category_type_id' => [999]
        ]);

        $response->assertSessionHasErrors([
            'name',
            'category_type_id.0',
        ]);
    }
}
