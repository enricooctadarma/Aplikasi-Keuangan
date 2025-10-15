<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

// ========== AUTENTIKASI ==========
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========== HALAMAN YANG BUTUH LOGIN ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'update', 'show']);

    Route::resource('transactions', TransactionController::class);

    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/export/pdf', [ReportController::class, 'exportPDF'])->name('reports.export.pdf');
        Route::get('/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
    });
});

// ========== REDIRECT JIKA BELUM LOGIN ==========
Route::get('/dashboard', function () {
    return redirect()->route('login');
})->name('dashboard.redirect')->middleware('guest');
