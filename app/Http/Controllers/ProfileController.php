<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {

        $profile = auth()->user()->profile;
        return view('auth.profile')->with('profile',$profile);
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }




/*public function createImage(Profile $profile){


    return view('profile_image')->with('profile',$profile);
}


    public function updateImage(){




    }*/

    


    
}
