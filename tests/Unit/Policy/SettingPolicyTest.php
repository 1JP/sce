<?php

namespace Tests\Unit\Policy;

use App\Models\Setting;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SettingPolicyTest extends TestCase
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
    }

    /**
     * test policy create setting
     */
    public function test_user_can_create_setting()
    {
        $setting = Setting::factory()->create();

        $this->assertTrue($this->userRoot->can('create', $setting));
    }

    /**
     * test policy update setting
     */
    public function test_user_can_update_setting()
    {
        $setting = Setting::factory()->create();

        $setting->update([
            'name' => 'Batman Cavaleiro das trevas',
        ]);

        $this->assertTrue($this->userRoot->can('update', $setting));
    }

    /**
     * test policy delete setting
     */
    public function test_user_can_delete_setting()
    {
        $setting = Setting::factory()->create();

        $this->assertTrue($this->userRoot->can('delete', $setting));
    }

    /**
     * test policy cannot delete setting
     */
    public function test_user_cannot_delete_setting()
    {
        $setting = Setting::factory()->create();

        $this->assertFalse($this->userUsuario->can('delete', $setting));
        $this->assertFalse($this->userMembro->can('delete', $setting));
    }

    /**
     * test policy cannot create setting
     */
    public function test_user_cannot_create_setting()
    {
        $setting = Setting::factory()->create();

        $this->assertFalse($this->userUsuario->can('create', $setting));
        $this->assertFalse($this->userMembro->can('create', $setting));
    }

    /**
     * test policy cannot update setting
     */
    public function test_user_cannot_update_setting()
    {
        $setting = Setting::factory()->create();

        $setting->update([
            'name' => 'Batman Cavaleiro das trevas',
        ]);
        
        $this->assertFalse($this->userUsuario->can('update', $setting));
        $this->assertFalse($this->userMembro->can('update', $setting));
    }
}
