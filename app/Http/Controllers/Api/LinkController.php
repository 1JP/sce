<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Link;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Returns the chart data for links grouped by month for a given year.
     * */
    public function chartline(Request $request)
    {
        $year = (int) $request->query('year', now()->year);

        $months = [
            'Janeiro','Fevereiro','Março','Abril','Maio','Junho',
            'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'
        ];

        $links = Link::query()->whereYear('created_at', $year)->get();
        $counts = array_fill(0, 12, 0);

        foreach ($links as $link) {
            $month = (int) $link->created_at->format('n');
            $counts[$month - 1]++;
        }

        $currentTotal = array_sum($counts);
        $previousYear = $year - 1;
        $previousLinks = Link::query()->whereYear('created_at', $previousYear)->get();
        $previousCounts = array_fill(0, 12, 0);

        foreach ($previousLinks as $link) {
            $month = (int) $link->created_at->format('n');
            $previousCounts[$month - 1]++;
        }

        $previousTotal = array_sum($previousCounts);
        $percentageIncrease = $previousTotal === 0
            ? 100.0
            : (($currentTotal - $previousTotal) / $previousTotal) * 100;

        $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');

        return response()->json([
            'year' => $year,
            'labels' => $months,
            'counts' => array_values($counts),
            'percentage_increase' => round($percentageIncrease, 2),
            'trend' => $trend,
            'previous_year' => $previousYear,
            'current_year_total' => $currentTotal,
            'previous_year_total' => $previousTotal,
        ]);
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
