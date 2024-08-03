<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shortlink;
use App\Http\Controllers\Socialpages;
use App\Http\Controllers\Biolinktree;
use App\Http\Controllers\Sociallink;
use App\Http\Controllers\Home;
use App\Http\Controllers\User\Authcontroller;

Route::get('/', [Home::class, 'index']);
Route::get('/shortlink', [Shortlink::class, 'index']);
Route::get('{urlCode}-', [Shortlink::class, 'redirectShortLink'])->name('redirect');
Route::get('{urlCode}+', [Shortlink::class, 'shwoShortLink'])->name('redirect');



// User:


Route::get('/register', [Authcontroller::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
