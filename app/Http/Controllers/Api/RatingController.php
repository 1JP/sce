<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Post;
use App\Models\PostRating;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RatingController extends Controller
{
    /**
     * Store or update a rating for a post.
     */
    public function store(RatingRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            $validated = $request->validated();

            $user = Auth::user();
            $postId = $validated['post_id'];
            $ratingValue = $validated['rating'];

            $existingRating = PostRating::where('post_id', $postId)
                ->where('user_id', $user->id)
                ->first();

            if ($existingRating) {
                $existingRating->update(['rating' => $ratingValue]);
            } else {
                PostRating::create([
                    'post_id' => $postId,
                    'user_id' => $user->id,
                    'rating' => $ratingValue,
                ]);
            }

            $post = Post::find($postId);

            return response()->json([
                'average_rating' => $post->note,
                'note' => $ratingValue,
                'message' => 'Avaliação salva com sucesso.',
            ]);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Dados inválidos.', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao processar a solicitação.'], 500);
        }
    }

    /**
     * Get the rating for a specific user and post.
     */
    public function getRating(User $user, Post $post)
    {
        $rating = PostRating::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->first();

        return RatingResource::make($rating);
    }
}
