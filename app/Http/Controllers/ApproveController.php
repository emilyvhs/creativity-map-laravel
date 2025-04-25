<?php

namespace App\Http\Controllers;

use App\Models\Group;

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

    public function approve(int $id)
    {
        $group = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->find($id);

        $group->approved = 1;

        $group->save();

        return redirect('/approve');
    }

    public function delete(int $id)
    {
        $group = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->find($id);

        $group->deleted = 1;

        $group->save();

        return redirect('/approve');
    }
}
