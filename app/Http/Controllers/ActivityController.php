<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function all()
    {
        $activities = Activity::all();
        return $activities;
    }
}
