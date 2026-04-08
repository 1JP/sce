<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ActivityResource;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $activities = Activity::with('causer')->latest()->paginate(10);
        return ActivityResource::collection($activities);
    }

    /**
     * Search a listing of the resource.
     */
    public function search(SearchRequest $request)
    {
        $this->authorize('viewAny', Auth::user());

        $validated = $request->validated();

        $activities = Activity::with('causer')
            ->when(isset($validated['search']['name']), function ($query) use ($validated) {
                $query->whereHas('causer', function ($query) use ($validated) {
                    $query->where('name', 'like', '%' . $validated['search']['name'] . '%');
                });
            })
            ->when(isset($validated['search']['action']), function ($query) use ($validated) {
                $action = $validated['search']['action'];

                $actionMap = [
                    'Criado'     => 'created',
                    'Atualizado' => 'updated',
                    'Deletado'   => 'deleted',
                ];

                if (isset($actionMap[$action])) {
                    $query->where('description', 'like', '%' . $actionMap[$action] . '%');
                }
            })
            ->when(isset($validated['search']['from']), function ($query) use ($validated) {
                $query->whereDate('created_at', '>=', $validated['search']['from']);
            })
            ->when(isset($validated['search']['to']), function ($query) use ($validated) {
                $query->whereDate('created_at', '<=', $validated['search']['to']);
            })
            ->latest()
            ->paginate(10);

        return ActivityResource::collection($activities);
    }
}
