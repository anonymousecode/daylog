<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryController;

Route::view('/','login')->name('login');
Route::view('/register','register')->name('register');
Route::view('create','create')->name('create');
Route::view('edit-profile','editprofile')->name('edit-profile');

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('create',[DiaryController::class,'create'])->name('create');

Route::put('/dashboard/{id}/update', [DiaryController::class,'update'])->name('update');
Route::put('dashboard/profile-update',[UserController::class,'update'])->name('update-profile');

Route::get('/dashboard',[DiaryController::class,'listDiaries'])->name('dashboard');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::get('/dashboard/{id}/update',[DiaryController::class,'editdiary'])->name('edit-diary');
Route::get('dashboard/{id}/read',[DiaryController::class,'read'])->name('read-diary');
Route::get('delete/{id}', [DiaryController::class, 'delete'])->name('delete-diary');

