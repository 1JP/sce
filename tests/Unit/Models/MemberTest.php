<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    /** @var Client */
    protected $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->client = Client::factory()->create();

    }

    /**
     * test create member
     */
    public function test_create_member(): void
    {
        $member = Member::factory()->create([
            'user_id' => $this->user->id,
            'client_id' => $this->client->id,
        ]);

        $this->assertEquals($member->client_id, $this->client->id);
        $this->assertEquals($member->user_id, $this->user->id);
    }

    /**
     * test delete member
     */
    public function test_delete_member(): void
    {
        $member = Member::factory()->create();

        $this->assertDatabaseHas('members', [
            'user_id' => $member->user_id,
            'client_id' => $member->client_id,
        ]);

        $member->delete();

        $this->assertDatabaseMissing('members', [
            'user_id' => $member->user_id,
            'client_id' => $member->client_id,
        ]);
    }
}
