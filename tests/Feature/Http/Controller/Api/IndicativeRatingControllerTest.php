<?php

namespace Tests\Feature\Http\Controller\Api;

use App\Models\IndicativeRating;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndicativeRatingControllerTest extends TestCase
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
     * test search indicative rating
     */
    public function test_search_indicative_rating(): void
    {
        $indicative = IndicativeRating::factory()->count(3)->create();
        $name = $indicative[0]->indicative;

        $searchName = $this->get(route('api.admin.indicative-rating.search'), [
            'search' => [
                'name' => $name
            ]
        ]);

        $searchName->assertOk();
        $searchName->assertJsonFragment([
            'indicative' => $name,
        ]);
    }
}
