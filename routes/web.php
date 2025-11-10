<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('dashboard');
});

Route::get('/mdm', function () {
    return view('masda');
});

Route::get('/user/adduser', function () {
    return view('users/adduser');
});

Route::get('/auth/login', function () {
    return view('auth/login');
});
