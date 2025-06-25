<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Settings\SystemController;
use App\Http\Controllers\Settings\MailSettingController;
use App\Http\Controllers\Settings\AdminSettingsController;
use App\Http\Controllers\Settings\ProfileSettingController;

Route::controller(BackendController::class)->middleware('auth.check')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});


Route::controller(MailSettingController::class)->middleware('auth.check')->group(function () {
    Route::get('/settings/mail', 'index')->name('mail.index');
    Route::post('/settings/mail-store', 'mailstore')->name('mail.store');
});
Route::controller(ProfileSettingController::class)->middleware('auth.check')->group(function () {
    Route::get('/settings/profile', 'index')->name('profile.index');
    Route::post('/settings/profile-update', 'profileupdate')->name('profile.update');
    Route::post('/settings/profile-password-update', 'PasswordUpdate')->name('profile.password.update');
});
Route::controller(SystemController::class)->middleware('auth.check')->group(function () {
    Route::get('/settings/system', 'index')->name('system.index');
    Route::post('/settings/system-store', 'systemupdate')->name('system.update');

});
Route::controller(AdminSettingsController::class)->middleware('auth.check')->group(function () {
    Route::get('/settings/admin', 'index')->name('admin.setting.index');
    Route::post('/settings/admin/update', 'adminSettingUpdate')->name('admin.setting.update');

});
