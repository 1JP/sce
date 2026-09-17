<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Setting;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class, SettingSeeder::class]);
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * Given existing settings in database
     * When store endpoint is called with new data
     * Then it should create, update and delete settings accordingly
     */
    public function test_store_creates_updates_and_deletes_settings()
    {
        Setting::factory()->create([
            'group' => 'company',
            'name' => 'instagram',
            'body' => 'https://instagram.com/old'
        ]);

        $payload = [
            'company' => [
                'name' => 'Empresa Teste',
                'cnpj' => '12.345.678/0001-90',
                'email' => 'teste@email.com'
            ],
            'address' => [
                'cep' => '35720000',
                'street' => 'Rua A',
                'number' => '123',
                'neighborhood' => 'Centro',
                'city' => 'Cidade',
                'state' => 'MG',
            ],
            'payments' => [
                'url_prod_payment' => 'https://prod.com',
                'url_sanbox_payment' => 'https://sandbox.com',
                'token_payment' => '123',
                'public_key_payment' => 'abc',
            ],
            'site' => [
                'description' => 'Teste'
            ]
        ];

        $response = $this->actingAs($this->user)
            ->post(route('admin.configuracoes.store'), $payload);

        // ✅ redirecionamento ok
        $response->assertRedirect();

        // ✅ criado
        $this->assertDatabaseHas('settings', [
            'group' => 'company',
            'name' => 'name',
            'body' => 'Empresa Teste'
        ]);

        // ✅ atualizado/criado (payments vira api-payment)
        $this->assertDatabaseHas('settings', [
            'group' => 'api-payment',
            'name' => 'url-prod-payment',
            'body' => 'https://prod.com'
        ]);

        // ❌ removido (instagram antigo)
        $this->assertDatabaseMissing('settings', [
            'group' => 'company',
            'name' => 'instagram'
        ]);
    }
}
