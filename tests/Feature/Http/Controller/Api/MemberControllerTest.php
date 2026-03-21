<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Client;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    /** @var Client  */
    protected $client;

    /** @var User */
    protected $member;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
        $this->be($this->user = User::factory()->create()->assignRole('Admin'));
        $this->client = Client::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * Test that a non-admin user cannot access the members index via the API.
     *
     * This test verifies that:
     * - A user without 'Root' or 'Admin' role is forbidden from accessing the endpoint
     * - The response status code is 403 (Forbidden)
     * - The response JSON contains the expected 'Forbidden' message
     */
    public function test_non_admin_cannot_access_members_index()
    {
        $userTest = User::factory()->create();
        Client::factory()->create([
            'user_id' => $userTest->id,
        ]);

        $this->actingAs($userTest);

        $response = $this->getJson(route('api.admin.members.index'));

        $response->assertStatus(403);
        $response->assertJson([
            'message' => 'Forbidden'
        ]);
    }
    
    /**
     * Test that a non-admin user cannot access the members index via the API.
     *
     * This test verifies that:
     * - A user without 'Root' or 'Admin' role is forbidden from accessing the endpoint
     * - The response status code is 403 (Forbidden)
     * - The response JSON contains the expected 'Forbidden' message
     */
    public function test_admin_can_access_members_index()
    {
        $admin = $this->user;
        $member1 = User::factory()->create();
        $member2 = User::factory()->create();

        $admin->client->members()->attach([$member1->id, $member2->id]);

        $this->actingAs($admin);

        $response = $this->getJson(route('api.admin.members.index'));
        $response->assertStatus(200);

        $response->assertJsonCount(2, 'data');
    }
    
    /**
     * Test that a non-admin user cannot search for members via the API.
     *
     * This test verifies that:
     * - A user without 'Root' or 'Admin' role is forbidden from accessing the search endpoint
     * - The response status code is 403 (Forbidden)
     * - The response JSON contains the expected 'Forbidden' message
     */
    public function test_non_admin_cannot_search_members()
    {
        $userSearch = User::factory()->create();
        $client = Client::factory()->create([
            'user_id' => $userSearch->id,
        ]);

        $this->actingAs($userSearch);

        $response = $this->getJson(route('api.admin.members.search'), []);

        $response->assertStatus(403);
        $response->assertJson([
            'message' => 'Forbidden'
        ]);
    }
    
    /**
     * Test that an admin user can search members by email via the API.
     *
     * This test verifies that:
     * - The search endpoint is accessible by an admin user
     * - Members are filtered correctly based on the provided email
     * - The response status code is 200 (OK)
     * - Only matching members are returned in the response JSON
     */
    public function test_admin_can_search_members_by_email()
    {
        $member1 = User::factory()->create(['email' => 'john@test.com']);
        $member2 = User::factory()->create(['email' => 'jane@test.com']);

        $this->user->client->members()->attach([$member1->id, $member2->id]);
        
        $response = $this->getJson(
            route('api.admin.members.search', [
                'search' => [
                    'email' => 'john'
                ]
            ])
        );

        $response->assertStatus(200);

        $response->assertJsonCount(1, 'data');
    }
}
