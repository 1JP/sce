<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $plans = Plan::all();

        return PlanResource::collection($plans);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        $this->authorize('view', Auth::user());

        return PlanResource::make($plan);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('viewAny', Auth::user());

        $validated = $request->validated();

        $plans = Plan::when(isset($validated['search']['name']), function ($query) use ($validated){
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })->when(isset($validated['search']['status']), function ($query) use ($validated){
            $query->where('active', '=', $validated['search']['status']);
        })->get();

       return PlanResource::collection($plans);
    }

}
