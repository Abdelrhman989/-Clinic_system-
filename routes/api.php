<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\ApointmentController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\auth\RegisterLoginController;
use App\Http\Controllers\Api\auth\UserLoginController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::apiResource('/doctors', DoctorController::class);
    Route::apiResource('/majors', MajorController::class);
    Route::apiResource('/apointments', ApointmentController::class);
    Route::apiResource('/contacts', ContactController::class);
    Route::post('/auth/register', [RegisterLoginController::class, 'register'])->middleware('throttle:5,1', 'guest:sanctum');
    Route::post('/auth/login', [UserLoginController::class, 'login'])->middleware('throttle:5,1', 'guest:sanctum');
    Route::post('/auth/logout', [UserLoginController::class, 'logout'])->middleware('auth:sanctum');
});
