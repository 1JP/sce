<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\UserResource;
use App\Models\Member;
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

        $members = match (true) {
            $user->hasRole('Admin') => $user->client->members()->orderBy('name')->paginate(10),
            $user->hasRole('Root') => Member::join('users', 'members.user_id', '=' , 'users.id')->orderBy('users.name')->paginate(10)
        };

        return UserResource::collection($members);
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
