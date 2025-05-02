<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function displayAdminArea(int $id) {

        $groups = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->get();

        $user = User::where('admin', '=', 1)
            ->find($id);

        return view('adminArea', [
            'groups' => $groups,
            'user' => $user
        ]);

    }
}
