<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
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

        $selected_categories_id = $validated['search']['category_id'] ?? [];
        $selected_indicative_ratings_id = $validated['search']['indicative_rating_id'] ?? [];
        $posts = Post::active()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('name', $order_direction)
            ->paginate($per_page)
            ->through(function ($post) {
                $post->setRelation('images', $post->images->isNotEmpty()
                    ? $post->images->map(function ($image) {
                        $image->image = asset('storage/' . $image->name);
                        return $image;
                    })
                    : collect([['image' => asset('site/img/logo-favicon.jpeg'), 'name' => 'Default']])
                );

                $post->countLinks    = $post->links->count();
                $post->countDeslikes = $post->deslinks->count();

                return $post;
            });
        
        $category_ids = $this->getCategories($validated, $search, $order_direction);
        $indicative_rating_ids = $this->getIndicativeRatings($validated, $search, $order_direction);
        
        return view('site.search.index', compact('posts', 'search', 'category_ids', 'indicative_rating_ids', 'selected_categories_id', 'selected_indicative_ratings_id'));
    }

    /**
     * Get the categories based on the search criteria.
     */
    private function getCategories(array $validated, string $search, string $order_direction): array
    {
        return Post::select('category_id')
            ->active()
            ->when($validated['search']['category_id'] ?? null, function ($query, $category_id) {
                $query->whereIn('category_id', $category_id);
            })
            ->when($validated['search']['indicative_rating_id'] ?? null, function ($query, $indicative_rating_id) {
                $query->whereIn('indicative_rating_id', $indicative_rating_id);
            })
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('name', $order_direction)
            ->get()->pluck('category_id')->unique()->toArray();
    }

    /* 
     * Get the indicative ratings based on the search criteria.
     */
    private function getIndicativeRatings(array $validated, string $search, string $order_direction): array
    {
        return Post::select('indicative_rating_id')
            ->active()
            ->when($validated['search']['category_id'] ?? null, function ($query, $category_id) {
                $query->whereIn('category_id', $category_id);
            })
            ->when($validated['search']['indicative_rating_id'] ?? null, function ($query, $indicative_rating_id) {
                $query->whereIn('indicative_rating_id', $indicative_rating_id);
            })
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orderBy('name', $order_direction)
            ->get()->pluck('indicative_rating_id')->unique()->toArray();
    }
}
