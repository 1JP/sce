<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $roles = Role::latest()->paginate(10);
        
        return RoleResource::collection($roles);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('viewAny', Auth::user());

        $validated = $request->validated();

        $roles = Role::when(isset($validated['search']['name']), function ($query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['search']['name'] . '%');
            })
            ->latest()
            ->paginate(10);

        return RoleResource::collection($roles);

    }
}
