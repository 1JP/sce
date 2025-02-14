<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndicativeRatingResource;
use App\Models\IndicativeRating;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class IndicativeRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('viewAny', Auth::user())) {
            abort(403);
        }

        $indicative = IndicativeRating::orderBy('indicative')->get();

        return IndicativeRatingResource::collection($indicative);
    }

}
