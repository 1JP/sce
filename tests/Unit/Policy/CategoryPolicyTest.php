<?php

namespace Tests\Unit\Policy;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryPolicyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @var User */
    protected $userAdmin;
    protected $userMembro;
    protected $userUsuario;
    protected $userRoot;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(RolesSeeder::class);

        $roleAdmin = Role::where('name', 'Admin')->first();
        $roleMembros = Role::where('name', 'Membros')->first();
        $roleUsuario = Role::where('name', 'Usuario')->first();
        $roleRoot = Role::where('name', 'Root')->first();

        $this->userAdmin = User::factory()->create()->assignRole($roleAdmin->id);
        $this->userMembro = User::factory()->create()->assignRole($roleMembros->id);
        $this->userUsuario = User::factory()->create()->assignRole($roleUsuario->id);
        $this->userRoot = User::factory()->create()->assignRole($roleRoot->id);
    }

    /**
     * test policy create category
     */
    public function test_user_can_create_category()
    {
        $categoryRoot = Category::factory()->create();

        $this->assertTrue($this->userRoot->can('create', $categoryRoot));
    }

    /**
     * test policy update category
     */
    public function test_user_can_update_category()
    {
        $categoryRoot = Category::factory()->create();

        $categoryRoot->update([
            'name' => 'Super-man',
            'active' => false,
        ]);

        $this->assertTrue($this->userRoot->can('update', $categoryRoot));
    }

    /**
     * test policy delete category
     */
    public function test_user_can_delete_category()
    {
        $categoryRoot = Category::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $categoryRoot));
    }

    /**
     * test policy cannot delete post
     */
    public function test_user_cannot_delete_post()
    {
        $categoryAdmin = Category::factory()->create();
        $categoryRoot = Category::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $categoryAdmin));
        $this->assertFalse($this->userUsuario->can('delete', $categoryRoot));

        $this->assertFalse($this->userMembro->can('delete', $categoryAdmin));
        $this->assertFalse($this->userMembro->can('delete', $categoryRoot));
    }
}
