<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function displayAdminLoginForm() {
        return view('adminLoginForm');
    }

    public function displayAdminArea(Request $request, int $id) {

        $pendingGroups = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->get();

        $user = User::where('admin', '=', 1)
            ->find($id);

        if (! $request->name) {
            return view('adminArea', [
                'pendingGroups' => $pendingGroups,
                'user' => $user
            ]);
        }

        if ($request->name !== '') {
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
                ->where('name', 'LIKE', "%$request->name%")
                ->get();

            return view('adminArea', [
                'pendingGroups' => $pendingGroups,
                'user' => $user,
                'groups' => $groups,
            ]);
        }



    }
}
