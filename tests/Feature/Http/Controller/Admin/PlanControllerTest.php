<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Models\Plan;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class PlanControllerTest extends TestCase
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
     * Test the store method to ensure a plan is created successfully.
     * 
     * This test mocks a successful response from the payment API,
     * sends a POST request to create a new plan with valid data,
     * and checks if the plan is successfully stored in the database.
     */
    public function test_store_plan(): void
    {
        $this->mockPaymentApi(true);

        $this->post(route('admin.planos.store'), [
            'name' => 'Plano Premium',
            'description' => fake()->text(),
            'number_film' => 1,
            'number_book' => 2,
            'number_serie' => 3,
            'value' => '100.00'
        ]);

        $this->assertDatabaseHas('plans', ['name' => 'Plano Premium']);

    }

    /**
     * Test the store method to ensure it fails correctly when the payment API returns an error.
     * 
     * This test mocks the payment API to simulate a failure scenario (by returning false),
     * sends a POST request to store a plan without the 'description' field (which is required),
     * and checks that a validation error is triggered for the 'description' field.
     */
    public function test_store_fails_due_to_payment_api()
    {
        $this->mockPaymentApi(false);

        $data = [
            'name' => 'Plano Premium',
            'number_film' => 1,
            'number_book' => 2,
            'number_serie' => 3,
            'value' => '100.00'
        ];

        $response = $this->post(route('admin.planos.store'), $data);
        
        $response->assertSessionHasErrors(['description']);
    }

    public function test_update_plan(): void
    {
        $this->mockPaymentApi(true);

        $plan = Plan::factory()->create([
            'customer_id' => 'PLAN_FA7A96BE-469B-4C92-8402-50270D5402A9'
        ]);

        $this->put(route('admin.planos.update', $plan->id), [
            'name' => 'Plano Premium',
            'description' => fake()->text(),
            'number_film' => 1,
            'number_book' => 2,
            'number_serie' => 3,
            'value' => '100.00'
        ]);

        $this->assertDatabaseHas('plans', ['name' => 'Plano Premium']);

    }

    private function mockPaymentApi($success)
    {
        $mockPaymentApi = Mockery::mock();
        
        if ($success) {
            $mockPaymentApi->shouldReceive('createPlan')->andReturn((object) ['id' => 'PLAN_XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX']);
        } else {
            $mockPaymentApi->shouldReceive('createPlan')->andReturn((object) ['error_messages' => 'Não foi possível criar o plano!']);
        }

        $this->app->instance('PaymentApi', $mockPaymentApi);
    }
}
