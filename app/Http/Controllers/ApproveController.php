<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class ApproveController extends Controller
{
    public function all()
    {
        $groups = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->paginate(12);

        return view('allPendingGroups', [
            'groups' => $groups,
        ]);
    }

    public function find(int $id)
    {
        $group = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->find($id);

        return view('approveGroup', [
            'group' => $group,
        ]);
    }

    //Approve pending groups and redirect to map function to find coordinates from Geocoder
    public function approve(int $id)
    {

        $group = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->find($id);

        $group->approved = 1;

        $group->save();

        return redirect('/map');
    }

    public function delete(int $id)
    {

        $group = Group::where('deleted', '=', 0)
            ->find($id);

        if (! Auth::user()) {
            abort(403);
        }

        if ($group->approved == 0) {

            $group->deleted = 1;

            $group->save();

            return redirect('/approve');
        }

        $group->deleted = 1;

        $group->save();

        return redirect('/admin');

    }
}
