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
        
        $post->likes_total = $post->links->count();
        $post->dislikes_total = $post->deslinks->count();
        $post->likes_percentage = $this->likes_percentage($post);
        $post->dislikes_percentage = $this->dislikes_percentage($post);
        $totalComments = $post->comments->count();
        $post->total_comments = $totalComments;
        $post->positive_comments_percentage = $this->positive_comments_percentage($post);
        $post->negative_comments_percentage = $this->negative_comments_percentage($post);
        $post->neutral_comments_percentage = $this->neutral_comments_percentage($post);
        $post->most_commented_comments = $this->most_commented_comments($post);
        $post->positive_comments = $this->positive_comments($post);
        $post->negative_comments = $this->negative_comments($post);
        $post->neutral_comments = $this->neutral_comments($post);

        return view('report.general', compact('post'));
    }

    /**
     * Display a comment report of the resource.
     */
    public function commentReport(Post $post)
    {
        $post = $post->load('category', 'indicative_rating', 'comments', 'links', 'deslinks');

        $post->likes_percentage = $this->likes_percentage($post);
        $post->dislikes_percentage = $this->dislikes_percentage($post);
        $post->positive_comments_percentage = $this->positive_comments_percentage($post);
        $post->negative_comments_percentage = $this->negative_comments_percentage($post);
        $post->neutral_comments_percentage = $this->neutral_comments_percentage($post);
        $post->most_commented_comments = $this->most_commented_comments($post);
        $post->positive_comments = $this->positive_comments($post);
        $post->negative_comments = $this->negative_comments($post);
        $post->neutral_comments = $this->neutral_comments($post);

        return view('report.comment', compact('post'));
    }

    /**
     * Calculate the percentage of likes for a post.
     */
    private function likes_percentage($post)
    {
        $totalReactions = $post->links->count() + $post->deslinks->count();
        return $totalReactions
            ? round(($post->links->count() / $totalReactions) * 100)
            : 0;
    }

    /**
     * Calculate the percentage of dislikes for a post.
     */
    private function dislikes_percentage($post)
    {
        $totalReactions = $post->links->count() + $post->deslinks->count();
        return $totalReactions
            ? round(($post->deslinks->count() / $totalReactions) * 100)
            : 0;
    }

    /**
     * Calculate the percentage of positive comments for a post.
     */
    private function positive_comments_percentage($post)
    {
        $totalReactions = $post->links->count() + $post->deslinks->count() + $post->comments->count();
        return $totalReactions
            ? round(($post->comments->where('sentiment', 'positive')->count() / $totalReactions) * 100)
            : 0;
    }

    /**
     * Calculate the percentage of negative comments for a post.
     */
    private function negative_comments_percentage($post)
    {
        $totalReactions = $post->links->count() + $post->deslinks->count() + $post->comments->count();
        return $totalReactions
            ? round(($post->comments->where('sentiment', 'negative')->count() / $totalReactions) * 100)
            : 0;
    }

    /**
     * Calculate the percentage of neutral comments for a post.
     */
    private function neutral_comments_percentage($post)
    {
        $totalReactions = $post->links->count() + $post->deslinks->count() + $post->comments->count();
        return $totalReactions
            ? round(($post->comments->where('sentiment', 'neutral')->count() / $totalReactions) * 100)
            : 0;
    }

    /**
     * Get the most commented comments for a post.
     */
    private function most_commented_comments($post)
    {
        return $post->comments()
            ->whereNull('comment_id')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();
    }

    /**
     * Get the positive comments for a post.
     */
    private function positive_comments($post)
    {
        return $post->comments()->where('sentiment', 'positive')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();
    }

    /**
     * Get the negative comments for a post.
     */
    private function negative_comments($post)
    {
        return $post->comments()->where('sentiment', 'negative')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();
    }

    /**
     * Get the neutral comments for a post.
     */
    private function neutral_comments($post)
    {
        return $post->comments()->where('sentiment', 'neutral')
            ->withCount(['links', 'deslinks', 'comments'])
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();
    }
}
