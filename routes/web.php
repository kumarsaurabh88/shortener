<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/s/{code}', [ShortUrlController::class, 'redirect'])->name('redirect');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::put('/{user}', [RoleController::class, 'update'])->name('roles.update');
    });

    Route::prefix('urls')->group(function () {
        Route::get('/', [ShortUrlController::class, 'index'])->name('urls.index');
        Route::get('/create', [ShortUrlController::class, 'create'])->name('urls.create');
        Route::post('/', [ShortUrlController::class, 'store'])->name('urls.store');
        Route::get('/{shortUrl}', [ShortUrlController::class, 'show'])->name('urls.show');
        Route::delete('/{shortUrl}', [ShortUrlController::class, 'destroy'])->name('urls.destroy');
    });

    Route::prefix('invitations')->group(function () {
        Route::get('/', [InvitationController::class, 'index'])->name('invitations.index');
        Route::get('/create', [InvitationController::class, 'create'])->name('invitations.create');
        Route::post('/', [InvitationController::class, 'store'])->name('invitations.store');
    });
});

Route::get('/invitation/{token}', [InvitationController::class, 'accept'])->name('invitation.accept');
