<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/reset-password', function (Request $request) {

    return view('auth.reset_password_view');

});

Route::get('/login-success', function () {
    return view('auth.login-success');
});