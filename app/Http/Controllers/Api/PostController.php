<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostAllRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Retrieve the 10 highest-ranked active posts by note and link count.
     */
    public function top()
    {
        $posts = Post::active()
            ->withCount('links')
            ->get();

        $posts = $posts
            ->sort(function ($first, $second) {
                $noteComparison = $second->note <=> $first->note;

                if ($noteComparison !== 0) {
                    return $noteComparison;
                }

                return $second->links_count <=> $first->links_count;
            })
            ->take(10)
            ->values();

        return PostResource::collection($posts);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', $user);

        $posts = match (true) {
            $user->hasRole('Membros') => $user->administrator[0]->user?->posts ?? collect(),
            $user->hasRole('Admin') => $user->posts,
            $user->hasRole('Root') => Post::orderBy('name')->get()
        };

        return PostResource::collection($posts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return PostResource::make($post);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $user = Auth::user();

        $this->authorize('viewAny', $user);
        
        $validated = $request->validated();
        
        $posts = Post::when($user->isAdmin(), function($query) use ($user){
            $query->where('user_id', $user->id);
        })
        ->when($user->isMember(), function($query) use ($user){
            $administrator = $user->administrator()->first()->user;

            $query->where('user_id', $administrator->id);
        })
        ->when(isset($validated['search']['name']), function ($query) use ($validated){
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })->when(isset($validated['search']['status']), function ($query) use ($validated){
            $query->where('active', '=', $validated['search']['status']);
        })->when(isset($validated['search']['category_id']), function ($query) use ($validated){
            $query->where('category_id', '=', $validated['search']['category_id']);
        })->when(isset($validated['search']['indicative_rating_id']), function ($query) use ($validated){
            $query->where('indicative_rating_id', '=', $validated['search']['indicative_rating_id']);
        })->when(isset($validated['search']['category_type_id']), function ($query) use ($validated){
            $query->where('category_type_id', '=', $validated['search']['category_type_id']);
        })->orderBy('name', 'ASC')->get();

       return PostResource::collection($posts);
    }

    /**
     * Retrieve all active posts ordered alphabetically by name.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all(PostAllRequest $request)
    {
        $validated = $request->validated();

        $posts = Post::active()->orderBy('name', $validated['order_direction'])
            ->paginate($validated['per_page']);

        return PostResource::collection($posts);
    }

    /**
     * Retrieve root comments for a given post, ordered by most recent.
     *
     * @param Post $post
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function comments(Post $post)
    {
        $comments = $post->comments()->whereNull('comment_id')->orderBy('created_at', 'DESC')->get();
        
        return CommentResource::collection($comments);
    }
}
