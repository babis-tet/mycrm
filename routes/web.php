<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('customers', CustomerController::class);
    Route::any('customers/records', [App\Http\Controllers\CustomerController::class, 'records'])->name('customer_records');

    Route::any('customer/contacts', [App\Http\Controllers\ContactController::class, 'records'])->name('customerContacts');


    Route::get('contact/{id}/edit', [App\Http\Controllers\ContactController::class, 'edit'])->name('editcontact');
    Route::put('contact/{id}/update', [App\Http\Controllers\ContactController::class, 'update'])->name('updatecontact');
    Route::post('contact/save', [App\Http\Controllers\ContactController::class, 'store'])->name('contactcreate');


    Route::resource('suppliers', SupplierController::class);


    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('user', [App\Http\Controllers\UserController::class, 'create'])->name('user');
    Route::get('user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_user');
    Route::post('user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update_user');
    Route::post('user/save', [App\Http\Controllers\UserController::class, 'store'])->name('save_user');
    Route::any('user/records', [App\Http\Controllers\UserController::class, 'records'])->name('user_records');
    Route::any('user/activity', [App\Http\Controllers\UserController::class, 'activity'])->name('user.activity');

    Route::get('permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions');
    Route::get('permission', [App\Http\Controllers\PermissionController::class, 'create'])->name('permission');
    Route::get('permission/edit/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('edit_permission');
    Route::post('permission/update/{id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('update_permission');
    Route::post('permission/save', [App\Http\Controllers\PermissionController::class, 'store'])->name('save_permission');
    Route::any('permission/records', [App\Http\Controllers\PermissionController::class, 'records'])->name('permission_records');

    Route::get('roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles');
    Route::get('role', [App\Http\Controllers\RoleController::class, 'create'])->name('role');
    Route::get('role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('edit_role');
    Route::post('role/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('update_role');
    Route::post('role/save', [App\Http\Controllers\RoleController::class, 'store'])->name('save_role');
    Route::any('role/records', [App\Http\Controllers\RoleController::class, 'records'])->name('role_records');
