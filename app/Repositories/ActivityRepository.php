<?php

namespace App\Repositories;

use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class ActivityRepository
{
    public function getAllActivities()
    {
        return Activity::all();
    }

    public function getTodayActivitesCountByUserId()
    {
        return Activity::where('causer_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->count();
    }

    public function getAllActivitiesByUserId()
    {
        return Activity::where('causer_id', auth()->user()->id)->get();
    }
}