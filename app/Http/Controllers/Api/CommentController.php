<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function chartline(Request $request)
    {
        $year = (int) $request->query('year', now()->year);
        $user = Auth::user();

        $months = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro',
        ];

        $commentsQuery = Comment::query()->whereYear('created_at', $year);
        $commentsQuery = $this->filterCommentsByScope($commentsQuery, $user);
        $comments = $commentsQuery->get();

        $counts = array_fill(0, 12, 0);

        foreach ($comments as $comment) {
            $month = (int) $comment->created_at->format('n');
            $counts[$month - 1]++;
        }

        $totalCurrentYear = array_sum($counts);

        $previousYear = $year - 1;
        $previousCommentsQuery = Comment::query()->whereYear('created_at', $previousYear);
        $previousCommentsQuery = $this->filterCommentsByScope($previousCommentsQuery, $user);
        $previousComments = $previousCommentsQuery->get();

        $previousCounts = array_fill(0, 12, 0);
        foreach ($previousComments as $comment) {
            $month = (int) $comment->created_at->format('n');
            $previousCounts[$month - 1]++;
        }

        $totalPreviousYear = array_sum($previousCounts);

        if ($totalPreviousYear === 0) {
            $percentageIncrease = 100.0;
            $trend = 'positive';
        } else {
            $percentageIncrease = (($totalCurrentYear - $totalPreviousYear) / $totalPreviousYear) * 100;
            $trend = $percentageIncrease > 0 ? 'positive' : ($percentageIncrease < 0 ? 'negative' : 'neutral');
        }

        return response()->json([
            'year' => $year,
            'labels' => $months,
            'counts' => array_values($counts),
            'percentage_increase' => round($percentageIncrease, 2),
            'trend' => $trend,
            'previous_year' => $previousYear,
            'current_year_total' => $totalCurrentYear,
            'previous_year_total' => $totalPreviousYear,
        ]);
    }

    /**
     * Filters comments based on the user's scope.
     */
    private function filterCommentsByScope($query, ?User $user)
    {
        if (!$user) {
            return $query;
        }

        if ($user->isRoot()) {
            return $query;
        }

        if ($user->isAdmin()) {
            return $query->whereHas('post', function ($postQuery) use ($user) {
                $postQuery->where('user_id', $user->id);
            });
        }

        if ($user->isMember()) {
            $administrator = $user->administrator()->first()?->user;
            if (!$administrator) {
                return $query->whereRaw('1 = 0');
            }

            return $query->whereHas('post', function ($postQuery) use ($administrator) {
                $postQuery->where('user_id', $administrator->id);
            });
        }

        return $query;
    }
}
