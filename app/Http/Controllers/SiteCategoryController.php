<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class SiteCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('site.category.show', compact('category'));
    }


    public function getCategoryTypeForPost(Category $category, CategoryType $type)
    {
        return view('site.category.show', compact('category', 'type'));
    }
}
