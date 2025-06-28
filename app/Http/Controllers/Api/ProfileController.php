<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profileSave(Request $request)
    {
        $profile_photo =  $request->file('profile_photo');

        if ($profile_photo) {
            $profile_photo_name = time() . '.' . $profile_photo->getClientOriginalExtension();
            $profile_photo->move(public_path('uploads/profile_photo'), $profile_photo_name);
            $url = 'uploads/profile_photo/' . $profile_photo_name;

            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'profile_photo' => $url,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile Name And Profile Photo Set successfully',
        ]);
    }

    public function profile_nameg_get()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return response()->json([
            'status' => true,
            'message' => 'Profile name and profile Photo retrive successfully',
            'user' => $user
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($user) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile Update successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Profile not found',
        ]);
    }
}
