<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $users = User::where('role', User::USER_BUYER)->orderBy('name')->get();
            return view('', compact(['users']));
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $user->update([
            'password' => $request->password
        ]);
        return redirect();
    }
}
