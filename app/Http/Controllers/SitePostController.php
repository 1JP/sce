<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        
        
        return view('site.post.show', compact('post'));
    }

}
