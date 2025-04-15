<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function all()
    {
        $activities = Activity::all();

        return $activities;
    }

    //    public function activity1()
    //    {
    //        $activity1 = Activity::class->activity1();
    //        return $activity1;
    //    }
}
