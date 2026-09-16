<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;

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

    /**
     * Show the category page filtered by category type.
     *
     * @param  \App\Models\Category      $category  The category to display.
     * @param  \App\Models\CategoryType  $type      The category type to filter by.
     * @return \Illuminate\View\View
     */
    public function getCategoryTypeForPost(Category $category, CategoryType $type)
    {
        return view('site.category.show', compact('category', 'type'));
    }
}
