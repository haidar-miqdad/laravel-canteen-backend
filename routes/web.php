<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('home', function () {
    return view('pages.dashboard');
});

// langkah awal buat crud
// DI CMD JALANIN COMMAND php artisan make:controlle UserController => daftarin UserController di web.php
Route::resource('user', UserController::class);

Route::resource('product', ProductController::class);

//routing otentikasi dipindahin ke app/providers/fortifyServiceprovider
// Route::get('/login', function () {
//     return view('pages.auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('pages.auth.register');
// })->name('register');
