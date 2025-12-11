<?php

use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\Auth\RejesterController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'front.',
], function () {
    //___________________________home___________________________
    Route::get('', [HomeController::class, 'index'])->name('home');
    //___________________________majors___________________________
    Route::get('majors', [MajorController::class, 'index'])->name('majors');
    //___________________________contact___________________________
    Route::get('contact', [ContactController::class, 'create'])->name('contact');
    Route::post('contact', [ContactController::class, 'store'])->name('contact');
    //___________________________doctors___________________________
    Route::get('doctors/{major?}', [DoctorController::class, 'createDoctors'])->name('doctors');
    //___________________________doctor-form___________________________
    Route::get('doctor-form/{doctor?}', [ApointmentController::class, 'show'])->name('doctor-form');
    Route::post('doctor-form/{doctor?}', [ApointmentController::class, 'store'])->name('doctor-form');
    Route::post('check-appointment', [ApointmentController::class, 'checkExisting'])->name('check-appointment');
    //___________________________protected routes___________________________
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('register', [RejesterController::class, 'create'])->name('register');
    Route::post('register', [RejesterController::class, 'store']);
    Route::get('logout', [LogoutController::class, 'store'])->name('logout');
});
