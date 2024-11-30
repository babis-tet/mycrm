<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('user', [App\Http\Controllers\UserController::class, 'create'])->name('user');
    Route::get('user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_user');
    Route::post('user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update_user');
    Route::post('user/save', [App\Http\Controllers\UserController::class, 'store'])->name('save_user');
    Route::any('user/records', [App\Http\Controllers\UserController::class, 'records'])->name('user_records');
    Route::any('user/activity', [App\Http\Controllers\UserController::class, 'activity'])->name('user.activity');
