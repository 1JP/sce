<?php

namespace Tests\Unit\Policy;

use App\Models\Post;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostPolicyTest extends TestCase
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
     * test policy create post
     */
    public function test_user_can_create_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertTrue($this->userAdmin->can('create', $postAdmin));
        $this->assertTrue($this->userRoot->can('create', $postRoot));
    }

    /**
     * test policy update post
     */
    public function test_user_can_update_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);

        $nameAdmin = 'Test update post admin';
        $descriptionAdmin = fake()->text();
        $noteAdmin = 10.0;

        $postAdmin->update([
            'name' => $nameAdmin,
            'description' => $descriptionAdmin,
            'note' => $noteAdmin
        ]);

        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $nameRoot = 'Test update post Root';
        $descriptionRoot = fake()->text();
        $noteRoot = 10.0;

        $postRoot->update([
            'name' => $nameRoot,
            'description' => $descriptionRoot,
            'note' => $noteRoot
        ]);

        $postMembro = Post::factory()->create(['user_id' => $this->userAdmin->id]);

        $nameMembro = 'Test update post Membro';
        $descriptionMembro = fake()->text();
        $noteMembro = 10.0;

        $postMembro->update([
            'name' => $nameMembro,
            'description' => $descriptionMembro,
            'note' => $noteMembro
        ]);

        $this->assertTrue($this->userAdmin->can('update', $postAdmin));
        $this->assertTrue($this->userRoot->can('update', $postRoot));
        $this->assertTrue($this->userMembro->can('update', $postMembro));
    }

    /**
     * test policy delete post
     */
    public function test_user_can_delete_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertTrue($this->userAdmin->can('delete', $postAdmin));
        $this->assertTrue($this->userRoot->can('delete', $postRoot));
    }

    /**
     * test policy cannot create post
     */
    public function test_user_cannot_create_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertFalse($this->userUsuario->can('create', $postAdmin));
        $this->assertFalse($this->userUsuario->can('create', $postRoot));

        $this->assertFalse($this->userCliente->can('create', $postAdmin));
        $this->assertFalse($this->userCliente->can('create', $postRoot));

        $this->assertFalse($this->userMembro->can('create', $postAdmin));
        $this->assertFalse($this->userMembro->can('create', $postRoot));
    }

    /**
     * test policy cannot update post
     */
    public function test_user_cannot_update_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);

        $nameAdmin = 'Test update post admin';
        $descriptionAdmin = fake()->text();
        $noteAdmin = 10.0;

        $postAdmin->update([
            'name' => $nameAdmin,
            'description' => $descriptionAdmin,
            'note' => $noteAdmin
        ]);

        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $nameRoot = 'Test update post Root';
        $descriptionRoot = fake()->text();
        $noteRoot = 10.0;

        $postRoot->update([
            'name' => $nameRoot,
            'description' => $descriptionRoot,
            'note' => $noteRoot
        ]);

        $this->assertFalse($this->userUsuario->can('update', $postAdmin));
        $this->assertFalse($this->userUsuario->can('update', $postRoot));

        $this->assertFalse($this->userCliente->can('update', $postAdmin));
        $this->assertFalse($this->userCliente->can('update', $postRoot));
    }

    /**
     * test policy cannot delete post
     */
    public function test_user_cannot_delete_post()
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);

        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertFalse($this->userUsuario->can('delete', $postAdmin));
        $this->assertFalse($this->userUsuario->can('delete', $postRoot));

        $this->assertFalse($this->userCliente->can('delete', $postAdmin));
        $this->assertFalse($this->userCliente->can('delete', $postRoot));

        $this->assertFalse($this->userMembro->can('delete', $postAdmin));
        $this->assertFalse($this->userMembro->can('delete', $postRoot));
    }
}
