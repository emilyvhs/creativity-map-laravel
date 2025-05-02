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
        $groups = Group::where('deleted', '=', 0)
            ->where('approved', '=', 1)
            ->paginate(6);

        return view('allGroups', [
            'groups' => $groups,
        ]);
    }

    public function find(int $id)
    {
        $group = Group::where('deleted', '=', 0)
            ->where('approved', '=', 1)
            ->find($id);

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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
                ->where('name', 'LIKE', "%$request->name%")
                ->get();

            return view('home', [
                'groups' => $groups,
                'activities' => $activities,
            ]);
        }

        if (($request->activity !== 'all') && ($request->name === '') && ($request->location === '')) {
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
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

    public function displayAddForm()
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
            'activity2' => 'nullable|different:activity1',
            'activity3' => 'nullable|different:activity1',
            'description' => 'required|string|min:50|max:2000',
            'contact_name' => 'required|string|min:5|max:255',
            'contact_email' => 'required|string|min:5|max:255',
        ]);

        $newGroup = new Group;

        $newGroup->name = $request->name;
        $newGroup->address = $request->address;
        $newGroup->city = $request->city;
        $newGroup->postcode = $request->postcode;

        if ($request->activity1 == '') {
            $request->activity1 = null;
        }

        $newGroup->activity1 = $request->activity1;

        if ($request->activity2 == '') {
            $request->activity2 = null;
        }

        $newGroup->activity2 = $request->activity2;

        if ($request->activity3 == '') {
            $request->activity3 = null;
        }

        $newGroup->activity3 = $request->activity3;

        $newGroup->description = $request->description;
        $newGroup->contact_name = $request->contact_name;
        $newGroup->contact_email = $request->contact_email;

        $newGroup->save();

        return redirect('/success');
    }

    public function displayEditPendingGroupForm(int $id)
    {
        $activities = Activity::all();
        $group = Group::where('deleted', '=', 0)
            ->where('approved', '=', 0)
            ->find($id);

        return view('editPendingGroup', [
            'activities' => $activities,
            'group' => $group,
        ]);
    }

    public function updatePendingGroup(Request $request, int $id)
    {
        $group = Group::where('deleted', '=', 0)
            ->where('approved', '=', 0)
            ->find($id);

        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'address' => 'required|string|min:10',
            'city' => 'required|string',
            'postcode' => 'nullable|string|min:6|max:8',
            'description' => 'required|string|min:50|max:2000',
            'contact_name' => 'required|string|min:5|max:255',
            'contact_email' => 'required|string|min:5|max:255',
        ]);

        $group->name = $request->name;
        $group->address = $request->address;
        $group->city = $request->city;
        $group->postcode = $request->postcode;

        if ($request->activity1 != '') {
            $group->activity1 = $request->activity1;
        }

        if ($request->activity2 == 'remove') {
            $request->activity2 = null;
            $group->activity2 = $request->activity2;
        }

        if ($request->activity2 != '') {
            $group->activity2 = $request->activity2;
        }

        if ($request->activity3 == 'remove') {
            $request->activity3 = null;
            $group->activity3 = $request->activity3;
        }

        if ($request->activity3 != '') {
            $group->activity3 = $request->activity3;
        }

        $group->description = $request->description;
        $group->contact_name = $request->contact_name;
        $group->contact_email = $request->contact_email;

        $group->save();

        return redirect('/approve/'.$group->id);
    }

    public function displayEditExistingGroupForm(int $id)
    {
        $activities = Activity::all();
        $group = Group::where('deleted', '=', 0)
            ->where('approved', '=', 1)
            ->find($id);

        return view('editExistingGroup', [
            'activities' => $activities,
            'group' => $group,
        ]);
    }

    public function updateExistingGroup(Request $request, int $id)
    {
        $group = Group::where('deleted', '=', 0)
            ->where('approved', '=', 1)
            ->find($id);

        $request->validate([
            'name' => 'required|string|min:3|max:200',
            'address' => 'required|string|min:10',
            'city' => 'required|string',
            'postcode' => 'nullable|string|min:6|max:8',
            'description' => 'required|string|min:50|max:2000',
            'contact_name' => 'required|string|min:5|max:255',
            'contact_email' => 'required|string|min:5|max:255',
        ]);

        $group->name = $request->name;
        $group->address = $request->address;
        $group->city = $request->city;
        $group->postcode = $request->postcode;

        if ($request->activity1 != '') {
            $group->activity1 = $request->activity1;
        }

        if ($request->activity2 == 'remove') {
            $request->activity2 = null;
            $group->activity2 = $request->activity2;
        }

        if ($request->activity2 != '') {
            $group->activity2 = $request->activity2;
        }

        if ($request->activity3 == 'remove') {
            $request->activity3 = null;
            $group->activity3 = $request->activity3;
        }

        if ($request->activity3 != '') {
            $group->activity3 = $request->activity3;
        }

        $group->description = $request->description;
        $group->contact_name = $request->contact_name;
        $group->contact_email = $request->contact_email;

        $group->save();

        return redirect('/admin');
    }
}
