<?php

namespace App\Models;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait AppLogModel
{
    use LogsActivity;

    /**
     * Configure activity log options for this model.
     *
     * Logs all attributes (`*`) on create, update, and delete events,
     * using the default settings provided by the Activitylog package.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }

    /**
     * Customize the activity log entry before it is saved.
     *
     * Associates the currently authenticated user (if any) as the
     * causer of the activity, so actions performed via API tokens or
     * guards not automatically detected by the Activitylog package
     * are still attributed to the correct user.
     *
     * @param  \Spatie\Activitylog\Models\Activity  $activity
     * @param  string  $eventName
     * @return void
     */
    public function tapActivity(Activity $activity, string $eventName)
    {
        $user = request()->user();
        if ($user) {
            $activity->causer()->associate($user);
        }
    }
}
