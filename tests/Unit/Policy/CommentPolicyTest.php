<?php

namespace Tests\Unit\Policy;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CommentPolicyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @var User */
    protected $userAdmin;
    protected $userMembro;
    protected $userUsuario;
    protected $userRoot;

    /** @var Post */
    protected $post;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->seed(RolesSeeder::class);

        $roleAdmin = Role::where('name', 'Admin')->first();
        $roleMembros = Role::where('name', 'Membros')->first();
        $roleUsuario = Role::where('name', 'Usuario')->first();
        $roleRoot = Role::where('name', 'Root')->first();

        $this->userAdmin = User::factory()->create()->assignRole($roleAdmin->id);
        $this->userMembro = User::factory()->create()->assignRole($roleMembros->id);
        $this->userUsuario = User::factory()->create()->assignRole($roleUsuario->id);
        $this->userRoot = User::factory()->create()->assignRole($roleRoot->id);
        $this->post = Post::factory()->create([
            'user_id' => $this->userAdmin->id
        ]);
    }

    /**
     * test policy update comment
     */
    public function test_user_can_update_comment()
    {
        $comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $this->userUsuario->id
        ]);

        $comment->update([
            'description'=> fake()->text()
        ]);

        $this->assertTrue($this->userRoot->can('update', $comment));
        $this->assertTrue($this->userUsuario->can('update', $comment));
    }

    /**
     * test policy delete comment
     */
    public function test_user_can_delete_comment()
    {
        $comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $this->userUsuario->id
        ]);

        $this->assertTrue($this->userRoot->can('delete', $comment));
        $this->assertTrue($this->userUsuario->can('delete', $comment));
    }

    /**
     * test policy cannot delete comment
     */
    public function test_user_cannot_delete_comment()
    {
        $userTeste = User::factory()->create()->assignRole('Usuario');

        $comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $userTeste->id
        ]);

        $comment->update([
            'description'=> fake()->text()
        ]);

        $this->assertFalse($this->userAdmin->can('delete', $comment));
        $this->assertFalse($this->userMembro->can('delete', $comment));
        $this->assertFalse($this->userUsuario->can('delete', $comment));
    }

    /**
     * test policy cannot update comment
     */
    public function test_user_cannot_update_comment()
    {
        $userTeste = User::factory()->create()->assignRole('Usuario');

        $comment = Comment::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $userTeste->id
        ]);

        $this->assertFalse($this->userAdmin->can('update', $comment));
        $this->assertFalse($this->userMembro->can('update', $comment));
        $this->assertFalse($this->userUsuario->can('update', $comment));
    }
}
