<?php

namespace Tests\Unit\Policy;

use App\Models\Client;
use App\Models\Member;
use App\Models\Post;
use App\Models\Subscription;
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

        $client = Client::factory()->create([
            'user_id' => $this->userAdmin->id,
        ]);

        Member::factory()->create([
            'client_id' => $client->id,
            'user_id' => $this->userMembro->id,
        ]);

        // The PostPolicy requires an Admin to have an active (or trial)
        // subscription to create posts. Without this, test_user_can_create_post
        // would pass or fail depending on hidden factory behavior instead of
        // an explicit, readable condition.
        Subscription::factory()->create([
            'user_id' => $this->userAdmin->id,
            'status' => 'ACTIVE',
        ]);
    }

    /**
     * Root can always create posts; Admin can create posts only when
     * their subscription is active.
     */
    public function test_user_can_create_post(): void
    {
        $this->assertTrue($this->userRoot->can('create', Post::class));
        $this->assertTrue($this->userAdmin->can('create', Post::class));
    }

    /**
     * Admin loses permission to create posts once their subscription
     * is no longer active — this is the core business rule of the
     * PostPolicy::create() method and needs an explicit negative test.
     */
    public function test_admin_cannot_create_post_without_active_subscription(): void
    {
        $this->userAdmin->subscription()->update(['status' => 'CANCELED']);

        $this->assertFalse($this->userAdmin->fresh()->can('create', Post::class));
    }

    /**
     * Admin without any subscription record at all (subscription() returns
     * null) must also be denied. This covers the null-safe operator
     * ($user->subscription?->status) used in the policy.
     */
    public function test_admin_cannot_create_post_without_subscription(): void
    {
        $this->userAdmin->subscription()->delete();

        $this->assertFalse($this->userAdmin->fresh()->can('create', Post::class));
    }

    /**
     * Regular "Usuario" and "Membros" roles cannot create posts,
     * regardless of any subscription state.
     */
    public function test_user_cannot_create_post(): void
    {
        $this->assertFalse($this->userUsuario->can('create', Post::class));
        $this->assertFalse($this->userMembro->can('create', Post::class));
    }

    /**
     * Admin and Root can update posts owned by their own account.
     *
     * Note: no $post->update() call here — updating the model directly
     * does not go through the Policy at all, so it added no value to
     * this test and was removed.
     */
    public function test_user_can_update_post(): void
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertTrue($this->userAdmin->can('update', $postAdmin));
        $this->assertTrue($this->userRoot->can('update', $postRoot));
    }

    /**
     * A member can update a post belonging to the admin of the client
     * they belong to.
     *
     * NOTE: this post intentionally belongs to userAdmin, not userMembro,
     * mirroring the client/member relationship set up in setUp(). Confirm
     * this matches the intended business rule (member manages the whole
     * client's posts) — if members should only manage their own posts,
     * this assertion and the underlying policy need to change together.
     */
    public function test_member_can_update_client_post(): void
    {
        $postFromAdminClient = Post::factory()->create(['user_id' => $this->userAdmin->id]);

        $this->assertTrue($this->userMembro->can('update', $postFromAdminClient));
    }

    /**
     * A user with the plain "Usuario" role cannot update posts they
     * do not own, regardless of whose post it is.
     */
    public function test_user_cannot_update_post(): void
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertFalse($this->userUsuario->can('update', $postAdmin));
        $this->assertFalse($this->userUsuario->can('update', $postRoot));
    }

    /**
     * Admin and Root can delete posts owned by their own account.
     */
    public function test_user_can_delete_post(): void
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertTrue($this->userAdmin->can('delete', $postAdmin));
        $this->assertTrue($this->userRoot->can('delete', $postRoot));
    }

    /**
     * "Usuario" and "Membros" roles cannot delete posts they don't own.
     */
    public function test_user_cannot_delete_post(): void
    {
        $postAdmin = Post::factory()->create(['user_id' => $this->userAdmin->id]);
        $postRoot = Post::factory()->create(['user_id' => $this->userRoot->id]);

        $this->assertFalse($this->userUsuario->can('delete', $postAdmin));
        $this->assertFalse($this->userUsuario->can('delete', $postRoot));

        $this->assertFalse($this->userMembro->can('delete', $postAdmin));
        $this->assertFalse($this->userMembro->can('delete', $postRoot));
    }
}