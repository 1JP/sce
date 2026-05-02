<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{  
    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            $validated = $request->validated();

            if ($validated['post_id'] ?? null) {
                $this->togglePostLink(Auth::user(), $validated['post_id']);
            }

            if ($validated['comment_id'] ?? null) {
                $this->toggleCommentLink(Auth::user(), $validated['comment_id']);
            }

            return response()->json([
                'countPost' => isset($validated['post_id'])
                    ? Post::find($validated['post_id'])?->links()->count() ?? 0
                    : 0,

                'countComment' => isset($validated['comment_id'])
                    ? Comment::find($validated['comment_id'])?->links()->count() ?? 0
                    : 0,
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Não encontrado.'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao processar a solicitação.'], 500);
        }
        
    }

    /**
     * Toggles the link status for a post.
     */
    private function togglePostLink(User $user, int $postId): void
    {
        $link = $user->links()->where('post_id', $postId)->first();

        $link ? $link->delete() : $user->links()->create(['post_id' => $postId]);
    }

    /**
     * Toggles the link status for a comment.
     */
    private function toggleCommentLink(User $user, int $commentId): void
    {
        $link = $user->links()->where('comment_id', $commentId)->first();

        $link ? $link->delete() : $user->links()->create(['comment_id' => $commentId]);
    }
}
