<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class SiteSearchController extends Controller
{
    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        $search = $validated['search']['search'] ?? [];
        $order_direction = $validated['search']['order_direction'] ?? 'ASC';
        $per_page = $validated['paginate']['per_page'] ?? 30;

        $posts = Post::active()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('name', $order_direction)
            ->paginate($per_page);

        return view('site.search.index', compact('posts', 'search'));
    }
}
