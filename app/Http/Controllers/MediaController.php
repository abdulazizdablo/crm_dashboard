<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class MediaController extends Controller
{




    public function createImage()
    {


        return view('profile_image');
    }
    public function updateImage(Request $request)
    {
        if ($request->hasFile('image')) {


            $profile = auth()->user()->profile;


            $profile->addMediaFromRequest('image')->toMediaCollection('images');
            return redirect()->route('profile.show')->with(['success' => 'Profile Picture has been updated']);
        } else {
        }
    }
}
