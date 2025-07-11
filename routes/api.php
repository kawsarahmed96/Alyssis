<?php

use Mockery\Matcher\Not;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\ArchiveController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserMoodController;
use App\Http\Controllers\Api\TripPerposeController;
use App\Http\Controllers\Api\NotificationController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/user-signup', 'signup');
    Route::post('/user-login', 'login');
    Route::post('/user-logout', 'logout');

    // otp verify
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/forgot-password', [AuthController::class, 'resetPassword']);
});

Route::controller(ProfileController::class)->middleware('auth:api')->group(function () {
    Route::post('/user-profile', 'profileSave');
    Route::get('/user-profile_name', 'profile_nameg_get');
    Route::post('/user-profile_edit', 'profileUpdate');
});
Route::controller(NotificationController::class)->middleware('auth:api')->group(function () {
    Route::post('/notification_add', 'NotificationStore');

});
//trip perpose store
Route::controller(TripPerposeController::class)->middleware('auth:api')->group(function () {
    Route::get('/trip-perpose', 'index');
    Route::post('/trip-perpose/store', 'store');
    Route::post('/trip-perpose/delete', 'destroy');
});

Route::middleware('auth:api')->controller(TripController::class)->group(function () {
    Route::post('/trip', 'index');
    Route::post('/trip/store', 'store');
    Route::post('/trip/update', 'update');
    Route::post('/trip/delete', 'destroy');
});

Route::middleware('auth:api')->controller(ArchiveController::class)->group(function () {
    Route::get('/get-trip-archive', 'index');
    Route::post('/trip-archive-update', 'update');
    Route::post('/trip-archive-image_delete', 'imageDelete');
    Route::post('/trip-archive', 'store');
});
Route::middleware('auth:api')->controller(TaskController::class)->group(function () {
    Route::get('/day-show', 'dayShow');
    Route::post('/task-store', 'store');
    Route::post('/task-delete', 'destroy');
});
Route::middleware('auth:api')->controller(UserMoodController::class)->group(function () {
    Route::post('/add-user-mood', 'store');
    Route::post('/all_user_mood', 'index');
});
