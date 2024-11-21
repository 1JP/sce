<?php

namespace Tests\Unit\Policy;

use App\Models\IndicativeRating;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndicativeRatingPolicyTest extends TestCase
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
     * test policy create indicative rating
     */
    public function test_user_can_create_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $this->assertTrue($this->userRoot->can('create', $indicative));
    }

    /**
     * test policy update indicative type
     */
    public function test_user_can_update_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $indicative->update([
            'indicative' => 'Batman Cavaleiro das trevas',
        ]);

        $this->assertTrue($this->userRoot->can('update', $indicative));
    }

    /**
     * test policy delete indicative type
     */
    public function test_user_can_delete_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $indicative));
    }

    /**
     * test policy cannot delete indicative rating
     */
    public function test_user_cannot_delete_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $indicative));
        $this->assertFalse($this->userAdmin->can('delete', $indicative));

        $this->assertFalse($this->userMembro->can('delete', $indicative));
        $this->assertFalse($this->userCliente->can('delete', $indicative));

        $this->assertFalse($this->userUsuario->can('delete', $indicative));
    }

    /**
     * test policy cannot create indicative rating
     */
    public function test_user_cannot_create_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $this->assertFalse($this->userUsuario->can('create', $indicative));
        $this->assertFalse($this->userAdmin->can('create', $indicative));

        $this->assertFalse($this->userMembro->can('create', $indicative));
        $this->assertFalse($this->userCliente->can('create', $indicative));

        $this->assertFalse($this->userUsuario->can('create', $indicative));
    }

    /**
     * test policy cannot update indicative rating
     */
    public function test_user_cannot_update_indicative_rating()
    {
        $indicative = IndicativeRating::factory()->create();

        $indicative->update([
            'indicative' => 'Batman Cavaleiro das trevas',
        ]);
        
        $this->assertFalse($this->userUsuario->can('update', $indicative));
        $this->assertFalse($this->userAdmin->can('update', $indicative));

        $this->assertFalse($this->userMembro->can('update', $indicative));
        $this->assertFalse($this->userCliente->can('update', $indicative));

        $this->assertFalse($this->userUsuario->can('update', $indicative));
    }
}
