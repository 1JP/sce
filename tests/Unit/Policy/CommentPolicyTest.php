<?php

namespace Tests\Unit\Policy;

use App\Models\Comment;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CommentPolicyTest extends TestCase
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
     * test policy update comment
     */
    public function test_user_can_update_comment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $comment->update([
            'description'=> fake()->text()
        ]);

        $this->assertTrue($this->userRoot->can('update', $comment));
        $this->assertTrue($this->userCliente->can('update', $comment));
    }

    /**
     * test policy delete comment
     */
    public function test_user_can_delete_comment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $this->assertTrue($this->userRoot->can('delete', $comment));
        $this->assertTrue($this->userCliente->can('delete', $comment));
    }

    /**
     * test policy cannot delete comment
     */
    public function test_user_cannot_delete_comment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $comment->update([
            'description'=> fake()->text()
        ]);
        
        $role = Role::where('name', 'Cliente')->first();

        $user = User::factory()->create()->assignRole($role->id);

        $this->assertFalse($this->userAdmin->can('delete', $comment));
        $this->assertFalse($this->userMembro->can('delete', $comment));
        $this->assertFalse($this->userUsuario->can('delete', $comment));
        $this->assertFalse($user->can('delete', $comment));
    }

    /**
     * test policy cannot update comment
     */
    public function test_user_cannot_update_comment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $role = Role::where('name', 'Cliente')->first();

        $user = User::factory()->create()->assignRole($role->id);

        $this->assertFalse($this->userAdmin->can('update', $comment));
        $this->assertFalse($this->userMembro->can('update', $comment));
        $this->assertFalse($this->userUsuario->can('update', $comment));
        $this->assertFalse($user->can('update', $comment));
    }
}
