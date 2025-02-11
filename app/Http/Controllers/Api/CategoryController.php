<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

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
        })
        ->get();

        return CategoryResource::collection($categories);
    }
}
