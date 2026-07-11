<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password', function (Request $request) {

    return response()->json([
        'token' => $request->token,
        'email' => $request->email,
    ]);

});