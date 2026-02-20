<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('name', 'ASC')->get();
        return PostResource::collection($posts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        $posts = Post::when(isset($validated['search']['name']), function ($query) use ($validated){
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })->when(isset($validated['search']['status']), function ($query) use ($validated){
            $query->where('active', '=', $validated['search']['status']);
        })->when(isset($validated['search']['category_id']), function ($query) use ($validated){
            $query->where('category_id', '=', $validated['search']['category_id']);
        })->when(isset($validated['search']['indicative_rating_id']), function ($query) use ($validated){
            $query->where('indicative_rating_id', '=', $validated['search']['indicative_rating_id']);
        })->get();

       return PostResource::collection($posts);
    }
}
