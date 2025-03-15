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
        if (!$request->location && !$request->keyword){
            return view('home');
        }

        if (($request->location !== "") && ($request->keyword !== "")){
            $groups = DB::table('groups')
                ->whereAny([
                    'city',
                    'postcode',
                ], 'LIKE', "%$request->location%")
                ->where('description', 'LIKE', "%$request->keyword%")
                ->get();
            return view('home', [
                'groups' => $groups
            ]);
        }

        if(($request->location !== "") && ($request->keyword)){
            $groups = DB::table('groups')
                            ->where('city', 'LIKE', "%$request->location%")
                            ->orWhere('postcode', 'LIKE', "%$request->location%")
                            ->get();
            return view('home', [
                'groups' => $groups
            ]);
        }

        if(($request->keyword !== "") && ($request->location)){
            $groups = DB::table('groups')
                ->where('description', 'LIKE', "%$request->keyword%")
                ->get();
            return view('home', [
                'groups' => $groups
            ]);
        }

        return view('home');

    }
}
