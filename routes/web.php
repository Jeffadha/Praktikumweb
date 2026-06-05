<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//  View
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

// AJAX Routes
Route::post('/store_ajax', [HomeController::class, 'storeajax'])->name('storeajax');
Route::get('/showajax', [HomeController::class, 'showajax'])->name('showajax');


Route::get('/searchajax', [HomeController::class, 'searchajax'])->name('searchajax');