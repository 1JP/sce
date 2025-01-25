<?php

namespace App\Models;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait AppLogModel
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $user = request()->user();
        if ($user) {
            $activity->causer()->associate($user);
        }
    }
}
