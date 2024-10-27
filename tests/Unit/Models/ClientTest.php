<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    /**
     * test create client
     */
    public function test_create_client(): void
    {   
        $customer_id = fake()->text(100);

        $client = Client::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'Test',
            'street' => 'Rua teste',
            'number' => '123',
            'locality' => 'Bairro teste',
            'city' => 'Teste City',
            'region_code' => 'MG',
            'postal_code' => '99999999',
            'complement' => 'casa',
            'birth_date' => '1995-10-10',
            'cpf' => '11111111111',
            'country' => '55',
            'area' => '31',
            'phone' => '999999999',
            'customer_id' => $customer_id,
        ]);

        $this->assertEquals($client->user_id, $this->user->id);
        $this->assertEquals($client->name, 'Test');
        $this->assertEquals($client->street, 'Rua teste');
        $this->assertEquals($client->number, '123');
        $this->assertEquals($client->locality, 'Bairro teste');
        $this->assertEquals($client->city, 'Teste City');
        $this->assertEquals($client->region_code, 'MG');
        $this->assertEquals($client->postal_code, '99999999');
        $this->assertEquals($client->complement, 'casa');
        $this->assertEquals($client->birth_date, '1995-10-10');
        $this->assertEquals($client->cpf, '11111111111');
        $this->assertEquals($client->country, '55');
        $this->assertEquals($client->area, '31');
        $this->assertEquals($client->phone, '999999999');
        $this->assertEquals($client->customer_id, $customer_id);
    }

    /**
     * test update client
     */
    public function test_update_client(): void
    {    
        $client = Client::factory()->create();

        $client->update([
            'name' => 'Test',
            'street' => 'Rua teste',
            'number' => '123',
            'locality' => 'Bairro teste',
            'city' => 'Teste City',
            'region_code' => 'MG',
            'postal_code' => '99999999',
            'complement' => 'casa',
            'birth_date' => '1995-10-10',
            'cpf' => '11111111111',
            'country' => '55',
            'area' => '31',
            'phone' => '999999999'
        ]);

        $this->assertEquals($client->name, 'Test');
        $this->assertEquals($client->street, 'Rua teste');
        $this->assertEquals($client->number, '123');
        $this->assertEquals($client->locality, 'Bairro teste');
        $this->assertEquals($client->city, 'Teste City');
        $this->assertEquals($client->region_code, 'MG');
        $this->assertEquals($client->postal_code, '99999999');
        $this->assertEquals($client->complement, 'casa');
        $this->assertEquals($client->birth_date, '1995-10-10');
        $this->assertEquals($client->cpf, '11111111111');
        $this->assertEquals($client->country, '55');
        $this->assertEquals($client->area, '31');
        $this->assertEquals($client->phone, '999999999');
    }

    /** 
     * test delete client 
     */
    public function test_delete_client():void
    {
        $client = Client::factory()->create();

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
        ]);

        $client->delete();

        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }

    /** 
     * test not create client all wrong data
     */
    public function test_not_create_all_wrong_data_client(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Client::factory()->create([
            'user_id' => fake()->randomDigit(),
            'name' => fake()->randomDigit(),
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
            'customer_id' => fake()->text(101)
        ]);
    }
}
