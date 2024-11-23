<?php

namespace Tests\Unit\Policy;

use App\Models\Subscription;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserPolicyTest extends TestCase
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
     * test policy update user
     */
    public function test_user_can_update_user()
    {
        $user = User::factory()->create();

        $user->update([
            'name' => fake()->name()
        ]);

        $this->assertTrue($this->userRoot->can('update', $user));
        $this->assertTrue($user->can('update', $user));
    }

    /**
     * test policy delete user
     */
    public function test_user_can_delete_user()
    {
        $user = User::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $user));
        $this->assertTrue($user->can('delete', $user));
    }

    /**
     * test policy cannot delete user
     */
    public function test_user_cannot_delete_user()
    {
        $user = User::factory()->create();
        $userDelete = User::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $user));
        $this->assertFalse($this->userUsuario->can('delete', $user));
        $this->assertFalse($this->userMembro->can('delete', $user));
        $this->assertFalse($this->userAdmin->can('delete', $user));
        $this->assertFalse($userDelete->can('delete', $user));
    }
}
