<?php

namespace Tests\Unit\Policy;

use App\Models\Deslink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeslinkPolicyTest extends TestCase
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
     * test policy delete deslink
     */
    public function test_user_can_delete_deslink()
    {
        $deslink = Deslink::factory()->create([
            'user_id' => $this->user
        ]);

        $this->assertTrue($this->user->can('delete', $deslink));
    }

    /**
     * test policy cannot delete deslink
     */
    public function test_user_cannot_delete_deslink()
    {
        $user = User::factory()->create();

        $deslink = Deslink::factory()->create([
            'user_id' => $user
        ]);

        $this->assertTrue($this->user->can('delete', $deslink));
    }

}
