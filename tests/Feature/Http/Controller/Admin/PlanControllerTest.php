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

    /**
     * Tests updating an existing plan.
     *
     * This test creates a mock plan, sends a PUT request to update its data, 
     * and verifies that the changes are persisted in the database.
     *
     * Steps:
     * 1. Mocks the payment API to ensure the update process runs smoothly.
     * 2. Creates a test plan with a specific customer ID.
     * 3. Sends a request to update the plan details.
     * 4. Checks if the database contains the updated plan data.
     */
    public function test_edit_plan(): void
    {
        $this->mockPaymentApi(true);

        $plan = Plan::factory()->create([
            'customer_id' => ''
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

    /**
     * Tests if a plan can be deleted correctly.
     *
     * This test creates a fake plan in the database, 
     * sends a DELETE request to remove it, and then 
     * verifies if the record was marked as deleted 
     * using soft delete.
     */
    public function test_destroy_plan(): void
    {
        $plan = Plan::factory()->create();

        $this->delete(route('admin.planos.destroy', $plan->id));
        
        $this->assertSoftDeleted('plans', [
            'id' => $plan->id,
        ]);
    }

    /**
     * Tests if a plan's status can be successfully updated to active.
     *
     * This test mocks a successful payment API response,
     * creates an inactive plan, sends a PUT request to update the plan
     * (setting it as active), and finally asserts that the plan's
     * `active` attribute is now set to 1.
     */
    public function test_alter_status_active(): void
    {
        $this->mockPaymentApi(true);

        $plan = Plan::factory()->create([
            'customer_id' => '',
            'active' => 0
        ]);

        $this->put(route('admin.planos.update', $plan->id), [
            'name' => 'Plano Premium',
            'description' => fake()->text(),
            'number_film' => 1,
            'number_book' => 2,
            'number_serie' => 3,
            'value' => '100.00',
            'active' => 1
        ]);

        $this->assertEquals($plan->active, 1);
    }

    public function test_alter_status_inactivate(): void
    {
        $this->mockPaymentApi(true);

        $plan = Plan::factory()->create([
            'customer_id' => '',
            'active' => 1
        ]);

        $this->put(route('admin.planos.update', $plan->id), [
            'name' => 'Plano Premium',
            'description' => fake()->text(),
            'number_film' => 1,
            'number_book' => 2,
            'number_serie' => 3,
            'value' => '100.00',
            'active' => 0
        ]);

        $this->assertEquals($plan->active, 0);
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
