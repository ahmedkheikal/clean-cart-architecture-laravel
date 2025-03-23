<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

include_once 'webApi.php';

// Catch all routes and direct to Vue router
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('home');
// products 
Route::get('/products', function () {
    return view('products');
})->name('products');
// auth 
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
 