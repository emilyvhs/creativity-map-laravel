<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Group;
use App\Models\PendingGroup;
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

    public function find(int $id)
    {
        $group = Group::find($id);

        return view('singleGroup', [
            'group' => $group,
        ]);
    }

    public function search(Request $request)
    {
        $activities = Activity::all();

        if (! $request->location && ! $request->name && ! $request->activity) {
            return view('home', [
                'activities' => $activities,
            ]);
        }

        if (($request->location !== '') && ($request->name !== '') && ($request->activity != 'all')) {
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
                'activities' => $activities,
            ]);
        }

        if (($request->location !== '') && ($request->name !== '') && ($request->activity === 'all')) {
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->where('name', 'LIKE', "%$request->name%")
                ->get();

            return view('home', [
                'groups' => $groups,
                'activities' => $activities,
            ]);
        }

        if (($request->name !== '') && ($request->activity != 'all') && ($request->location === '')) {
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
                'activities' => $activities,
            ]);
        }

        if (($request->location !== '') && ($request->activity != 'all') && ($request->name === '')) {
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
                'activities' => $activities,
            ]);
        }

        if (($request->location !== '') && ($request->activity === 'all') && ($request->name === '')) {
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->get();

            return view('home', [
                'groups' => $groups,
                'activities' => $activities,
            ]);
        }

        if (($request->name !== '') && ($request->activity === 'all') && ($request->location === '')) {
            $groups = DB::table('groups')
                ->where('name', 'LIKE', "%$request->name%")
                ->get();

            return view('home', [
                'groups' => $groups,
                'activities' => $activities,
            ]);
        }

        if (($request->activity !== 'all') && ($request->name === '') && ($request->location === '')) {
            $groups = DB::table('groups')
                ->whereAny([
                    'activity1',
                    'activity2',
                    'activity3',
                ], '=', "$request->activity")
                ->get();

            return view('home', [
                'groups' => $groups,
                'activities' => $activities,
            ]);
        }

        return view('home', [
            'activities' => $activities,
        ]);

    }

    public function addGroup()
    {
        $activities = Activity::all();

        return view('addGroup', [
            'activities' => $activities,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'address' => 'required|string|min:10',
            'city' => 'required|string',
            'postcode' => 'nullable|string|min:6|max:8',
            'activity1' => 'required|integer|exists:activities,id',
            'activity2' => 'nullable|integer|exists:activities,id',
            'activity3' => 'nullable|integer|exists:activities,id',
            'description' => 'required|string|min:50|max:2000',
            'contact_name' => 'required|string|min:5|max:255',
            'contact_email' => 'required|string|min:5|max:255',
        ]);

        $newPendingGroup = new PendingGroup();

        $newPendingGroup->name = $request->name;
        $newPendingGroup->address = $request->address;
        $newPendingGroup->city = $request->city;
        $newPendingGroup->postcode = $request->postcode;
        $newPendingGroup->activity1 = $request->activity1;
        $newPendingGroup->activity2 = $request->activity2;
        $newPendingGroup->activity3 = $request->activity3;
        $newPendingGroup->description = $request->description;
        $newPendingGroup->contact_name = $request->contact_name;
        $newPendingGroup->contact_email = $request->contact_email;

        $newPendingGroup->save();

        return view('addGroup');
    }

}

