<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ActionController;

/*
Route::get('/welcome', function () {
    User::updateOrCreate(
        ['email' => '', 'name' => ''],
        ['password' => Hash::make('')]
    );
    return view('welcome');
});
*/

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

// Media Attachments
Route::post('/upload', [MediaController::class, 'upload'])->name('upload');

Route::get('/', [ActionController::class, 'home'])->name('home');
