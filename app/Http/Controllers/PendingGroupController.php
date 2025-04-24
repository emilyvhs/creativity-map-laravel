<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\PendingGroup;
use Illuminate\Http\Request;

class PendingGroupController extends Controller
{
    public function addForm()
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

        $newPendingGroup = new PendingGroup();

        $newPendingGroup->name = $request->name;
        $newPendingGroup->address = $request->address;
        $newPendingGroup->city = $request->city;
        $newPendingGroup->postcode = $request->postcode;

        if ($request->activity1 == ""){
            $request->activity1 = null;
        }

        $newPendingGroup->activity1 = $request->activity1;

        if ($request->activity2 == ""){
            $request->activity2 = null;
        }

        $newPendingGroup->activity2 = $request->activity2;

        if ($request->activity3 == ""){
            $request->activity3 = null;
        }

        $newPendingGroup->activity3 = $request->activity3;

        $newPendingGroup->description = $request->description;
        $newPendingGroup->contact_name = $request->contact_name;
        $newPendingGroup->contact_email = $request->contact_email;

        $newPendingGroup->save();

        return redirect('/success');
    }
}
