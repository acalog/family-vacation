<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\AttachmentController;

/*
Route::get('/welcome', function () {
    User::updateOrCreate(
        ['email' => '', 'name' => ''],
        ['password' => Hash::make('')]
    );
    return view('welcome');
});
*/

Route::get('/details', [ActionController::class, 'showImageDetails'])->name('image.details');

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/anthony', [LoginController::class, 'showRegisterForm']);
Route::get('/kate', [LoginController::class, 'showRegisterForm']);
Route::get('/barbara', [LoginController::class, 'showRegisterForm']);
Route::post('/register', [LoginController::class, 'register'])->name('register');

// Media Attachments
Route::post('/upload', [MediaController::class, 'upload'])->name('upload');

Route::post('/edit/title', [AttachmentController::class, 'editTitle'])->name('edit.title');

Route::get('/', [ActionController::class, 'home'])->name('home');
