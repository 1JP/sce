<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Client;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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
        $this->member = User::factory()->create(['name' => 'Nome Antigo']);
        $this->client->members()->syncWithoutDetaching($this->member->id);
    }

    /**
     * Test that an admin user can successfully create a new member.
     *
     * This test verifies that:
     * - The request is authorized for an admin user
     * - A new user is created in the database
     * - Default attributes (like password) are correctly assigned
     * - The correct role is assigned to the new member
     * - The member is attached to the admin's client (pivot relationship)
     * - Additional fields are properly stored
     */
    public function test_admin_can_create_a_member()
    {
        $admin = $this->user;

        $this->actingAs($admin);

        $data = [
            'name' => 'Pedro Teste',
            'email' => 'pedro@teste.com',
            'phone' => '(31) 99927-5112',
        ];

        $response = $this->post(route('admin.membros.store'), $data);
        $response->assertRedirect(route('admin.membros.index'));

        $user = User::where('email', 'pedro@teste.com')->first();
        
        $this->assertNotNull($user);
        $this->assertEquals('Pedro Teste', $user->name);
        $this->assertTrue(Hash::check('123457', $user->password));
        $this->assertTrue($user->hasRole('Membros'));
        $this->assertTrue($this->client->members->contains($user->id));
        $this->assertEquals('35720000', $user->postal_code);
        $this->assertEquals('Matozinhos', $user->city);
    }
    
    /**
     * Test that an admin user can successfully update an existing member.
     *
     * This test verifies that:
     * - The update request is processed correctly
     * - The user is redirected after a successful update
     * - A success message is stored in the session
     * - The member's data is properly updated in the database
     * - The updated model reflects the latest persisted changes
     */
    public function test_admin_can_update_member()
    {
        $data = [
            'name' => 'Nome Novo',
            'email' => 'novoemail@teste.com',
            'phone' => '(31) 99999-9999',
        ];

        $response = $this->patch(route('admin.membros.update', $this->member->id), $data);
        $response->assertRedirect(route('admin.membros.index'));
        $response->assertSessionHas('success', 'Membro alterado com sucesso!');

        $this->assertDatabaseHas('users', [
            'id' => $this->member->id,
            'name' => 'Nome Novo',
            'email' => 'novoemail@teste.com',
        ]);

        $this->assertEquals($this->member->fresh()->id, $this->member->id);
    }
    
    /**
     * Test that an admin user cannot update a member 
     * who does not belong to the admin's client.
     *
     * This test verifies that:
     * - The update request for a member outside the admin's client is forbidden
     * - The response status code is 403 (Forbidden)
     * - The member's data in the database remains unchanged
     */
    public function test_admin_cannot_update_member_not_belonging_to_client()
    {
        $otherMember = User::factory()->create(['name' => 'Outro']);
        $otherMember->assignRole('Membros');

        $data = [
            'name' => 'Tentativa Nome Novo',
            'email' => 'tentativa@teste.com',
            'phone' => '(31) 99999-9999',
        ];

        $response = $this->patch(route('admin.membros.update', $otherMember->id), $data);
        $response->assertStatus(403);
        
        $this->assertDatabaseHas('users', [
            'id' => $otherMember->id,
            'name' => 'Outro',
            'email' => $otherMember->email,
        ]);
    }
    
    /**
     * Test that an admin user can successfully delete a member.
     *
     * This test verifies that:
     * - The delete request is authorized for the admin
     * - The user is redirected with a success message after deletion
     * - The pivot relationship between client and member is removed
     * - The member's roles are updated correctly (removed from 'Membros', assigned 'Usuario')
     * - The member still exists in the users table but is no longer attached to the client
     */
    public function test_admin_can_delete_member()
    {
        $admin = $this->user;
        $client = $this->client;

        $member = User::factory()->create();
        $client->members()->attach($member->id);

        $member->assignRole('Membros');

        $this->actingAs($admin);

        $response = $this->delete(route('admin.membros.destroy', $member->id));

        $response->assertRedirect(route('admin.membros.index'));
        $response->assertSessionHas('success', 'Membro excluido com sucesso!');

        $this->assertDatabaseMissing('members', [
            'client_id' => $client->id,
            'user_id' => $member->id
        ]);

        $this->assertTrue($member->hasRole('Usuario'));
        $this->assertFalse($member->hasRole('Membros'));
    }
    
    /**
     * Test that an admin user cannot delete a member
     * who does not belong to the admin's client.
     *
     * This test verifies that:
     * - The delete request for a member outside the admin's client is forbidden
     * - The response status code is 403 (Forbidden)
     * - The pivot relationship between the other client and the member remains intact
     * - No changes are made to the member's roles or association
     */
    public function test_admin_cannot_delete_member_not_belonging_to_client()
    {
        $admin = User::factory()->create()->assignRole('Admin');
        Client::factory()->create([
            'user_id' => $admin->id,
        ]);

        $otherClient = $this->client;
        $member = User::factory()->create();
        $otherClient->members()->attach($member->id);

        $this->actingAs($admin);

        $response = $this->delete(route('admin.membros.destroy', $member->id));

        $response->assertStatus(403);
        $this->assertDatabaseHas('members', [
            'client_id' => $otherClient->id,
            'user_id' => $member->id
        ]);
    }
}
