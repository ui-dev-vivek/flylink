s<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shortlink;
use App\Http\Controllers\Socialpages;
use App\Http\Controllers\Biolinktree;
use App\Http\Controllers\Sociallink;
use App\Http\Controllers\Home;

Route::get('/', [Home::class, 'index']);
Route::get('/shortlink', [Shortlink::class, 'index']);
Route::get('{urlCode}-', [Shortlink::class, 'redirectShortLink'])->name('redirect');
Route::get('{urlCode}+', [Shortlink::class, 'shwoShortLink'])->name('redirect');
