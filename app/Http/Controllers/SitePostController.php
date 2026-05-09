<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class SitePostController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->images = $post->images()->count() > 0
            ? $post->images->map(function ($image) {
                $image->image = asset('storage/' . $image->name);
                return $image;
            })
            : [['image' => asset('site/img/logo-favicon.jpeg'), 'name' => 'Default']];
        
        $post->countLinks = $post->links()->count();
        $post->countDeslikes = $post->deslinks()->count();

        return view('site.post.show', compact('post'));
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $per_page = $validated['paginate']['per_page'] ?? 30;
        $order_direction = $validated['search']['order_direction'] ?? 'ASC';

        $posts = Post::active()->when(isset($validated['search']['category_id']), function ($query) use ($validated){
            $query->whereIn('category_id', $validated['search']['category_id']);
        })->when(isset($validated['search']['indicative_rating_id']), function ($query) use ($validated){
            $query->whereIn('indicative_rating_id', $validated['search']['indicative_rating_id']);
        })->orderBy('name', $order_direction)
        ->paginate($per_page);

       return PostResource::collection($posts);
    }
}
