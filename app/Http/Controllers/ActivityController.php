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

}
