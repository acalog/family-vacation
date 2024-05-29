<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    User::updateOrCreate(
        ['email' => 'caloggero.a@gmail.com', 'name' => 'alex'],
        ['password' => Hash::make('alex')]
    );
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

Route::post('/login', function (Request $request) {
    $password = $request->input('password');
    $email    = $request->input('email');

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $request->session()->regenerate();
        return '200 OK';
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login');