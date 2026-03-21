<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->hasRole(['Root', 'Admin'])){
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return UserResource::collection($user->client->members);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $user = Auth::user();
        
        if(!$user->hasRole(['Root', 'Admin'])){
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validated();

        $members = $user->client->members()->when(isset($validated['search']['name']), function ($query) use ($validated) {
            $query->where('name', 'like', '%'.$validated['search']['name'].'%');
        })->when(isset($validated['search']['email']), function ($query) use ($validated) {
            $query->where('email', 'like', '%'.$validated['search']['email'].'%');
        })
        ->get();

        return UserResource::collection($members);
    }
}
