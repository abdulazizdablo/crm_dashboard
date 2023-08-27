<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->paginate();

        return view('users.index', compact('users'));
    }

    public function activeUsers()
    {


        $active_users = User::active()->paginate();

        return view('users.active')->with('active_users', $active_users);
    }


    public function softDelete(User $user)
    {


        $user->deleted_at = now();
        $user->save();
    }
}
