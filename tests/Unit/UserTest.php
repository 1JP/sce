<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @var Roles */
    protected $roleAdmin;
    protected $roleMembros;
    protected $roleUsuario;
    protected $roleCliente;
    protected $roleRoot;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(RolesSeeder::class);

        $this->roleAdmin = Role::where('name', 'Admin')->first();
        $this->roleMembros = Role::where('name', 'Membros')->first();
        $this->roleUsuario = Role::where('name', 'Usuario')->first();
        $this->roleCliente = Role::where('name', 'Cliente')->first();
        $this->roleRoot = Role::where('name', 'Root')->first();
    }

    /**
     * test create user
     */
    public function test_create_user(): void
    {    
        $userAdmin = User::factory()->create()->assignRole($this->roleAdmin->id);
        $userMembros = User::factory()->create()->assignRole($this->roleMembros->id);
        $userUsuario = User::factory()->create()->assignRole($this->roleUsuario->id);
        $userCliente = User::factory()->create()->assignRole($this->roleCliente->id);
        $userRoot = User::factory()->create()->assignRole($this->roleRoot->id);
        
        $this->assertModelExists($userAdmin);
        $this->assertModelExists($userMembros);
        $this->assertModelExists($userUsuario);
        $this->assertModelExists($userCliente);
        $this->assertModelExists($userRoot);

        $this->assertEquals($userAdmin->roles()->first()->id, $this->roleAdmin->id);
        $this->assertEquals($userMembros->roles()->first()->id, $this->roleMembros->id);
        $this->assertEquals($userUsuario->roles()->first()->id, $this->roleUsuario->id);
        $this->assertEquals($userCliente->roles()->first()->id, $this->roleCliente->id);
        $this->assertEquals($userRoot->roles()->first()->id, $this->roleRoot->id);
    }

    /**
     * test update user
     */
    public function test_update_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Teste User',
            'email' => 'testeuser@test.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($this->roleMembros->id);
        
        $this->assertModelExists($user);

        $user->update([
            'name' => 'Teste User Update',
            'email' => 'testeuserupdate@test.com.br',
            'password' => Hash::make('password'),
        ]);
        $this->assertModelExists($user);
    }

    /**
     * test destroy user
     */
    public function test_destroy_user(): void
    {
        $user = User::factory()->create()->assignRole($this->roleMembros->id);
        
        $this->assertModelExists($user);
        $this->assertEquals($user->roles()->first()->id, $this->roleMembros->id);

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /** 
     * test it does not allow duplicate emails
    */
    public function test_it_does_not_allow_duplicate_emails_in_the_database(): void
    {
        // Cria um usuário com um e-mail específico
        $user1 = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        // Espera que a tentativa de criar um segundo usuário com o mesmo e-mail lance uma exceção
        $this->expectException(QueryException::class);

        // Tenta criar outro usuário com o mesmo e-mail
        $user2 = User::factory()->create([
            'email' => 'test@example.com',
        ]);
    }

    /** 
     * test not create user all wrong data
     */
    public function test_not_create_all_wrong_data_user(): void
    {
        $this->expectException(InvalidArgumentException::class);

        User::factory()->create([
            'name' => fake()->randomDigit(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => fake()->randomDigit(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'street' => fake()->randomDigit(),
            'number' => fake()->randomDigit(),
            'locality' => fake()->randomDigit(),
            'city' => fake()->randomDigit(),
            'region_code' => fake()->randomDigit(),
            'postal_code' => fake()->randomDigit(),
            'complement' => fake()->randomDigit(),
            'birth_date' => fake()->randomDigit(),
            'cpf' => fake()->randomDigit(),
            'country' => fake()->randomDigit(),
            'area' => fake()->randomDigit(),
            'phone' => fake()->randomDigit(),
        ]);
    }
}
