<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
