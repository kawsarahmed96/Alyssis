<?php

namespace App\Http\Controllers\Settings;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminSettingsController extends Controller
{
    function index()
    {
        $admin = AdminSetting::first(); // Fetch the first admin setting record
        return view('backend.layouts.settings.admin_setting.index', [
            'admin' => $admin,
        ]);
    }

    public function adminSettingUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'copyright' => 'nullable|string',
            'hotline' => 'nullable|string',
        ]);

        $admin_setting = AdminSetting::first(); // or ->find(1);
        if (!$admin_setting) {
            $admin_setting = new AdminSetting(); // If no existing row, create new
        }

        $data = [
            'title' => $request->title,
            'email' => $request->email,
            'copyright' => $request->copyright,
            'hotline' => $request->hotline,
        ];


        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($admin_setting->logo && File::exists(public_path($admin_setting->logo))) {
                File::delete(public_path($admin_setting->logo));
            }

            // Upload new logo
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('uploads/logo/'), $logoName);

            // Save relative path in DB (not full URL)
            $data['logo'] = 'uploads/logo/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon
            if ($admin_setting->favicon && File::exists(public_path($admin_setting->favicon))) {
                File::delete(public_path($admin_setting->favicon));
            }

            // Upload new favicon
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move(public_path('uploads/favicon/'), $faviconName);

            // Save relative path in DB
            $data['favicon'] = 'uploads/favicon/' . $faviconName;
        }

        if ($admin_setting->exists) {
            $admin_setting->update($data);
        } else {
            AdminSetting::create($data);
        }
        toastr()->success('Admin settings updated successfully.');
        return redirect()->back();
    }
}
