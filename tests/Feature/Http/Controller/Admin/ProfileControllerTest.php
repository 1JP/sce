<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * It should update the authenticated user's profile including the password.
     */
    public function test_store_updates_profile_with_password()
    {
        $data = [
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'password' => '12345678',
            'cpf' => '123.456.789-00',
        ];

        $response = $this->post(route('admin.profiles.store'), $data);

        $response->assertRedirect(route('admin.profiles.index'));
        $response->assertSessionHas('success', 'Perfil atualizado com sucesso');

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'cpf' => '12345678900',
        ]);

        $this->assertTrue(
            Hash::check('12345678', $this->user->fresh()->password)
        );
    }

    /**
     * It should update the authenticated user's profile without changing the password.
     */
    /** @test */
    public function test_store_updates_profile_without_changing_password()
    {
        $oldPassword = $this->user->password;

        $data = [
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'cpf' => '123.456.789-00',
        ];

        $response = $this->post(route('admin.profiles.store'), $data);

        $response->assertRedirect(route('admin.profiles.index'));
        $response->assertSessionHas('success', 'Perfil atualizado com sucesso');

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'cpf' => '12345678900',
        ]);

        $this->assertEquals(
            $oldPassword,
            $this->user->fresh()->password
        );
    }

    /**
    * It should handle exceptions and redirect back with an error message.
    */
    public function test_store_returns_error_on_exception()
    {
        // transforma o user autenticado em mock parcial
        $mockedUser = \Mockery::mock($this->user)->makePartial();
        $mockedUser->shouldReceive('update')->andThrow(new \Exception('Erro'));

        // reautentica com o mock
        $this->be($mockedUser);

        $data = [
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'cpf' => '123.456.789-00',
        ];

        $response = $this->post(route('admin.profiles.store'), $data);

        $response->assertRedirect(route('admin.profiles.index'));
        $response->assertSessionHas('danger', 'Ocorreu um erro ao atualizar o perfil');
    }
}
