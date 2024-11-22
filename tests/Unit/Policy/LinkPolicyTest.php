<?php

namespace Tests\Unit\Policy;

use App\Models\Comment;
use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkPolicyTest extends TestCase
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
     * test policy delete link
     */
    public function test_user_can_delete_link()
    {
        $comment = Comment::factory()->create();
        dd($comment);
        $link = Link::factory()->create([
            'user_id' => $this->user
        ]);

        $this->assertTrue($this->user->can('delete', $link));
    }

    /**
     * test policy cannot delete link
     */
    public function test_user_cannot_delete_link()
    {
        $user = User::factory()->create();

        $link = Link::factory()->create([
            'user_id' => $user
        ]);

        $this->assertTrue($this->user->can('delete', $link));
    }
}
