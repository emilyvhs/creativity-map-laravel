<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function displayAdminArea() {

        $groups = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->get();

        return view('adminArea', [
            'groups' => $groups
        ]);

    }
}
