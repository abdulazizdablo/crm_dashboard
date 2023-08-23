<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    public function activeUsers(){


        $active_users = User::active()->paginate();

        return view('users.active')->with('active_users',$active_users);
    }
}
