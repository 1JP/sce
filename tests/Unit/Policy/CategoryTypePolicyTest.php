<?php

namespace Tests\Unit\Policy;

use App\Models\CategoryType;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryTypePolicyTest extends TestCase
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
     * test policy create category type
     */
    public function test_user_can_create_category_type()
    {
        $category = CategoryType::factory()->create();

        $this->assertTrue($this->userRoot->can('create', $category));
    }

    /**
     * test policy update category type
     */
    public function test_user_can_update_category_type()
    {
        $category = CategoryType::factory()->create();

        $category->update([
            'name' => 'Batman Cavaleiro das trevas',
        ]);

        $this->assertTrue($this->userRoot->can('update', $category));
    }

    /**
     * test policy delete category type
     */
    public function test_user_can_delete_category_type()
    {
        $category = CategoryType::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $category));
    }

    /**
     * test policy cannot delete post
     */
    public function test_user_cannot_delete_post()
    {
        $category = CategoryType::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $category));
        $this->assertFalse($this->userAdmin->can('delete', $category));

        $this->assertFalse($this->userMembro->can('delete', $category));
        $this->assertFalse($this->userCliente->can('delete', $category));

        $this->assertFalse($this->userUsuario->can('delete', $category));
    }

    /**
     * test policy cannot create post
     */
    public function test_user_cannot_create_post()
    {
        $category = CategoryType::factory()->create();

        $this->assertFalse($this->userUsuario->can('create', $category));
        $this->assertFalse($this->userAdmin->can('create', $category));

        $this->assertFalse($this->userMembro->can('create', $category));
        $this->assertFalse($this->userCliente->can('create', $category));

        $this->assertFalse($this->userUsuario->can('create', $category));
    }

    /**
     * test policy cannot update post
     */
    public function test_user_cannot_update_post()
    {
        $category = CategoryType::factory()->create();

        $category->update([
            'name' => 'Batman Cavaleiro das trevas',
        ]);
        
        $this->assertFalse($this->userUsuario->can('update', $category));
        $this->assertFalse($this->userAdmin->can('update', $category));

        $this->assertFalse($this->userMembro->can('update', $category));
        $this->assertFalse($this->userCliente->can('update', $category));

        $this->assertFalse($this->userUsuario->can('update', $category));
    }
}
