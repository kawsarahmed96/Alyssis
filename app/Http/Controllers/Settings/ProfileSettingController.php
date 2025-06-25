<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileSettingController extends Controller
{
    // profile settings show
    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('backend.layouts.settings.profile.settings-profile', [
            'user' => $user,
        ]);
    }


    // Profile update

    public function profileupdate(Request $request)
    {
        // dd($request->all());
        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Handle avatar upload if present
        if ($request->hasFile('avatar')) {
            $file_name = $this->uploadImage($request->file('avatar'), $user->avatar, 'uploads/avatars', 150, 150, 'avatar');
            $updateData['avatar'] = $file_name;
        }

        $user->update($updateData);
        toastr()->success('Profile updated successfully!');
        return redirect()->back();
    }


    // Password update
    public function PasswordUpdate(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);


        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password) == false) {
            toastr()->error('Old password does not match');
            return redirect()->back();
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        toastr()->success('Password updated successfully!');
        return redirect()->back();
    }
}
