<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\IndicativeRatingResource;
use App\Models\IndicativeRating;

class IndicativeRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indicative = IndicativeRating::orderBy('name')->get();

        return IndicativeRatingResource::collection($indicative);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        $indicatives = IndicativeRating::when(isset($validated['search']['name']), function ($query) use ($validated) {
            $query->where('indicative', 'like', '%'.$validated['search']['name'].'%');
        })
        ->get();

        return IndicativeRatingResource::collection($indicatives);
    }
}
