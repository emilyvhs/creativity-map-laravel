<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function displayAdminLoginForm() {
        return view('adminLoginForm');
    }

    public function displayAdminArea(Request $request) {

        if (!Auth::user()) {
            abort(403);
        }

        $pendingGroups = Group::where('approved', '=', 0)
            ->where('deleted', '=', 0)
            ->get();

        if (!$request->name) {
            return view('adminArea', [
                'pendingGroups' => $pendingGroups,
            ]);
        }

        if ($request->name !== '') {
            $groups = DB::table('groups')->where('deleted', '=', 0)
                ->where('approved', '=', 1)
                ->where('name', 'LIKE', "%$request->name%")
                ->get();

            return view('adminArea', [
                'pendingGroups' => $pendingGroups,
                'groups' => $groups,
            ]);
        }
    }

    public function login(Request $request) {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'admin' => 1])) {
            $request->session()->regenerate();
            return redirect('/admin');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');

    }
}
