<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ReportController extends Controller
{
    /**
     * Display a general report of the resource.
     */
    public function generalReport(Post $post)
    {
        $post = $post->load('category', 'indicative_rating', 'comments', 'links', 'deslinks');
        $totalReactions = $post->links->count() + $post->deslinks->count();
        
        $post->likes_total = $post->links->count();
        $post->dislikes_total = $post->deslinks->count();
        $post->likes_percentage = $totalReactions
            ? round(($post->links->count() / $totalReactions) * 100)
            : 0;
        $post->dislikes_percentage = $totalReactions
            ? round(($post->deslinks->count() / $totalReactions) * 100)
            : 0;

        $totalComments = $post->comments->count();

        $post->total_comments = $totalComments;
        $post->positive_comments_percentage = $totalComments
            ? round(($post->comments->where('sentiment', 'positive')->count() / $totalComments) * 100)
            : 0;
        $post->negative_comments_percentage = $totalComments
            ? round(($post->comments->where('sentiment', 'negative')->count() / $totalComments) * 100)
            : 0;
        $post->neutral_comments_percentage = $totalComments
            ? round(($post->comments->where('sentiment', 'neutral')->count() / $totalComments) * 100)
            : 0;

        $post->most_commented_comments = $post->comments()
            ->whereNull('comment_id')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        $post->positive_comments = $post->comments()->where('sentiment', 'positive')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        $post->negative_comments = $post->comments()->where('sentiment', 'negative')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        $post->neutral_comments = $post->comments()->where('sentiment', 'neutral')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        return view('report.general', compact('post'));
    }

    /**
     * Display a comment report of the resource.
     */
    public function commentReport()
    {
        return view('report.comment');
    }
}
