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
    
    Route::post('/vault/verify/', [SecretPasswordController::class, 'verifyPassword']);
    Route::post('/set-vault-password', [SecretPasswordController::class, 'setPassword'])->name('set.vault.password');

    Route::middleware(['vault.set'])->group(function () {
        Route::get('/diary', [SecretMessageController::class, 'index'])->name('diary');
        
        // Accounts
        Route::get('/accounts', [SecretAccountController::class, 'index'])->name('accounts');
        Route::get('/accounts/{id}', [SecretAccountController::class, 'getSecretAccount'])->name('getSecretAccount');
        Route::post('/create-account', [SecretAccountController::class, 'createSecretAccount'])->name('createSecretAccount');
        Route::get('/open-edit-account/{id}', [SecretAccountController::class, 'openEditAccountModal'])->name('openEditAccountModal');
        Route::post('/update-account', [SecretAccountController::class, 'updateSecretAccount'])->name('updateSecretAccount');
        Route::post('/delete-account/{id}', [SecretAccountController::class, 'deleteSecretAccount'])->name('deleteSecretAccount');
        
        Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');        
    });
});
