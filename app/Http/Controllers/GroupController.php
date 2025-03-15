<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function all()
    {
        $groups = Group::all();
        return view('groups', [
            'groups' => $groups
        ]);
    }

    public function search(Request $request)
    {
        $activities = Activity::all();

        if(!$request->location && !$request->keyword){
            return view('home', [
                'activities' => $activities
            ]);
        }

        if (($request->location !== "") && ($request->keyword !== "")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->where('description', 'LIKE', "%$request->keyword%")
                ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->location !== "") && ($request->keyword)){
            $groups = DB::table('groups')
                            ->where('city', 'LIKE', "%$request->location%")
                            ->orWhere('postcode', 'LIKE', "%$request->location%")
                            ->get();
            return view('home', [
                'groups' => $groups,
                'activities' => $activities
            ]);
        }

        if(($request->keyword !== "") && ($request->location)){
            $groups = DB::table('groups')
                ->where('description', 'LIKE', "%$request->keyword%")
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
