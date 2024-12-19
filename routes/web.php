<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('home', function() {
    return view('home');
});

Route::get('login', function() {
    return view('login');
});

Route::get('register', function() {
    return view('register');
});
    
Route::get('logout', function() {
    return view('logout');
});

Route::get('browsers', function() {
    return view('browsers');
});

Route::get('communication', function() {
    return view('communication');
});

Route::get('entertainment', function() {
    return view('entertainment');
});

Route::get('productivity', function() {
    return view('productivity');
});

Route::get('network', function() {
    return view('network');
});

Route::get('services', function() {
    return view('services');
});

Route::get('development', function() {
    return view('development');
});

Route::get('mobile', function() {
    return view('mobile');
});

Route::get('games', function() {
    return view('games');
});


Route::get('saguenay', function() {
    return view('saguenay');
});

Route::get('google', function() {
    return view('google');
});


