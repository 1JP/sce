<?php

namespace Tests\Unit\Policy;

use App\Models\Client;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ClientPolicyTest extends TestCase
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
     * test policy update client
     */
    public function test_user_can_update_client()
    {
        $client = Client::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $client->update([
            'name'=> fake()->name()
        ]);

        $this->assertTrue($this->userRoot->can('update', $client));
        $this->assertTrue($this->userCliente->can('update', $client));
    }

    /**
     * test policy delete client
     */
    public function test_user_can_delete_client()
    {
        $client = Client::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $this->assertTrue($this->userRoot->can('delete', $client));
        $this->assertTrue($this->userCliente->can('delete', $client));
    }

    /**
     * test policy cannot delete client
     */
    public function test_user_cannot_delete_client()
    {
        $client = Client::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $client->update([
            'name'=> fake()->name()
        ]);
        
        $role = Role::where('name', 'Cliente')->first();

        $user = User::factory()->create()->assignRole($role->id);

        $this->assertFalse($this->userAdmin->can('delete', $client));
        $this->assertFalse($this->userMembro->can('delete', $client));
        $this->assertFalse($this->userUsuario->can('delete', $client));
        $this->assertFalse($user->can('delete', $client));
    }

    /**
     * test policy cannot update client
     */
    public function test_user_cannot_update_client()
    {
        $client = Client::factory()->create([
            'user_id' => $this->userCliente->id
        ]);

        $role = Role::where('name', 'Cliente')->first();

        $user = User::factory()->create()->assignRole($role->id);

        $this->assertFalse($this->userAdmin->can('delete', $client));
        $this->assertFalse($this->userMembro->can('delete', $client));
        $this->assertFalse($this->userUsuario->can('delete', $client));
        $this->assertFalse($user->can('delete', $client));
    }
}
