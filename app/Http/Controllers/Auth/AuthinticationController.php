<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegestrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthinticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors('Invalid email or password');
    }

    public function register(RegestrationRequest $request)
    {
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('/home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
