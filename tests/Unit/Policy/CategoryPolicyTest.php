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
    protected $userCliente;
    protected $userRoot;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(RolesSeeder::class);

        $roleAdmin = Role::where('name', 'Admin')->first();
        $roleMembros = Role::where('name', 'Membros')->first();
        $roleUsuario = Role::where('name', 'Usuario')->first();
        $roleCliente = Role::where('name', 'Cliente')->first();
        $roleRoot = Role::where('name', 'Root')->first();

        $this->userAdmin = User::factory()->create()->assignRole($roleAdmin->id);
        $this->userMembro = User::factory()->create()->assignRole($roleMembros->id);
        $this->userUsuario = User::factory()->create()->assignRole($roleUsuario->id);
        $this->userCliente = User::factory()->create()->assignRole($roleCliente->id);
        $this->userRoot = User::factory()->create()->assignRole($roleRoot->id);
    }

    /**
     * test policy create category
     */
    public function test_user_can_create_category()
    {
        $categoryAdmin = Category::factory()->create();
        $categoryRoot = Category::factory()->create();

        $this->assertTrue($this->userAdmin->can('create', $categoryAdmin));
        $this->assertTrue($this->userRoot->can('create', $categoryRoot));
    }

    /**
     * test policy update category
     */
    public function test_user_can_update_category()
    {
        $categoryAdmin = Category::factory()->create();
        $categoryRoot = Category::factory()->create();
        $categoryMembro = Category::factory()->create();

        $categoryAdmin->update([
            'name' => 'Batman Cavaleiro das trevas',
            'active' => true,
        ]);

        $categoryRoot->update([
            'name' => 'Super-man',
            'active' => false,
        ]);

        $categoryMembro->update([
            'name' => 'Super-man',
            'active' => false,
        ]);

        $this->assertTrue($this->userAdmin->can('update', $categoryAdmin));
        $this->assertTrue($this->userRoot->can('update', $categoryRoot));
        $this->assertTrue($this->userMembro->can('update', $categoryMembro));
    }

    /**
     * test policy delete category
     */
    public function test_user_can_delete_category()
    {
        $categoryAdmin = Category::factory()->create();
        $categoryRoot = Category::factory()->create();

        $this->assertTrue($this->userAdmin->can('delete', $categoryAdmin));
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

        $this->assertFalse($this->userCliente->can('delete', $categoryAdmin));
        $this->assertFalse($this->userCliente->can('delete', $categoryRoot));

        $this->assertFalse($this->userMembro->can('delete', $categoryAdmin));
        $this->assertFalse($this->userMembro->can('delete', $categoryRoot));
    }
}
