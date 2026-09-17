<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);

        $this->be($this->user = User::factory()->create()->assignRole('Admin'));
    }

    /**
     * Tests the API route `api.users.show`.
     *
     * Purpose:
     * - Verify that the route correctly returns a specific user.
     * - Ensure the HTTP status returned is 200 (OK).
     * - Confirm that the JSON structure matches what the UserResource defines.
     * - Validate that the returned data (id, name, email) matches the requested user.
     *
     * This test ensures that the endpoint works properly and that the UserResource
     * formats the user data correctly for the API.
     */
    public function test_api_users_show_returns_user_resource()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->getJson(route('api.users.show', ['user' => $user->id]));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'phone',
                'cpf',
                'postal_code',
                'birth_date',
                'street',
                'number',
                'locality',
                'city',
                'region_code',
                'country',
                'area',
                'complement',
            ],
        ]);

        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'cpf' => $user->cpf,
                'postal_code' => $user->postal_code,
                'birth_date' => $user->birth_date,
                'street' => $user->street,
                'number' => $user->number,
                'locality' => $user->locality,
                'city' => $user->city,
                'region_code' => $user->region_code,
                'country' => $user->country,
                'area' => $user->area,
                'complement' => $user->complement,
            ],
        ]);
    }
}
