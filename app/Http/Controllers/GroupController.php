<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function all()
    {
        $groups = Group::all();
        return view('groups', [
            'groups' => $groups
        ]);
    }
}
