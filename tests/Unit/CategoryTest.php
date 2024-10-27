<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\CategoryType;
use Database\Seeders\CategoryTypeSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @var CategoryType */
    protected $categoryType;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(CategoryTypeSeeder::class);

        $this->categoryType = CategoryType::first();
    }

    /**
     * test create category
     */
    public function test_create_category(): void
    {
        $category = Category::factory()->create([
            'categoryType_id' => $this->categoryType->id,
            'name' => 'Batman Cavaleiro das trevas',
            'active' => true,
        ]);

        $this->assertEquals($category->type->id, $this->categoryType->id);
        $this->assertEquals($category->name, 'Batman Cavaleiro das trevas');
        $this->assertTrue($category->active);
    }

    /** 
     * test update category 
     */
    public function test_update_category(): void
    {
        $categoryType_new = CategoryType::factory()->create();

        $category = Category::factory()->create([
            'categoryType_id' => $this->categoryType->id,
            'name' => 'Batman Cavaleiro das trevas'
        ]);

        $category->update([
            'categoryType_id' => $categoryType_new->id,
            'name' => 'Super-man o retorno',
            'active' => true,
        ]);

        $this->assertEquals($category->type->id, $categoryType_new->id);
        $this->assertEquals($category->name, 'Super-man o retorno');
        $this->assertTrue($category->active);

        $category->update([
            'categoryType_id' => $categoryType_new->id,
            'name' => 'Super-man o retorno',
            'active' => false,
        ]);

        $this->assertEquals($category->type->id, $categoryType_new->id);
        $this->assertEquals($category->name, 'Super-man o retorno');
        $this->assertFalse($category->active);
    }

    /** 
     * test delete category 
     */
    public function test_delete_category():void
    {
        $category = Category::factory()->create();

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);

        $category->delete();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    /**
     * test function categories active true 
     * 
     */
    public function test_function_categories_active_true(): void
    {
        Category::factory()
            ->count(5)
            ->state(['active' => true])
            ->create();
        
        $categoriesActives = Category::active()->count();
        
        $this->assertEquals($categoriesActives, 5);
    }

    /** 
     * test not create category all wrong data
     */
    public function test_not_create_all_wrong_data_user(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Category::factory()->create([
            'categoryType_id' => $this->categoryType->id,
            'name' => fake()->randomDigit(),
            'active' => fake()->boolean(),
        ]);
    }

    /** 
     * test not create category name integer
     */
    public function test_not_create_name_integer_category()
    {
        $this->expectException(InvalidArgumentException::class);

        Category::create([
            'categoryType_id' => $this->categoryType->id,
            'name' => fake()->randomDigit(),
            'active' => fake()->boolean(),
        ]);
    }

    /**
     * test not create category with max 45 
     */
    public function test_not_create_name_with_max_45_characters_category()
    {
        $this->expectException(InvalidArgumentException::class);

        $longString = "Esta é uma string que contém mais de 45 caracteres, para testar a validação e outras funções.";

        Category::create([
            'categoryType_id' => $this->categoryType->id,
            'name' => $longString,
            'active' => fake()->boolean(),
        ]);
    }
}
