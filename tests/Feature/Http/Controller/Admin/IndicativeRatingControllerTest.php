<?php

namespace Tests\Feature\Http\Controller\Admin;

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
     * test create indicative rating
     */
    public function test_create_indicative_rating(): void
    {
        $this->post(route('admin.classificacao-indicativas.store'), [
            'name' => 'Filme Test',
            'description' => fake()->text(),
        ]);

        $this->assertDatabaseHas('indicative_ratings', [
            'name' => 'Filme Test',
        ]);

    }

    /** 
     * test update indicative 
     */
    public function test_update_indicative(): void
    {
        $indicative = IndicativeRating::factory()->create([
            'description' => 'Old Description',
        ]);
        $description = 'Test description';

        $this->patch(route('admin.classificacao-indicativas.update', $indicative->id), [
            'name' => $indicative->indicative,
            'description' => $description,
        ]);

        $this->assertDatabaseHas('indicative_ratings', [
            'description' => $description,
        ]);
        
    }

    /** 
     * test delete indicative 
     */
    public function test_delete_indicative():void
    {
        $indicative = IndicativeRating::factory()->create();

        $this->assertDatabaseHas('indicative_ratings', [
            'id' => $indicative->id,
        ]);

        $this->delete(route('admin.classificacao-indicativas.destroy', $indicative->id));

        $indicative->delete();

        $this->assertDatabaseMissing('indicative_ratings', [
            'id' => $indicative->id,
        ]);
    }
}
