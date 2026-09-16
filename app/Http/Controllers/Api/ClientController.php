<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Client::class);

        $clients = Client::withTrashed()
            ->orderBy('name')
            ->paginate(10);
        
        return ClientResource::collection($clients);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('viewAny', Auth::user());
        
        $validated = $request->validated();

        $clients = Client::withTrashed()
        ->when(isset($validated['search']['name']), function ($query) use ($validated) {
            $query->whereHas('users', function ($query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['search']['name'] . '%');
            });
        })->when(isset($validated['search']['status']), function ($query) use ($validated) {
            $query->whereHas('users', function ($query) use ($validated) {
                $query->whereHas('subscription', function ($query) use ($validated) {
                    $query->where('status', $validated['search']['status']);
                });
            });
        })->orderBy('name')
        ->paginate(10);

        return ClientResource::collection($clients);
    }
}
