<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('login');
});
Route::view('welocme','welcome')->name('welcome');

Route::get('auth/{provider}/redirect', [SocialiteController::class, 'loginSocial'])
->name('socialite.auth');

Route::get('auth/{provider}-callback', [SocialiteController::class, 'callbackSocial'])
->name('socialite.callback');