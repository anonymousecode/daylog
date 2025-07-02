<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/','welcome')->name('home');
Route::view('/register','register')->name('register');
Route::view('/dashboard','dashboard')->name('dashboard');

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout'])->name('logout');
