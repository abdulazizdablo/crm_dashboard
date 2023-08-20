<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailDuplicateExeption;
use App\Http\Requests\RegestrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Carbon;

class AuthinticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

          session(['last_activity' => Carbon::now()]);
          
            return redirect()->intended('/home');
        }




        return back()->withErrors('Invalid email or password');
    }

    public function register(RegestrationRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $exception) {



            session()->flash('message', $exception->getMessage());
            return redirect()->route('/register');
        }

        $user->sendEmailVerificationNotification();


        if (!$user->hasVerifiedEmail) {


            $user->markEmailAsVerified();
        }

        Auth::login($user);

        return redirect()->intended('/home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
