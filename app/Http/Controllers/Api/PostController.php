<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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
        })->orderBy('name', 'ASC')->get();

       return PostResource::collection($posts);
    }

    /**
     * Retrieve all active posts ordered alphabetically by name.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        $posts = Post::active()->orderBy('name')->get();

        return PostResource::collection($posts);
    }
}
