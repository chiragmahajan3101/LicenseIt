<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $users = User::where('role', User::USER_BUYER)->orderBy('name')->search()->get();

            $usersData = [];
            foreach ($users as $user) {
                $eachData = [
                    $user->company_id,
                    $user->name,
                    $user->email,
                    $user->mobile_no,
                    $user->licenses->count(),
                    $user->action_buttons
                ];
                array_push($usersData, $eachData);
            }
            $emails = User::where('role', 0)->select('email')->get()->toArray();
            return view('layouts.User.index', compact(['usersData', 'emails']));
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $user->update([
            'password' => $request->password
        ]);
        return redirect();
    }

    public function edit(User $user)
    {
        return view('layouts.User.edit', compact(['user']));
    }

    public function create()
    {
        return view('layouts.User.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'role' => 0,
            'mobile_no' => (int)$request->mobile_no,
            'remember_token' => Str::random(10),
        ]);
        session()->flash('success', "New User $user->name Registered");
        return redirect(route('users.index'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->password == null) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => (int)$request->mobile_no,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile_no' => (int)$request->mobile_no,
            ]);
        }

        session()->flash('success', "Deatils Of User $user->name Updated Successfully");
        return redirect(route('users.index'));
    }
}
