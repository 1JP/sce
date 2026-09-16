<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Activity::class);

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Usuário'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'Ação'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Descrição'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Horário'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.log.index', compact('ths'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $this->authorize('view', $activity);

        $causer_name = 'Sistema';
        if (!empty($activity->causer_type)) {
            $causer_name = $activity->causer->name;
        }
        $activity->causer_name = $causer_name;
        $activity->properties = json_decode($activity->properties, true);
        $activity->created = $activity->created_at->format('d-m-Y H:i:s');
        
        return view('admin.log.show', compact('activity'));
    }

}
