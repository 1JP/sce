<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function chartline(Request $request)
    {
        $year = (int) $request->query('year', now()->year);

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

        $comments = Comment::query()
            ->whereYear('created_at', $year)
            ->get();

        $counts = array_fill(0, 12, 0);

        foreach ($comments as $comment) {
            $month = (int) $comment->created_at->format('n');
            $counts[$month - 1]++;
        }

        $totalCurrentYear = array_sum($counts);

        $previousYear = $year - 1;
        $previousComments = Comment::query()
            ->whereYear('created_at', $previousYear)
            ->get();

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
}
