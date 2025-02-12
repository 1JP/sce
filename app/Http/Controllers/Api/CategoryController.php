<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\CategoryTypeCategory;

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
        ->get();

        return CategoryResource::collection($categories);
    }
}
