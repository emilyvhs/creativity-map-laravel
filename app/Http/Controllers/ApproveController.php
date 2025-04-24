<?php

namespace App\Http\Controllers;

use App\Models\PendingGroup;
use Illuminate\Http\Request;

class ApproveController extends Controller
{
    public function display()
    {
        $pendingGroups = PendingGroup::where('approved', '=', 0)->paginate(1);

        return view('approveAddGroup', [
            'pendingGroups' => $pendingGroups
        ]);
    }
}
