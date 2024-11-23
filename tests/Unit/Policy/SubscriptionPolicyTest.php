<?php

namespace Tests\Unit\Policy;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SubscriptionPolicyTest extends TestCase
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
     * test policy update subscription
     */
    public function test_user_can_update_subscription()
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create();

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id
        ]);

        $subscription->update([
            'plan_id' => $plan->id
        ]);

        $this->assertTrue($this->userRoot->can('update', $subscription));
        $this->assertTrue($user->can('update', $subscription));
    }

    /**
     * test policy delete subscription
     */
    public function test_user_can_delete_subscription()
    {
        $user = User::factory()->create();

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertTrue($this->userRoot->can('delete', $subscription));
        $this->assertTrue($user->can('delete', $subscription));
    }

    /**
     * test policy cannot delete subscription
     */
    public function test_user_cannot_delete_subscription()
    {
        $subscription = Subscription::factory()->create();
        $user = User::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $subscription));
        $this->assertFalse($this->userMembro->can('delete', $subscription));
        $this->assertFalse($this->userAdmin->can('delete', $subscription));
        $this->assertFalse($user->can('delete', $subscription));
    }

    /**
     * test policy cannot update subscription
     */
    public function test_user_cannot_update_subscription()
    {
        $subscription = Subscription::factory()->create();
        $user = User::factory()->create();

        $this->assertFalse($this->userUsuario->can('update', $subscription));
        $this->assertFalse($this->userMembro->can('update', $subscription));
        $this->assertFalse($this->userAdmin->can('update', $subscription));
        $this->assertFalse($user->can('update', $subscription));
    }
}
