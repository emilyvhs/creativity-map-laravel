<?php

namespace App\Http\Controllers;

use App\Models\PendingGroup;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function all()
    {
        $pendingGroups = PendingGroup::where('approved', '=', 0)->paginate(12);

        return view('allPendingGroups', [
            'pendingGroups' => $pendingGroups
        ]);
    }

    public function find(int $id)
    {
        $pendingGroup = PendingGroup::where('approved', '=', 0)->find($id);

        return view('approvePendingGroup', [
            'pendingGroup' => $pendingGroup,
        ]);
    }

    public function approve(int $id)
    {
        $pendingGroup = PendingGroup::find($id);

        $pendingGroup->approved = 1;

        $pendingGroup->save();

        return redirect('/approve');
    }
}
