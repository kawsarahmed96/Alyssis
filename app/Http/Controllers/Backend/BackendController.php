<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    // dashboard show
    public function index()
    {
        return view('backend.layouts.dashboard');
    }
}
