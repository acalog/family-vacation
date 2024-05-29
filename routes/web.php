<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello World';
})->middleware('auth')->name('home');

Route::get('/home', function () {
    return view('content.home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');