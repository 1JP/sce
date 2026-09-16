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
        $totalComments = $post->comments->count();
        $post->total_comments = $totalComments;
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
        $post->most_commented_comments = $this->most_commented_comments($post);
        $post->positive_comments = $this->positive_comments($post);
        $post->negative_comments = $this->negative_comments($post);
        $post->neutral_comments = $this->neutral_comments($post);

        return view('report.comment', compact('post'));
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
