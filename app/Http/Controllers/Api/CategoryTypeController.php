<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\CategoryTypeResource;
use App\Models\CategoryType;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = CategoryType::orderBy('name')->get();

        return CategoryTypeResource::collection($types);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        $types = CategoryType::when(isset($validated['search']['name']), function ($query) use ($validated) {
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })
        ->get();

        return CategoryTypeResource::collection($types);
    }
}
