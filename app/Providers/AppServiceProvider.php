<?php

namespace App\Providers;

use App\Models\System;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Get Data From Database
        $system_setting  =System::first();

        view()->share('system_setting', $system_setting);
    }
}
