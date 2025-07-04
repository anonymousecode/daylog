<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryController;

// Public Routes
Route::view('/', 'login')->name('login');
Route::view('/register', 'register')->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Requires Login)
Route::middleware(['auth'])->group(function () {

    // Dashboard & Diary Routes
    Route::get('/dashboard', [DiaryController::class, 'listDiaries'])->name('dashboard');
    Route::get('/dashboard/update/{id}', [DiaryController::class, 'editdiary'])->name('edit-diary');
    Route::get('dashboard/read/{id}', [DiaryController::class, 'read'])->name('read-diary');
    Route::get('delete/{id}', [DiaryController::class, 'delete'])->name('delete-diary');

    Route::put('/dashboard/update/{id}', [DiaryController::class, 'update'])->name('update');


    // Create Diary
    Route::view('create', 'create')->name('create');

    Route::post('create', [DiaryController::class, 'create']);

    // Profile Routes
    Route::view('edit-profile', 'editprofile')->name('edit-profile');
    
    Route::put('dashboard/profile-update', [UserController::class, 'update'])->name('update-profile');

    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
