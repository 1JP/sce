<?php

namespace Tests\Unit\Policy;

use App\Models\Member;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MemberPolicyTest extends TestCase
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
     * test policy create member
     */
    public function test_user_can_create_member()
    {
        $memberAdmin = Member::factory()->create();
        $memberRoot = Member::factory()->create();

        $this->assertTrue($this->userAdmin->can('create', $memberAdmin));
        $this->assertTrue($this->userRoot->can('create', $memberRoot));
    }

    /**
     * test policy delete member
     */
    public function test_user_can_delete_member()
    {
        $memberAdmin = Member::factory()->create();
        $memberRoot = Member::factory()->create();

        $this->assertTrue($this->userAdmin->can('delete', $memberAdmin));
        $this->assertTrue($this->userRoot->can('delete', $memberRoot));
    }

    /**
     * test policy cannot create member
     */
    public function test_user_cannot_create_member()
    {
        $member = Member::factory()->create();

        $this->assertFalse($this->userUsuario->can('create', $member));
        $this->assertFalse($this->userMembro->can('create', $member));
        $this->assertFalse($this->userCliente->can('create', $member));
    }

    /**
     * test policy cannot delete member
     */
    public function test_user_cannot_delete_member()
    {
        $member = Member::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $member));
        $this->assertFalse($this->userMembro->can('delete', $member));
        $this->assertFalse($this->userCliente->can('delete', $member));
    }
}
