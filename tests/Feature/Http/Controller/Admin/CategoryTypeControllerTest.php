<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * test create category
     */
    public function test_create_category(): void
    {
        $this->post(route('admin.tipos-de-categorias.store'), [
            'name' => 'Filme Test',
            'description' => fake()->text(),
        ]);

        $this->assertDatabaseHas('category_types', [
            'name' => 'Filme Test',
        ]);

    }

    /** 
     * test update category 
     */
    public function test_update_category(): void
    {

        $categoryType = CategoryType::factory()->create();

        $this->patch(route('admin.tipos-de-categorias.update', $categoryType->id), [
            'name' => 'Filme Test',
            'description' => fake()->text(),
        ]);

        $this->assertDatabaseHas('category_types', [
            'name' => 'Filme Test',
        ]);
        
    }

    /** 
     * test delete category 
     */
    public function test_delete_category():void
    {
        $category = Category::factory()->create();
        $categoryType = CategoryType::factory()->create();
        $category->categoryTypes()->attach($categoryType->id);

        $this->assertDatabaseHas('category_types', [
            'id' => $categoryType->id,
        ]);

        $this->delete(route('admin.tipos-de-categorias.destroy', $categoryType->id));

        $categoryType->delete();

        $this->assertDatabaseMissing('category_types', [
            'id' => $categoryType->id,
        ]);

        $this->assertDatabaseMissing('category_types_categories', [
            'category_type_id' => $categoryType->id,
            'category_id' => $category->id
        ]);
    }
}
