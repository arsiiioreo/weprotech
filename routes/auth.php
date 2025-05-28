<?php
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User Routes
Route::group(['prefix' => 'user'], function () {
    Route::post('/login', [UserController::class , 'login'])->name('login');
    Route::post('/create_account', [UserController::class , 'createAccount'])->name('register');
    Route::post('/reset_password', [UserController::class , 'resetPassword']);
    Route::post('/update_profile', [UserController::class , 'updateProfile']);
    Route::post('/change_password', [UserController::class , 'changePassword']);
});