<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesLinkRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Deslink;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Returns the chart data for deslinks grouped by month for a given year.
     * */
    public function chartline(Request $request)
    {
        $year = (int) $request->query('year', now()->year);
        $user = Auth::user();

        $months = [
            'Janeiro','Fevereiro','Março','Abril','Maio','Junho',
            'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'
        ];

        $deslinksQuery = Deslink::query()->whereYear('created_at', $year);
        $deslinksQuery = $this->filterDeslinksByScope($deslinksQuery, $user);
        $deslinks = $deslinksQuery->get();
        $counts = array_fill(0, 12, 0);

        foreach ($deslinks as $deslink) {
            $month = (int) $deslink->created_at->format('n');
            $counts[$month - 1]++;
        }

        $currentTotal = array_sum($counts);
        $previousYear = $year - 1;
        $previousDeslinksQuery = Deslink::query()->whereYear('created_at', $previousYear);
        $previousDeslinksQuery = $this->filterDeslinksByScope($previousDeslinksQuery, $user);
        $previousDeslinks = $previousDeslinksQuery->get();
        $previousCounts = array_fill(0, 12, 0);

        foreach ($previousDeslinks as $deslink) {
            $month = (int) $deslink->created_at->format('n');
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
     * Filters deslinks based on the user's scope.
     */
    private function filterDeslinksByScope($query, ?User $user)
    {
        if (!$user) {
            return $query;
        }

        if ($user->isRoot()) {
            return $query;
        }

        if ($user->isAdmin()) {
            return $query->where(function ($q) use ($user) {
                $q->whereHas('post', function ($postQuery) use ($user) {
                    $postQuery->where('user_id', $user->id);
                })->orWhereHas('comment.post', function ($postQuery) use ($user) {
                    $postQuery->where('user_id', $user->id);
                });
            });
        }

        if ($user->isMember()) {
            $administrator = $user->administrator()->first()?->user;
            if (!$administrator) {
                return $query->whereRaw('1 = 0');
            }

            return $query->where(function ($q) use ($administrator) {
                $q->whereHas('post', function ($postQuery) use ($administrator) {
                    $postQuery->where('user_id', $administrator->id);
                })->orWhereHas('comment.post', function ($postQuery) use ($administrator) {
                    $postQuery->where('user_id', $administrator->id);
                });
            });
        }

        return $query;
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
