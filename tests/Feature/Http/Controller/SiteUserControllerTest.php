<?php

namespace Tests\Feature\Http\Controller;

use App\Models\PasswordResetToken;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Mockery;

class SiteUserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
    }

    /** 
     * Tests the `create` method of the controller.
     *
     * Purpose:
     * - Verify that the method redirects to the login page with an error message
     *   if the provided token does not exist in the database.
     * - Ensure that if the token exists, the correct view (`site.user.create`) is returned.
     * - Confirm that the email associated with the token is passed to the view.
     *
     * This test ensures that the user creation form is accessible only with a valid
     * password reset token and that invalid tokens are handled securely.
     */
    public function test_create_with_valid_and_invalid_token()
    {
        // --- Scenario 1: Token does not exist ---
        $invalidToken = 'invalid-token-123';

        $response = $this->get(route('usuarios.create', ['token' => $invalidToken]));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('danger', 'O token inserindo não foi encontrado');

        // --- Scenario 2: Token exists ---
        $token = PasswordResetToken::create([
            'email' => 'user@example.com',
            'token' => 'valid-token-456',
            'created_at' => now(),
        ]);

        $response = $this->get(route('usuarios.create', ['token' => $token->token]));

        $response->assertStatus(200);
        $response->assertViewIs('site.user.create');
        $response->assertViewHas('email', $token->email);
    }

    /**
     * Tests the store method of the controller.
     *
     * Purpose:
     * - Verify that a new user can be successfully created.
     * - Ensure the password is hashed and the user receives the "Usuario" role.
     * - Check that the password reset token is deleted after registration.
     * - Confirm that the user is automatically logged in and the password is stored encrypted in session.
     * - Verify redirection to the home page with a success message.
     */
    public function test_store_creates_user_successfully()
    {
        $token = PasswordResetToken::create([
            'email' => 'user@example.com',
            'token' => 'valid-token-123',
            'created_at' => now(),
        ]);

        $requestData = [
            'name' => 'John Doe',
            'phone' => '123456789',
            'email' => 'user@example.com',
            'cpf' => '11122233344',
            'password' => 'secret123',
            'postal_code' => '12345-678',
            'birth_date' => '1990-01-01',
            'street' => 'Rua Exemplo',
            'number' => '123',
            'locality' => 'Bairro',
            'city' => 'Cidade',
            'region_code' => 'SP',
            'country' => 'Brasil',
            'area' => 'Sudeste',
            'complement' => 'Apto 101',
        ];

        $response = $this->post(route('usuarios.store'), $requestData);

        $user = User::where('email', 'user@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('secret123', $user->password));

        $this->assertDatabaseMissing('password_reset_tokens', ['email' => 'user@example.com']);

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());

        $this->assertEquals('secret123', Crypt::decrypt(session('validation')));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Usuário Cadastrado com sucesso!');
    }

    /**
     * Tests the store method when an exception occurs.
     *
     * Purpose:
     * - Ensure that if user creation fails, the user is redirected back to the registration form
     *   with the appropriate token and error message.
     */
    public function test_store_handles_exception_gracefully()
    {
        $token = PasswordResetToken::create([
            'email' => 'fail@example.com',
            'token' => 'fail-token-123',
            'created_at' => now(),
        ]);

        $requestData = [
            'name' => 'John Doe',
            'phone' => '123456789',
            'email' => 'fail@example.com',
            'cpf' => '11122233344',
            'password' => 'secret123',
            'postal_code' => '12345-678',
            'birth_date' => '1990-01-01',
            'street' => 'Rua Exemplo',
            'number' => '123',
            'locality' => 'Bairro',
            'city' => 'Cidade',
            'region_code' => 'SP',
            'country' => 'BR',
            'area' => '31',
            'complement' => 'Apto 101',
        ];

        $mock = Mockery::mock('alias:App\Models\User');
        $mock->shouldReceive('create')
            ->once()
            ->andThrow(new \Exception('Simulated exception'));

        $response = $this->post(route('usuarios.store'), $requestData);
        
        $response->assertRedirect(route('usuarios.create', $token->token));
        $response->assertSessionHas('danger', 'Não foi possível fazer o cadastro!');
    }

    /**
     * Tests the update method successfully updates a user.
     *
     * Purpose:
     * - Ensure that a valid PUT request to update a user's data
     *   actually updates the record in the database.
     * - Verifies that the user is redirected to the index route
     *   with the success message.
     */
    public function test_update_user_successfully()
    {
        // Create a user in the database
        $user = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'user@example.com',
            'cpf' => '12345678901',
            'phone' => '1234567890',
            'postal_code' => '12345678',
            'birth_date' => '1990-01-01',
            'street' => 'Old Street',
            'number' => '100',
            'locality' => 'Old Neighborhood',
            'city' => 'Old City',
            'region_code' => 'MG',
            'country' => 'BR',
            'area' => '31',
            'complement' => 'Apt 101',
        ]);

        // Authenticate as the user (or as an admin if policy requires)
        $this->actingAs($user);

        // New data for update (all values valid for the database)
        $requestData = [
            'name' => 'Updated Name',
            'phone' => '987654321',
            'email' => $user->email, // keep same email
            'cpf' => $user->cpf,     // keep same CPF
            'password' => 'newpassword123',
            'postal_code' => $user->postal_code,
            'birth_date' => $user->birth_date,
            'street' => 'New Street',
            'number' => '200',
            'locality' => 'New Neighborhood',
            'city' => 'New City',
            'region_code' => 'RJ',
            'country' => 'BR',
            'area' => '21',
            'complement' => 'Apt 202',
        ];

        // Send PUT request to the update route
        $response = $this->put(route('usuarios.update', $user), $requestData);

        // Assert that the response redirects to the index page
        $response->assertRedirect(route('usuarios.index'));

        // Assert that the session has the success message
        $response->assertSessionHas('success', 'Usuário Cadastrado com sucesso!');

        // Refresh the user object to get updated values from the database
        $user->refresh();

        // Assert that the name and other updated fields are correct
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('New Street', $user->street);
        $this->assertEquals('200', $user->number);
        $this->assertEquals('New Neighborhood', $user->locality);
        $this->assertEquals('New City', $user->city);
        $this->assertEquals('RJ', $user->region_code);
        $this->assertEquals('Apt 202', $user->complement);

        // Optionally, verify that the password has been hashed and changed
        $this->assertTrue(Hash::check('newpassword123', $user->password));
    }

    /**
     * Tests the update method when an exception occurs.
     *
     * Purpose:
     * - Ensure that if updating a user fails (for example, due to invalid data or database constraints),
     *   the application gracefully handles the exception.
     * - The user should be redirected back to the user index page with a proper error message in the session.
     * - This validates the controller's try/catch logic without using mocks or forcing exceptions.
     */
    public function test_update_handles_exception_gracefully()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $requestData = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'cpf' => '111222333444555666',
            'phone' => '123456789',
            'postal_code' => '12345-678',
            'birth_date' => '1990-01-01',
            'street' => 'Rua Exemplo',
            'number' => '123',
            'locality' => 'Bairro',
            'city' => 'Cidade',
            'region_code' => 'SP'
        ];

        $response = $this->put(route('usuarios.update', $user), $requestData);

        $response->assertRedirect(route('usuarios.index'));

        $response->assertSessionHas('danger', 'Não foi possível fazer o cadastro!');
    }

}
