<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesLinkRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class DesLinkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(DesLinkRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            $validated = $request->validated();

            if ($validated['post_id'] ?? null) {
                $this->togglePostDesLink(Auth::user(), $validated['post_id']);
            }

            if ($validated['comment_id'] ?? null) {
                $this->toggleCommentDesLink(Auth::user(), $validated['comment_id']);
            }

            return response()->json([
                'countPost' => isset($validated['post_id'])
                    ? Post::find($validated['post_id'])?->deslinks()->count() ?? 0
                    : 0,

                'countComment' => isset($validated['comment_id'])
                    ? Comment::find($validated['comment_id'])?->deslinks()->count() ?? 0
                    : 0,
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Não encontrado.'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao processar a solicitação.'], 500);
        }
    }

    /**
     * Toggles the deslink status for a post.
     */
    private function togglePostDesLink(User $user, int $postId): void
    {
        $deslinks = $user->deslinks()->where('post_id', $postId)->first();

        $deslinks ? $deslinks->delete() : $user->deslinks()->create(['post_id' => $postId]);
    }

    /**
     * Toggles the deslink status for a comment.
     */
    private function toggleCommentDesLink(User $user, int $commentId): void
    {
        $deslinks = $user->deslinks()->where('comment_id', $commentId)->first();

        $deslinks ? $deslinks->delete() : $user->deslinks()->create(['comment_id' => $commentId]);
    }

}
