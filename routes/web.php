<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;

// Authentication Routes
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Pages
Route::get('/', fn() => Inertia::render('Public/Welcome'))->name('home');
Route::get('/about', fn() => Inertia::render('Public/About'))->name('about');
Route::get('/contact', fn() => Inertia::render('Public/Contact'))->name('contact');
Route::get('/faq', fn() => Inertia::render('Public/FAQ'))->name('faq');

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions', [TransactionController::class, 'store']);

    Route::get('/withdraw', [WithdrawalController::class, 'index'])->name('withdraw');
    Route::post('/withdraw', [WithdrawalController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update']);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/help', [HelpController::class, 'index'])->name('help');
    Route::post('/help', [HelpController::class, 'store']);
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions', [TransactionController::class, 'store']); // Users create requests
    Route::post('/transactions/{id}', [TransactionController::class, 'update']); // Admins approve/reject
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/withdraw', [WithdrawalController::class, 'index'])->name('withdraw');
    Route::post('/withdraw', [WithdrawalController::class, 'store']); // Users create requests
    Route::post('/withdraw/{id}', [WithdrawalController::class, 'update']); // Admins approve/reject
});


