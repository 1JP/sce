<?php

namespace Tests\Unit\Policy;

use App\Models\Plan;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PlanPolicyTest extends TestCase
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
     * test policy create plan
     */
    public function test_user_can_create_plan()
    {
        $plan = Plan::factory()->create();

        $this->assertTrue($this->userRoot->can('create', $plan));
    }

    /**
     * test policy update plan
     */
    public function test_user_can_update_plan()
    {
        $plan = Plan::factory()->create();

        $plan->update([
            'name' => fake()->name()
        ]);

        $this->assertTrue($this->userRoot->can('update', $plan));
    }

    /**
     * test policy delete plan
     */
    public function test_user_can_delete_plan()
    {
        $plan = Plan::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $plan));
    }

    /**
     * test policy cannot create plan
     */
    public function test_user_cannot_create_plan()
    {
        $plan = Plan::factory()->create();

        $this->assertFalse($this->userAdmin->can('create', $plan));
        $this->assertFalse($this->userCliente->can('create', $plan));
        $this->assertFalse($this->userMembro->can('create', $plan));
        $this->assertFalse($this->userUsuario->can('create', $plan));
    }

    /**
     * test policy cannot update plan
     */
    public function test_user_cannot_update_plan()
    {
        $plan = Plan::factory()->create();

        $plan->update([
            'name' => fake()->name()
        ]);

        $this->assertFalse($this->userAdmin->can('update', $plan));
        $this->assertFalse($this->userCliente->can('update', $plan));
        $this->assertFalse($this->userMembro->can('update', $plan));
        $this->assertFalse($this->userUsuario->can('update', $plan));
    }

    /**
     * test policy cannot delete plan
     */
    public function test_user_cannot_delete_plan()
    {
        $plan = Plan::factory()->create();
        
        $this->assertFalse($this->userAdmin->can('delete', $plan));
        $this->assertFalse($this->userCliente->can('delete', $plan));
        $this->assertFalse($this->userMembro->can('delete', $plan));
        $this->assertFalse($this->userUsuario->can('delete', $plan));
    }
}
