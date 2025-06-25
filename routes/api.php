<?php

use App\Http\Controllers\Api\ArchiveController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\TripPerposeController;
use Illuminate\Container\Attributes\Auth;

Route::controller(AuthController::class)->group(function () {
    Route::post('/user-login', 'login');
    Route::post('/user-logout', 'logout');
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
    Route::post('/trip-archive', 'store');

});
