<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretAccountController;
use App\Http\Controllers\SecretMessageController;
use App\Http\Controllers\SecretPasswordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'createPage'])->name('land');
Route::get('/back', [HomeController::class, 'goBack'])->name('back');
Route::get('/practice', function () {
    return view('practice-land');
});

// Route::get('/home', function () {
//     return view('client.home', ['title' => 'WeProTech - Home']);
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::post('/set-vault-password', [SecretPasswordController::class, 'setPassword'])->name('set.vault.password');
    
    Route::middleware(['vault.set'])->group(function () {
        Route::post('/vault/verify', [SecretPasswordController::class, 'verifyPassword']);
        Route::post('/vault/update', [SecretPasswordController::class, 'changePassword'])->name('updateVault');
        
        // Accounts
        Route::get('/accounts', [SecretAccountController::class, 'index'])->name('accounts');
        Route::get('/accounts/{id}', [SecretAccountController::class, 'getSecretAccount'])->name('getSecretAccount');
        Route::post('/create-account', [SecretAccountController::class, 'createSecretAccount'])->name('createSecretAccount');
        Route::get('/open-edit-account/{id}', [SecretAccountController::class, 'openEditAccountModal'])->name('openEditAccountModal');
        Route::post('/update-account', [SecretAccountController::class, 'updateSecretAccount'])->name('updateSecretAccount');
        Route::get('/delete-account/{id}', [SecretAccountController::class, 'deleteSecretAccount'])->name('deleteSecretAccount');
        
        // Diaries
        Route::get('/diary', [SecretMessageController::class, 'index'])->name('diary');
        Route::post('/add-diary', [SecretMessageController::class, 'createSecretMessage'])->name('add-diary');
        Route::get('/delete-diary/{id}', [SecretMessageController::class, 'deleteSecretMessage'])->name('delete-diary');

        Route::post('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');        
    });
});
