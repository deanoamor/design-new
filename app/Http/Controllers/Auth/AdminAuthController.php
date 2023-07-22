<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminAuthController extends Controller
{

    public function viewRegister()
    {
        return view('main.admin.admin-register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Admin',
        ]);

        Admin::create([
            'users_id' => $user->id,
            'username' => $request->username,
            'wallet' => 0,
            'status' => 'Active'
        ]);

        event(new Registered($user));

        return redirect()->route('login');
    }
}
