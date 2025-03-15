<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function all()
    {
        $groups = Group::all();
        return view('groups', [
            'groups' => $groups
        ]);
    }

    public function search(Request $request)
    {
        if($request->location){
            $groups = DB::table('groups')
                            ->where('city', 'LIKE', "%$request->location%")
                            ->orWhere('postcode', 'LIKE', "%$request->location%")
                            ->get();
            return view('home', [
                'groups' => $groups
            ]);
        }

        return view('home');

    }
}
