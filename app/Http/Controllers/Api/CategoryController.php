<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('viewAny', Auth::user());
        
        $validated = $request->validated();

        $categories = Category::when(isset($validated['search']['name']), function ($query) use ($validated) {
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })->when(isset($validated['search']['status']), function ($query) use ($validated) {
            $query->where('active', '=', $validated['search']['status']);
        })->when(isset($validated['search']['category_type_id']), function ($query) use ($validated) {
            $type = CategoryType::where('id', '=', $validated['search']['category_type_id'])
                ->first();
            $query->whereIn('id', $type->categories()->pluck('id')->toArray());
        })
        ->paginate(10);

        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified resource.
     */
    public function myPosts(Category $category, PaginateRequest $request)
    {
        $validated = $request->validated();
        $per_page = $validated['paginate']['per_page'] ?? 30;
        $order_direction = $validated['search']['order_direction'] ?? 'asc';

        $posts = $category->posts()->active()
            ->orderBy('name', $order_direction)
            ->paginate($per_page);

        return PostResource::collection($posts);
    }

    /**
     * Get paginated posts for a given category and category type.
     *
     * @param  \App\Models\Category      $category  The category to filter posts by.
     * @param  \App\Models\CategoryType  $type      The category type to filter posts by.
     * @param  \App\Http\Requests\PaginateRequest  $request  Validated pagination and ordering params.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCategoryTypeForPost(Category $category, CategoryType $type, PaginateRequest $request)
    {
        $validated = $request->validated();
        $per_page = $validated['paginate']['per_page'] ?? 30;
        $order_direction = $validated['search']['order_direction'] ?? 'asc';

        $posts = $category->posts()->active()
            ->where('category_type_id', $type->id)
            ->orderBy('name', $order_direction)
            ->paginate($per_page);

        return PostResource::collection($posts);
    }

    /**
     * List all categories, ordered alphabetically by name.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        $this->authorize('viewAny', Category::class);
        
        $categories = Category::orderBy('name', 'ASC')
            ->paginate(10);

        return CategoryResource::collection($categories);
    }
}
