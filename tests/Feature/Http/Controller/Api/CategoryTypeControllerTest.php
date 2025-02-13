<?php

namespace Tests\Feature\Http\Controller\Api;

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
     * test search category
     */
    public function test_search_category(): void
    {
        $categories = CategoryType::factory()->count(3)->create();
        $name = $categories[0]->name;

        $searchName = $this->get(route('api.admin.categorie-types.search'), [
            'search' => [
                'name' => $name
            ]
        ]);

        $searchName->assertOk();
        $searchName->assertJsonFragment([
            'name' => $name,
        ]);
    }
}
