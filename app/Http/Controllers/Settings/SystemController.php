<?php

namespace App\Http\Controllers\Settings;

use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SystemController extends Controller
{
    /**
     * Display the system settings page.
     *
     * @return \Illuminate\View\View
     */
    function index()
    {
        $system = System::first();
        return view('backend.layouts.settings.system.index', [
            'system' => $system
        ]);
    }


    /**
     * Update system settings.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function systemupdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'copyright' => 'nullable|string',
        ]);

        $system = System::first(); // or ->find(1);
        if (!$system) {
            $system = new System(); // If no existing row, create new
        }

        $data = [
            'title' => $request->title,
            'email' => $request->email,
            'copyright' => $request->copyright,
        ];


        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($system->logo && File::exists(public_path($system->logo))) {
                File::delete(public_path($system->logo));
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
            if ($system->favicon && File::exists(public_path($system->favicon))) {
                File::delete(public_path($system->favicon));
            }

            // Upload new favicon
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move(public_path('uploads/favicon/'), $faviconName);

            // Save relative path in DB
            $data['favicon'] = 'uploads/favicon/' . $faviconName;
        }

        if ($system->exists) {
            $system->update($data);

        } else {
            System::create($data);

        }
        toastr()->success('System settings updated successfully!');
        return redirect()->back();
    }
}
