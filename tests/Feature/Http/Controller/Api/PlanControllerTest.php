<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\Plan;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var Plan */
    protected $plan;

    /** @var User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed([RolesSeeder::class]);
        $this->plan = Plan::first();
        $this->be($this->user = User::factory()->create()->assignRole('Root'));
    }

    /**
     * test search plan
     */
    public function test_search_plan(): void
    {
        $plans = Plan::factory()->count(3)->create(['active' => true]);
        $name = $plans[0]->name;
        
        $searchName = $this->get(route('api.admin.plans.search'), [
            'search' => [
                'name' => $name
            ]
        ]);

        $searchName->assertOk();
        $searchName->assertJsonFragment([
            'name' => $name,
        ]);

        $searchActive = $this->get(route('api.admin.plans.search'), [
            'search' => [
                'status' => 1
            ]
        ]);

        $this->assertCount($plans->count(), $searchActive->json()['data']);

    }
}
