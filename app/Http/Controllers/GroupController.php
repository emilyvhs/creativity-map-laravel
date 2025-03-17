<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function all()
    {
        $groups = Group::all();

        return view('groups', [
            'groups' => $groups,
        ]);
    }


    public function search(Request $request)
    {
        $activities = Activity::all();

        if(!$request->location && !$request->name && !$request->activity){
            return view('home', [
                'activities' => $activities
            ]);
        }

        if (($request->location !== "") && ($request->name !== "") && ($request->activity != "all")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->where('name', 'LIKE', "%$request->name%")
                ->whereAny([
                    'activity1',
                    'activity2',
                    'activity3',
                ], '=', "$request->activity")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->location !== "") && ($request->name !== "") && ($request->activity === "all")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->where('name', 'LIKE', "%$request->name%")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }
//
        if(($request->name !== "") && ($request->activity != "all") && ($request->location === "")){
            $groups = DB::table('groups')
                ->where('name', 'LIKE', "%$request->name%")
                ->whereAny([
                    'activity1',
                    'activity2',
                    'activity3',
                ], '=', "$request->activity")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->location !== "") && ($request->activity != "all") && ($request->name === "")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->whereAny([
                    'activity1',
                    'activity2',
                    'activity3',
                ], '=', "$request->activity")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->location !== "") && ($request->activity === "all") && ($request->name === "")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->name !== "") && ($request->activity === "all") && ($request->location === "")){
            $groups = DB::table('groups')
                ->where('name', 'LIKE', "%$request->name%")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->activity != "all") && ($request->name === "") && ($request->location === "")){
            $groups = DB::table('groups')
                ->whereAny([
                    'activity1',
                    'activity2',
                    'activity3',
                ], '=', "$request->activity")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

            return view('home', [
                'activities' => $activities
            ]);



    }
}
